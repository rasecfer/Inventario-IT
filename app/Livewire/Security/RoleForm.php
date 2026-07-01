<?php

namespace App\Livewire\Security;

use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Title('Roles')]
class RoleForm extends Component
{
    public bool $isOpen = false;
    public bool $isEditing = false;
    public $name = '';
    public $role;

    #[Computed]
    public function roles()
    {
        return Role::where('name', '!=', 'admin')->get();
    }

    public function newRole(): void
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

    public function editRole(Role $role): void
    {
        $this->role = $role;
        $this->name = $role->name;
        $this->isEditing = true;
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $role = Role::findOrFail($this->role->id);
            $role->name = $this->name;
            $role->save();
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
            Role::create($data);
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

    public function render()
    {
        return view('livewire.security.role-form', [
            'roles' => $this->roles
        ]);
    }
}
