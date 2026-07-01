<?php

namespace App\Livewire\Process;

use App\Models\Release;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Liberaciones')]
class ReleaseList extends Component
{
    public $search = '';

    #[Computed]
    public function releases()
    {
        $query = Release::with('release_details');

        if ($this->search) {
            $query->where('first_name', 'like', '%'.$this->search.'%')
                ->orWhere('last_name', 'like', '%'.$this->search.'%')
                ->orWhere('id', 'like', '%'.$this->search.'%');
        }

        return $query->orderBy('id', 'desc')->paginate(10);
    }

    public function printPdf($id = null)
    {
        $release = Release::findOrFail($id);
        $settings = Setting::firstOrFail();

        $pdf = Pdf::loadView('reports.release', [
            'release' => $release,
            'settings' => $settings
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Liberación'.$id.'.pdf');
    }
    public function render()
    {
        if (! auth()->user()->can('view_release')) {
            abort(403, 'Acceso no autorizado!');
        }
        return view('livewire.process.release-list', [
            'releases' => $this->releases
        ]);
    }
}
