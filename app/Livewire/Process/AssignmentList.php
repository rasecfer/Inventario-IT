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
        return Assignment::orderBy('id', 'desc')->paginate(10);
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
        return view('livewire.process.assignment-list', [
            'assignments' => $this->assignments
        ]);
    }
}
