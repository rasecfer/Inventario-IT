<?php

namespace App\Livewire\Components;

use App\Models\Assignment;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AssignmentModal extends Component
{
    public $isOpen = false;

    public $search = '';

    protected $listeners = ['openAssignmentModal' => 'showModal'];

    public function showModal(): void
    {
        $this->isOpen = true;
    }

    #[Computed]
    public function assignments()
    {
        $records = Assignment::whereHas('assignment_details', function ($query) {
            $query->whereNull('release_details_id');
        });

        if ($this->search) {
            $records->where('id', 'like', '%'.$this->search.'%')
                ->orWhere('first_name', 'like', '%'.$this->search.'%')
                ->orWhere('last_name', 'like', '%'.$this->search.'%');
        }

        return $records->orderBy('id', 'desc')->paginate(10);
    }

    public function assignmentSelected(Assignment $assignment)
    {
        $this->close();
        $this->dispatch('assignmentChanged', assignment: $assignment);
    }

    public function close(): void
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.components.assignment-modal', [
            'assignments' => $this->assignments
        ]);
    }
}
