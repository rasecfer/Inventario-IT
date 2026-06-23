<?php

namespace App\Livewire\Components;

use App\Enums\DeviceStatus;
use App\Models\Device;
use Livewire\Attributes\Computed;
use Livewire\Component;

class DeviceModal extends Component
{
    public $isOpen = false;

    public $search = '';

    protected $listeners = ['openDeviceModal' => 'showModal'];

    public function showModal(): void
    {
        $this->isOpen = true;
    }

    #[Computed]
    public function devices()
    {
        $query = Device::with('device_model')->where('status', DeviceStatus::Available);

        if ($this->search) {
            $query->where('serial_number', 'like', '%'.$this->search.'%');
        }

        return $query->paginate(10);
    }

    public function deviceSelected(Device $device)
    {
        $deviceLocked = Device::findOrFail($device->id);
        $deviceLocked->status = DeviceStatus::Locked;
        $deviceLocked->save();
        $this->close();
        $this->dispatch('deviceChanged', device: $device);
    }

    public function close(): void
    {
        $this->isOpen = false;
    }
    public function render()
    {
        return view('livewire.components.device-modal', [
            'devices' => $this->devices
        ]);
    }
}
