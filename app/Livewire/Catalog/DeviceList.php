<?php

namespace App\Livewire\Catalog;

use App\Models\Device;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Equipos')]
class DeviceList extends Component
{
    public $search = '';
    public $sortBy = 'id';

    public $sortDirection = 'asc';

    public function sortField($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection == "asc" ? "desc" : "asc";
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    #[Computed]
    public function devices()
    {
        $query = Device::with(['device_model', 'lease']);

        if ($this->search) {
            $query->where('serial_number', 'like', '%'.$this->search.'%');
        }

        return $query->orderBy($this->sortBy, $this->sortDirection)->paginate(10);
    }

    public function render()
    {
        if (! auth()->user()->can('view_device')) {
            abort(403, 'Acceso no autorizado!');
        }
        return view('livewire.catalog.device-list', [
            'devices' => $this->devices
        ]);
    }
}
