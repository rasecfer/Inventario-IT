<?php

namespace App\Livewire\Reports;

use App\Enums\DeviceStatus;
use App\Exports\DeviceExport;
use App\Models\Classification;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

#[Title('Listado')]
class DeviceListing extends Component
{
    public $search;
    public bool $isOpen = false;
    public $statusCol = [];
    public $classificationCol = [];
    public $devices;

    public function getDevices()
    {
        $query_str = 'SELECT b.name as Brand, c.name as Classification, m.description as Model, d.serial_number as Serial, d.id as Id, CASE WHEN d.status = "AS" THEN (SELECT concat(last_name, first_name) FROM assignments INNER JOIN assignment_details ON assignment_details.assignment_id = assignments.id WHERE assignment_details.device_id = d.id ORDER BY assignment_id DESC LIMIT 1) END AS Empleado, d.status as Status FROM devices d INNER JOIN device_models m ON d.device_model_id = m.id INNER JOIN brands b ON b.id = m.brand_id INNER JOIN classifications c ON c.id = m.classification_id';

        if ($this->statusCol) {
            $statusIds = '';
            foreach ($this->statusCol as $value) {
                // Utiliza implode para construir un string con el separador que necesites
                $statusIds .= '"'.$value.'",';
            }
            $statusIds = substr($statusIds, 0, -1);
            $query_str .= ' WHERE d.status IN ('.$statusIds.') AND ';
        } else {
            $query_str .= " WHERE d.status LIKE '%%' AND ";
        }

        if ($this->classificationCol) {
            $classificationIds = '';
            foreach ($this->classificationCol as $value) {
                // Utiliza implode para construir un string con el separador que necesites
                $classificationIds .= '"'.$value.'",';
            }
            $classificationIds = substr($classificationIds, 0, -1);
            $query_str .= ' c.id IN ('.$classificationIds.')';
        } else {
            $query_str .= " c.id LIKE '%%'";
        }

        if ($this->search) {
            $query_str .= " HAVING Empleado LIKE '%".$this->search."%'";
            $query_str .= " OR Model Like '%".$this->search."%'";
        }
        $query = DB::select($query_str);

        //dd($query);
        $this->devices = $query;
    }

    #[Computed]
    public function classifications()
    {
        return Classification::orderBy('name', 'asc')->get();
    }

    public function openFilters(): void
    {
        $this->isOpen = true;
    }

    public function closeFilters(): void
    {
        $this->isOpen = false;
    }

    public function applyFilters()
    {
        $this->getDevices();
        $this->closeFilters();
    }

    public function updatedSearch()
    {
        $this->getDevices();
    }

    public function mount(): void
    {
        $this->getDevices();
    }

    public function exportExcel()
    {
        $arrayData[] = ['Marca', 'Clasificación', 'Modelo', 'No. Serie', 'Empleado', 'Estado'];

        foreach ($this->devices as $device) {
            $arrayData[] = [
                $device->Brand,
                $device->Classification,
                $device->Model,
                $device->Serial,
                $device->Empleado ? $device->Empleado : '',
                DeviceStatus::tryFrom($device->Status)->label()
            ];
        }

        return Excel::download(new DeviceExport($arrayData), 'Equipos.xlsx');
    }

    public function render()
    {
        return view('livewire.reports.device-listing', [
            'devices' => $this->devices,
            'classifications' => $this->classifications
        ]);
    }
}
