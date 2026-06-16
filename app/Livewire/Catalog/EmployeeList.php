<?php

namespace App\Livewire\Catalog;

use App\Models\Employee;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Empleados')]
class EmployeeList extends Component
{
    // public $employees = [];
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
    public function employees()
    {
        $query = Employee::with('department');

        if ($this->search) {
            $query->where('first_name', 'like', '%'.$this->search.'%')
                ->orWhere('last_name', 'like', '%'.$this->search.'%');
        }

        return $query->orderBy($this->sortBy, $this->sortDirection)->paginate(10);
    }

    public function mount(): void
    {
        //$this->employees = Employee::with('department')->get();
    }
    public function render()
    {
        return view('livewire.catalog.employee-list', [
            'employees' => $this->employees
        ]);
    }
}
