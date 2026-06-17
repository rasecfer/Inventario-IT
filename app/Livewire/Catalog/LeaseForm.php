<?php

namespace App\Livewire\Catalog;

use App\Models\Lease;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Arrendamientos')]
class LeaseForm extends Component
{
    public bool $isOpen = false;
    public bool $isEditing = false;
    public $description = '';
    public $start_date = null;
    public $end_date = null;
    public $is_active = true;

    public $lease;

    #[Computed]
    public function leases(): Collection
    {
        return Lease::all();
    }

    public function newLease(): void
    {
        $this->resetValidation();
        $this->description = '';
        $this->start_date = null;
        $this->end_date = null;
        $this->is_active = true;
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
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ];

        return $rules;
    }

    public function editLease(Lease $lease): void
    {
        $this->lease = $lease;
        $this->description = $lease->description;
        $this->start_date = $lease->start_date;
        $this->end_date = $lease->end_date;
        $this->is_active = $lease->is_active;
        $this->isEditing = true;
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $lease = Lease::findOrFail($this->lease->id);
            $lease->description = $this->description;
            $lease->start_date = $this->start_date;
            $lease->end_date = $this->end_date;
            $lease->is_active = $this->is_active;
            $lease->save();
            Flux::toast(
                heading: 'Mensaje',
                text: 'Registro actualizado correctamente.',
                duration: 2000,
                variant: 'success',
            );
        } else {
            $data = [
                'description' => $this->description,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'is_active' => $this->is_active
            ];
            Lease::create($data);
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
        return view('livewire.catalog.lease-form', [
            'leases' => $this->leases
        ]);
    }
}
