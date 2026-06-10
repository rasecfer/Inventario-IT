<?php

namespace App\Livewire;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Configruaciones')]
class SettingForm extends Component
{
    use WithFileUploads;

    public $logo_path = '';
    public $disclaimer = '';
    public $image = null;
    public $isEditing = false;

    protected function rules(): array
    {
        if ($this->isEditing && $this->image) {
            $rules = [
                'image' => 'required|image|max:2048',
                'disclaimer' => 'required'
            ];
        } else {
            $rules = [
                'image' => 'required|image|max:2048',
                'disclaimer' => 'required'
            ];
        }

        return $rules;
    }

    public function mount()
    {

        $setting = Setting::first();
        if ($setting) {
            $this->isEditing = true;
            $this->logo_path = Storage::disk('public')->url($setting->logo_path);
            $this->disclaimer = $setting->disclaimer;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->image) {
            $this->logo_path = $this->image->storeAs('logo', 'logo.'.$this->image->getClientOriginalExtension(), 'public');
        }

        if ($this->isEditing) {
            $setting = Setting::first();
            $setting->logo_path = $this->logo_path;
            $setting->disclaimer = $this->disclaimer;
            $setting->save();
            session()->flash('message', 'Registro actualizado correctamente.');
        } else {
            $data = [
                'logo_path' => $this->logo_path,
                'disclaimer' => $this->disclaimer
            ];
            $setting = Setting::create($data);
            session()->flash('message', 'Registro insertado correctamente.');
        }
    }

    public function render()
    {
        return view('livewire.setting-form');
    }
}
