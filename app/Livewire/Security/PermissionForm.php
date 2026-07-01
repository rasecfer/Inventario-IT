<?php

namespace App\Livewire\Security;

use Flux\Flux;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

#[Title('Permisos')]
class PermissionForm extends Component
{
    public $roles;
    public $permissions;
    public $newPermissions = [];
    public $roleId;

    protected function rules(): array
    {
        return [
            'roleId' => 'required',
            'newPermissions' => 'required|array|min:1'
        ];
    }

    protected function messages(): array
    {
        return [
            'roleId.required' => 'Debe seleccionar un rol!',
            'newPermissions.required' => 'Debe asignar al menos un permiso!'
        ];
    }

    public function mount(): void
    {
        $this->roles = Role::where('name', '!=', 'admin')->get();
        $this->permissions = Permission::all();
    }

    public function updatedRoleId()
    {
        //dd($this->roleId);
        if ($this->roleId) {
            $role = Role::findOrFail($this->roleId);
            $this->newPermissions = $role->permissions()->pluck('name')->toArray();
        }
    }

    public function save()
    {
        $this->validate();

        $role = Role::findOrFail($this->roleId);

        $role->syncPermissions($this->newPermissions);

        Flux::toast(
            heading: 'Mensaje',
            text: 'Permisos asignados correctamente.',
            duration: 2000,
            variant: 'success',
        );

        $this->reset(['newPermissions', 'roleId']);
    }
    public function render()
    {
        return view('livewire.security.permission-form');
    }
}
