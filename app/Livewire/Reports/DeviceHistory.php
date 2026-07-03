<?php

namespace App\Livewire\Reports;

use App\Models\AssignmentDetail;
use App\Models\Device;
use App\Models\DisposalDetail;
use App\Models\ReleaseDetail;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Historial')]
class DeviceHistory extends Component
{
    use WithPagination;
    public $search = '';
    public $isOpen = false;
    public $serial_number = '';
    public $details = '';
    public $timeline = [];

    #[Computed]
    public function devices()
    {
        $query = Device::with('device_model');

        if ($this->search) {
            $query->where('serial_number', 'like', '%'.$this->search.'%');
        }

        return $query->orderBy('id', 'asc')->paginate(10);
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function deviceSelected($id)
    {
        $device = Device::findOrFail($id);
        $this->serial_number = $device->serial_number;
        $this->details = $device->device_model->brand->name.'/'.$device->device_model->classification->name.'/'.$device->device_model->description;

        $data = [
            'type' => 'Alta',
            'date' => $device->created_at->format('Y-m-d'),
            'comments' => $device->comments,
            'employee' => '',
            'id' => $device->id,
            'order' => '00'
        ];

        $this->timeline = [];

        array_push($this->timeline, $data);

        // Assignments
        $assignments = AssignmentDetail::where('device_id', $device->id)->get();
        if ($assignments) {
            foreach ($assignments as $assignment) {
                $data = [
                    'type' => 'Asignación',
                    'date' => $assignment->assignment->date,
                    'comments' => $assignment->assignment->comments,
                    'employee' => $assignment->assignment->last_name.', '.$assignment->assignment->first_name,
                    'id' => $assignment->assignment_id,
                    'order' => '1'.$assignment->assignment_id
                ];
                array_push($this->timeline, $data);
            }
        }

        $releases = ReleaseDetail::where('device_id', $device->id)->get();
        if ($releases) {
            foreach ($releases as $release) {
                $data = [
                    'type' => 'Liberación',
                    'date' => $release->release->date,
                    'comments' => $release->release->comments,
                    'employee' => $release->release->last_name.', '.$release->release->first_name,
                    'id' => $release->release_id,
                    'order' => '2'.$release->release_id
                ];
                array_push($this->timeline, $data);
            }
        }

        $disposals = DisposalDetail::where('device_id', $device->id)->get();
        if ($disposals) {
            foreach ($disposals as $disposal) {
                $data = [
                    'type' => 'Baja',
                    'date' => $disposal->disposal->date,
                    'comments' => $disposal->disposal->comments,
                    'employee' => '',
                    'id' => $disposal->disposal_id,
                    'order' => '3'.$disposal->disposal_id
                ];
                array_push($this->timeline, $data);
            }
        }

        $dates = array_column($this->timeline, 'date');
        $orders = array_column($this->timeline, 'order');

        array_multisort($dates, SORT_ASC, $orders, SORT_ASC, $this->timeline);

        //dd($this->timeline);
        $this->close();
    }

    public function render()
    {
        return view('livewire.reports.device-history', [
            'devices' => $this->devices
        ]);
    }
}
