<?php

namespace App\Livewire\Catalog;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Empleado')]
class EmployeeForm extends Component
{
    public $isEditing = false;
    public $employee_id;
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $payroll_number = '';
    public $username = '';
    public $is_active = true;
    public $is_external = false;
    public $department_id;

    protected function rules(): array
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'is_active' => 'required|boolean',
            'is_external' => 'required|boolean',
            'department_id' => 'required|exists:departments,id'
        ];

        if ($this->isEditing) {
            $rules['username'] = [
                'required',
                Rule::unique('employees')->ignore($this->employee_id)
            ];
            $rules['email'] = [
                'required',
                'email',
                Rule::unique('employees')->ignore($this->employee_id)
            ];
        } else {
            $rules['username'] = [
                'required',
                Rule::unique('employees')
            ];
            $rules['email'] = [
                'required',
                'email',
                Rule::unique('employees')
            ];
        }

        return $rules;
    }

    #[Computed]
    public function departments(): Collection
    {
        return Department::orderBy('name')->get();
    }

    public function loadEmployee(): void
    {
        $employee = Employee::findOrFail($this->employee_id);
        $this->first_name = $employee->first_name;
        $this->last_name = $employee->last_name;
        $this->department_id = $employee->department_id;
        $this->email = $employee->email;
        $this->username = $employee->username;
        $this->payroll_number = $employee->payroll_number;
        $this->is_active = $employee->is_active;
        $this->is_external = $employee->is_external;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'department_id' => $this->department_id,
            'email' => $this->email,
            'username' => $this->username,
            'payroll_number' => $this->payroll_number,
            'is_active' => $this->is_active,
            'is_external' => $this->is_external
        ];

        if ($this->is_external) {
            $data['payroll_number'] = '';
        }

        if ($this->isEditing) {
            $employee = Employee::findOrFail($this->employee_id);
            $employee->update($data);
            session()->flash('message', 'Empleado actualizado correctamente.');
        } else {
            Employee::create($data);
            session()->flash('message', 'Empleado creado correctamente.');
        }

        return redirect()->route('employees');
    }

    public function mount($employee_id = null): void
    {
        if ($employee_id) {
            $this->isEditing = true;
            $this->employee_id = $employee_id;
            $this->loadEmployee();
        }
    }

    public function render()
    {
        return view('livewire.catalog.employee-form', [
            'departments' => $this->departments
        ]);
    }
}
