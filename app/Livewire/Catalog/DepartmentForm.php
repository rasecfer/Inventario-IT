<?php

namespace App\Livewire\Catalog;

use App\Models\Department;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Departamentos')]
class DepartmentForm extends Component
{

    public bool $isOpen = false;
    public bool $isEditing = false;
    public $name = '';
    public $department;

    #[Computed]
    public function departments(): Collection
    {
        return Department::all();
    }

    public function newDepartment(): void
    {
        $this->resetValidation();
        $this->name = '';
        $this->isEditing = false;
        $this->isOpen = true;
    }

    public function close(): void
    {
        $this->isOpen = false;
    }

    protected function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:100'
        ];

        return $rules;
    }

    protected function messages(): array
    {
        return [
            'name.required' => 'El campo Nombre es requerido!',
            'name.string' => 'El campo Nombre debe ser tipo caracter',
            'name.max' => 'La longitud máxima es de 100 caracteres'
        ];
    }

    public function editDepartment(Department $department): void
    {
        $this->department = $department;
        $this->name = $department->name;
        $this->isEditing = true;
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $department = Department::findOrFail($this->department->id);
            $department->name = $this->name;
            $department->save();
            Flux::toast(
                heading: 'Mensaje',
                text: 'Registro actualizado correctamente.',
                duration: 2000,
                variant: 'success',
            );
        } else {
            $data = [
                'name' => $this->name
            ];
            Department::create($data);
            Flux::toast(
                heading: 'Mensaje',
                text: 'Registro creado correctamente.',
                duration: 2000,
                variant: 'success',
            );
        }
        $this->isEditing = false;

        $this->isOpen = false;
    }

    public function mount(): void
    {
        //$this->departments = Department::all();
    }

    public function render()
    {
        if (! auth()->user()->can('view_department')) {
            abort(403, 'Acceso no autorizado!');
        }
        return view('livewire.catalog.department-form', [
            'departments' => $this->departments
        ]);
    }
}
