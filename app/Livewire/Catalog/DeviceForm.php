<?php

namespace App\Livewire\Catalog;

use App\Enums\DeviceStatus;
use App\Models\Device;
use App\Models\DeviceModel;
use App\Models\Lease;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Equipos')]
class DeviceForm extends Component
{
    public $isEditing = false;
    public $device_id;
    public $device_model_id;
    public $lease_id;
    public $serial_number = '';
    public $status = DeviceStatus::Available;
    public $comments = '';

    protected function rules(): array
    {
        $rules = [
            'device_model_id' => 'required|exists:device_models,id',
            'lease_id' => 'required|exists:leases,id',
            'status' => ['required', Rule::enum(DeviceStatus::class)],
            'comments' => 'string|max:1000'
        ];

        if ($this->isEditing) {
            $rules['serial_number'] = ['required', 'string', Rule::unique('devices')->ignore($this->device_id)];
        } else {
            $rules['serial_number'] = ['required', 'string', Rule::unique('devices')];
        }

        return $rules;
    }

    #[Computed]
    public function deviceModels(): Collection
    {
        return DeviceModel::orderBy('description')->get();
    }

    #[Computed]
    public function leases(): Collection
    {
        return Lease::orderBy('description')->get();
    }

    public function loadDevice(): void
    {
        $device = Device::findOrFail($this->device_id);
        $this->device_model_id = $device->device_model_id;
        $this->lease_id = $device->lease_id;
        $this->serial_number = $device->serial_number;
        $this->status = $device->status;
        $this->comments = $device->comments;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'device_model_id' => $this->device_model_id,
            'lease_id' => $this->lease_id,
            'serial_number' => $this->serial_number,
            'status' => $this->status,
            'comments' => $this->comments,
            'user_id' => auth()->id()
        ];

        if ($this->isEditing) {
            $device = Device::findOrFail($this->device_id);
            $device->update($data);
            Flux::toast(
                heading: 'Mensaje',
                text: 'Registro actualizado correctamente.',
                duration: 2000,
                variant: 'success',
            );
        } else {
            Device::create($data);
            Flux::toast(
                heading: 'Mensaje',
                text: 'Registro creado correctamente.',
                duration: 2000,
                variant: 'success',
            );
        }

        return redirect()->route('devices');
    }

    public function mount($device_id = null): void
    {
        if ($device_id) {
            $this->isEditing = true;
            $this->device_id = $device_id;
            $this->loadDevice();
        }
    }

    public function render()
    {
        return view('livewire.catalog.device-form', [
            'deviceModels' => $this->deviceModels,
            'leases' => $this->leases
        ]);
    }
}
