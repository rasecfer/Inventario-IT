<?php

namespace App\Livewire\Catalog;

use App\Models\Brand;
use App\Models\Classification;
use App\Models\DeviceModel;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Modelos')]
class DeviceModelForm extends Component
{
    public bool $isOpen = false;
    public bool $isEditing = false;
    public $brand_id = '';
    public $classification_id;
    public $description = '';
    public $deviceModel;

    #[Computed]
    public function brands(): Collection
    {
        return Brand::orderBy('name')->get();
    }

    #[Computed]
    public function classifications(): Collection
    {
        return Classification::orderBy('name')->get();
    }

    #[Computed]
    public function deviceModels(): Collection
    {
        return DeviceModel::with(['brand', 'classification'])->get();
    }

    public function newDeviceModel(): void
    {
        $this->resetValidation();
        $this->brand_id = '';
        $this->classification_id;
        $this->description = '';
        $this->isEditing = false;
        $this->isOpen = true;
    }

    public function close(): void
    {
        $this->isOpen = false;
    }

    protected function rules(): array
    {
        $rules = [
            'brand_id' => 'required|exists:brands,id',
            'classification_id' => 'required|exists:classifications,id',
            'description' => 'required|string|max:255'
        ];

        return $rules;
    }

    protected function messages(): array
    {
        return [
            'brand_id.required' => 'El campo Marca es requerido!',
            'classification_id.required' => 'El campo Clasificación es requerido!',
            'description.required' => 'El campo Descripción es requerido!',
            'description.max' => 'La longitud máxima es de 255 caracteres'
        ];
    }

    public function editDeviceModel(DeviceModel $deviceModel): void
    {
        $this->deviceModel = $deviceModel;
        $this->brand_id = $deviceModel->brand_id;
        $this->classification_id = $deviceModel->classification_id;
        $this->description = $deviceModel->description;
        $this->isEditing = true;
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $deviceModel = DeviceModel::findOrFail($this->deviceModel->id);
            $deviceModel->brand_id = $this->brand_id;
            $deviceModel->classification_id = $this->classification_id;
            $deviceModel->description = $this->description;
            $deviceModel->save();
            Flux::toast(
                heading: 'Mensaje',
                text: 'Registro actualizado correctamente.',
                duration: 2000,
                variant: 'success',
            );
        } else {
            $data = [
                'brand_id' => $this->brand_id,
                'classification_id' => $this->classification_id,
                'description' => $this->description
            ];
            DeviceModel::create($data);
            Flux::toast(
                heading: 'Mensaje',
                text: 'Registro creado correctamente.',
                duration: 2000,
                variant: 'success',
            );
        }
        $this->isEditing = false;

        $this->isOpen = false;
    }

    public function render()
    {
        if (! auth()->user()->can('view_model')) {
            abort(403, 'Acceso no autorizado!');
        }
        return view('livewire.catalog.device-model-form', [
            'deviceModels' => $this->deviceModels,
            'brands' => $this->brands,
            'classifications' => $this->classifications
        ]);
    }
}
