<?php

namespace App\Livewire\Process;

use App\Enums\DeviceStatus;
use App\Models\Assignment;
use App\Models\AssignmentDetail;
use App\Models\Device;
use App\Models\Release;
use App\Models\ReleaseDetail;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Liberaciones')]
class ReleaseCreate extends Component
{
    public $assignment_id;
    public $employee_name = '';
    public $comments = '';
    public $detailsCol = [];

    #[On('assignmentChanged')]
    public function setAssignment(Assignment $assignment)
    {
        $this->assignment_id = $assignment->id;
        $this->employee_name = $assignment->last_name.', '.$assignment->first_name;
    }

    #[Computed]
    public function assignment_details()
    {
        return AssignmentDetail::where('assignment_id', $this->assignment_id)
            ->whereNull('release_details_id')->get();
    }

    protected function rules(): array
    {
        $rules = [
            'assignment_id' => 'required',
            'detailsCol' => 'required|array|min:1',
        ];

        return $rules;
    }

    public function save()
    {
        $this->validate();

        try {
            DB::transaction(function () {

                $assignment = Assignment::findOrFail($this->assignment_id);

                $line = 1;

                $data = [
                    'date' => now(),
                    'assignment_id' => $assignment->id,
                    'employee_id' => $assignment->employee_id,
                    'first_name' => $assignment->first_name,
                    'last_name' => $assignment->last_name,
                    'payroll_number' => $assignment->payroll_number,
                    'department_id' => $assignment->department_id,
                    'department_name' => $assignment->department_name,
                    'username' => $assignment->username,
                    'comments' => $this->comments,
                    'user_id' => auth()->id(),
                    'user_name' => auth()->user()->name
                ];

                $release = Release::create($data);

                $details = AssignmentDetail::whereIn('id', $this->detailsCol)->get();

                foreach ($details as $detail) {
                    $data_detail = [
                        'release_id' => $release->id,
                        'line' => $line,
                        'device_id' => $detail->device_id,
                        'assignment_detail_id' => $detail->id
                    ];

                    $release_detail = ReleaseDetail::create($data_detail);

                    $detail->release_details_id = $release_detail->id;
                    $detail->save();

                    $device = Device::findOrFail($detail->device_id);
                    $device->status = DeviceStatus::Available;
                    $device->save();

                    $line++;
                }
            });
        } catch (\Throwable $th) {
            dd($th);

            Flux::toast(
                heading: 'Error',
                text: 'Ocurrió un error al guardar el registro!',
                duration: 2000,
                variant: 'danger',
            );
        }

        Flux::toast(
            heading: 'Mensaje',
            text: 'Liberación creada correctamente!',
            duration: 2000,
            variant: 'success',
        );

        $this->reset();
    }
    public function render()
    {
        return view('livewire.process.release-create', [
            'assignment_details' => $this->assignment_details
        ]);
    }
}
