<?php

namespace App\Livewire\Process;

use App\Enums\DeviceStatus;
use App\Models\Assignment;
use App\Models\AssignmentDetail;
use App\Models\Device;
use App\Models\Employee;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Asignaciones')]
class AssignmentCreate extends Component
{
    public $employee;
    public $employee_name = '';
    public $username = '';
    public $devicesCol = [];
    public $comments = '';

    #[On('employeeChanged')]
    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;
        $this->employee_name = $this->employee->last_name.', '.$this->employee->first_name;
        $this->username = $this->employee->username;
    }

    #[On('deviceChanged')]
    public function addDevice(Device $device)
    {
        array_push($this->devicesCol, $device);
    }

    #[Computed]
    public function devices()
    {
        return $this->devicesCol;
    }

    public function removeDevice($deviceID)
    {
        $deviceTemp = Device::findOrFail($deviceID);
        $deviceTemp->status = DeviceStatus::Available;
        $deviceTemp->save();

        $this->devicesCol = array_filter($this->devicesCol, function ($deviceCol) use ($deviceID) {
            return $deviceCol->id !== $deviceID;
        });

    }

    protected function rules(): array
    {
        $rules = [
            'employee_name' => 'required',
            'devicesCol' => 'required|array|min:1',
        ];

        return $rules;
    }

    protected function messages(): array
    {
        return [
            'employee_name.required' => 'Debe seleccionar un empleado!',
            'devicesCol.required' => 'Debe agregar al menos un Equipo!'
        ];
    }

    public function save()
    {
        $this->validate();


        try {
            DB::transaction(function () {
                $line = 1;

                $data = [
                    'date' => now(),
                    'employee_id' => $this->employee->id,
                    'first_name' => $this->employee->first_name,
                    'last_name' => $this->employee->last_name,
                    'payroll_number' => $this->employee->payroll_number,
                    'department_id' => $this->employee->department->id,
                    'department_name' => $this->employee->department->name,
                    'username' => $this->employee->username,
                    'comments' => $this->comments,
                    'user_id' => auth()->id(),
                    'user_name' => auth()->user()->name
                ];

                $assignment = Assignment::create($data);

                foreach ($this->devicesCol as $deviceCol) {
                    $data_detail = [
                        'line' => $line,
                        'assignment_id' => $assignment->id,
                        'device_id' => $deviceCol->id
                    ];

                    AssignmentDetail::create($data_detail);

                    $device = Device::findOrFail($deviceCol->id);
                    $device->status = DeviceStatus::Assigned;
                    $device->save();

                    $line++;
                }
            });
        } catch (\Throwable $th) {
            Flux::toast(
                heading: 'Error',
                text: 'Ocurrió un error al guardar el registro!',
                duration: 2000,
                variant: 'danger',
            );
        }

        Flux::toast(
            heading: 'Mensaje',
            text: 'Asignación creada correctamente!',
            duration: 2000,
            variant: 'success',
        );

        $this->reset();
    }

    public function render()
    {
        return view('livewire.process.assignment-create', [
            'devices' => $this->devices
        ]);
    }
}
