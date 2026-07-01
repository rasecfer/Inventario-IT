<?php

namespace App\Livewire\Process;

use App\Models\Assignment;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title('Asignaciones')]
class AssignmentList extends Component
{

    public $search = '';

    #[Computed]
    public function assignments()
    {
        $query = Assignment::with('assignment_details');

        if ($this->search) {
            $query->where('first_name', 'like', '%'.$this->search.'%')
                ->orWhere('last_name', 'like', '%'.$this->search.'%')
                ->orWhere('id', 'like', '%'.$this->search.'%');
        }

        return $query->orderBy('id', 'desc')->paginate(10);
    }

    public function printPdf($id = null)
    {
        $assignment = Assignment::findOrFail($id);
        $settings = Setting::firstOrFail();

        $pdf = Pdf::loadView('reports.assignment', [
            'assignment' => $assignment,
            'settings' => $settings
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Asignacion_'.$id.'.pdf');
    }

    public function render()
    {
        if (! auth()->user()->can('view_assignment')) {
            abort(403, 'Acceso no autorizado!');
        }
        return view('livewire.process.assignment-list', [
            'assignments' => $this->assignments
        ]);
    }
}
