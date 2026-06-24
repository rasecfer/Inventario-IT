<?php

namespace App\Livewire\Process;

use App\Enums\DeviceStatus;
use App\Models\Device;
use App\Models\Disposal;
use App\Models\DisposalDetail;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Bajas')]
class DisposalCreate extends Component
{
    public $comments = '';
    public $devicesCol = [];
    public $status;

    #[On('deviceChanged')]
    public function addDevice(Device $device)
    {
        array_push($this->devicesCol, $device);
    }

    #[Computed]
    public function devices()
    {
        return $this->devicesCol;
    }

    public function removeDevice($deviceID)
    {
        $deviceTemp = Device::findOrFail($deviceID);
        $deviceTemp->status = DeviceStatus::Available;
        $deviceTemp->save();

        $this->devicesCol = array_filter($this->devicesCol, function ($deviceCol) use ($deviceID) {
            return $deviceCol->id !== $deviceID;
        });

    }

    protected function rules(): array
    {
        $rules = [
            'status' => ['required', Rule::enum(DeviceStatus::class)],
            'devicesCol' => 'required|array|min:1',
        ];

        return $rules;
    }

    protected function messages(): array
    {
        return [
            'status.required' => 'El campo Estado es requerido!',
            'devicesCol.required' => 'Debe agregar al menos un Equipo!'
        ];
    }

    public function save()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                $data = [
                    'date' => now(),
                    'comments' => $this->comments,
                    'user_id' => auth()->id(),
                    'user_name' => auth()->user()->name,
                ];

                $disposal = Disposal::create($data);

                $line = 0;

                foreach ($this->devicesCol as $deviceCol) {
                    $data_detail = [
                        'line' => $line,
                        'disposal_id' => $disposal->id,
                        'device_id' => $deviceCol->id,
                        'status' => $this->status
                    ];

                    DisposalDetail::create($data_detail);

                    $device = Device::findOrFail($deviceCol->id);
                    $device->status = $this->status;
                    $device->save();

                    $line++;
                }

            });
        } catch (\Throwable $th) {
            dd($th);
            Flux::toast(
                heading: 'Error',
                text: 'Ocurrió un error al guardar el registro!',
                duration: 2000,
                variant: 'danger',
            );
            return;
        }
        Flux::toast(
            heading: 'Mensaje',
            text: 'Asignación creada correctamente!',
            duration: 2000,
            variant: 'success',
        );

        $this->reset();
    }

    public function render()
    {
        return view('livewire.process.disposal-create', [
            'devices' => $this->devices
        ]);
    }
}
