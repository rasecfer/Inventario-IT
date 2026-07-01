<?php

namespace App\Livewire\Catalog;

use App\Models\Brand;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Marcas')]
class BrandForm extends Component
{
    public bool $isOpen = false;
    public bool $isEditing = false;
    public $name = '';
    public $brand;

    #[Computed]
    public function brands(): Collection
    {
        return Brand::all();
    }

    public function newBrand(): void
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

    public function editBrand(Brand $brand): void
    {
        $this->brand = $brand;
        $this->name = $brand->name;
        $this->isEditing = true;
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $brand = Brand::findOrFail($this->brand->id);
            $brand->name = $this->name;
            $brand->save();
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
            Brand::create($data);
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
        if (! auth()->user()->can('view_brand')) {
            abort(403, 'Acceso no autorizado!');
        }
        return view('livewire.catalog.brand-form', [
            'brands' => $this->brands
        ]);
    }
}
