<?php

namespace App\Livewire\Components;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class EmployeeModal extends Component
{
    public $isOpen = false;

    public $search = '';

    protected $listeners = ['openModal' => 'showModal'];

    public function showModal(): void
    {
        $this->isOpen = true;
    }

    #[Computed]
    public function employees()
    {
        $query = Employee::with('department')->where('is_active', true);

        if ($this->search) {
            $query->where('first_name', 'like', '%'.$this->search.'%')
                ->orWhere('last_name', 'like', '%'.$this->search.'%');
        }

        return $query->paginate(10);
    }

    public function employeeSelected(Employee $employee)
    {
        $this->close();
        $this->dispatch('employeeChanged', employee: $employee);
    }

    public function close(): void
    {
        $this->isOpen = false;
    }
    public function render()
    {
        return view('livewire.components.employee-modal', [
            'employees' => $this->employees
        ]);
    }
}
