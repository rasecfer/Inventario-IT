<?php

namespace App\Livewire\Catalog;

use App\Models\Classification;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Clasificaciones')]
class ClassificationForm extends Component
{
    public bool $isOpen = false;
    public bool $isEditing = false;
    public $name = '';
    public $classification;

    #[Computed]
    public function classifications(): Collection
    {
        return Classification::all();
    }

    public function newClassification(): void
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

    public function editClassification(Classification $classification): void
    {
        $this->classification = $classification;
        $this->name = $classification->name;
        $this->isEditing = true;
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $classification = Classification::findOrFail($this->classification->id);
            $classification->name = $this->name;
            $classification->save();
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
            Classification::create($data);
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
        return view('livewire.catalog.classification-form', [
            'classifications' => $this->classifications
        ]);
    }
}
