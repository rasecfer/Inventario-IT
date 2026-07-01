<?php

namespace App\Livewire\Security;

use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Title('Usuarios')]
class UserForm extends Component
{
    public bool $isOpen = false;
    public bool $isEditing = false;
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $role_id;
    public $user;
    public $changePassword = false;

    #[Computed]
    public function users()
    {
        return User::all();
    }

    #[Computed]
    public function roles()
    {
        return Role::all();
    }

    public function newUser(): void
    {
        $this->resetValidation();
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->role_id = '';
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
            'name' => 'required|string|max:100',
            'role_id' => 'required'
        ];

        if ($this->isEditing) {
            $rules['email'] = ['required', 'email', Rule::unique('users')->ignore($this->user - Sid)];
        } else {
            $rules['email'] = ['required', 'email', Rule::unique('users')];
        }

        if (! $this->isEditing || $this->changePassword) {
            $rules['password'] = 'required|min:8';
            $rules['password_confirmation'] = 'required_with:password|same:password';
        }

        return $rules;
    }

    protected function messages(): array
    {
        return [
            'name.required' => 'El campo Nombre es requerido!',
            'name.string' => 'El campo Nombre debe ser tipo caracter',
            'name.max' => 'La longitud máxima es de 100 caracteres',
            'email.required' => 'El campo Correo-e es requerido!',
            'email.email' => 'El campo Correo-e debe tener el formato usuario@correo.com',
            'email.unique' => 'Ya existe un usuario con ese Correo-e',
            'role_id.required' => 'El campo Rol es requerido!',
            'password.required' => 'El campo Contraseña es requerido!',
            'password.min' => 'La longitud mínima es 8 caracteres!',
            'password_confirmation.required_with' => 'Debe confirmar la Contraseña!',
            'password_confirmation.same' => 'Las contraseñas no coinciden!'
        ];
    }

    public function editUser(User $user): void
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role_id = $user->roles->first()->pluck('id');
        $this->isEditing = true;
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();
        $role = Role::findOrFail($this->role_id);

        if ($this->isEditing) {
            $user = User::findOrFail($this->user->id);
            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = Hash::make($this->password);
            $user->save();
            $user->syncRoles($role);
            Flux::toast(
                heading: 'Mensaje',
                text: 'Registro actualizado correctamente.',
                duration: 2000,
                variant: 'success',
            );
        } else {
            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ];
            $user = User::create($data);
            $user->syncRoles($role);
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
        return view('livewire.security.user-form', [
            'users' => $this->users,
            'roles' => $this->roles
        ]);
    }
}
