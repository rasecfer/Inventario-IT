<?php

namespace App\Livewire;

use App\Enums\DeviceStatus;
use App\Models\Classification;
use App\Models\Device;
use App\Models\Lease;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Dashboard extends Component
{
    public $leases;
    public $available_devices;
    public $assigned_devices;

    public $percentage_assigned;

    public $top_3_classifications;

    public $classifications;
    public $lease_devices;

    public function loadData()
    {
        $this->leases = Lease::where('end_date', '>', now())->take(3)->get();

        $this->available_devices = Device::where('status', DeviceStatus::Available)->get()->count();

        $this->assigned_devices = Device::where('status', DeviceStatus::Assigned)->get()->count();

        $this->percentage_assigned = ($this->assigned_devices / $this->available_devices) * 100;

        $query = Classification::withCount(['devices' => function ($query) {
            $query->where('status', DeviceStatus::Available)
                ->orWhere('status', DeviceStatus::Assigned);
        }])->orderBy('devices_count', 'desc');

        $this->top_3_classifications = $query->take(3)->get();

        $this->classifications = $query->get();

        $this->lease_devices = Lease::withCount(['devices' => function ($query) {
            $query->where('status', DeviceStatus::Available)
                ->orWhere('status', DeviceStatus::Assigned);
        }])->get();

    }

    public function mount()
    {

        $this->loadData();
        //dd($this->classifications);
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
