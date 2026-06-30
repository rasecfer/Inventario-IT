<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class DeviceExport implements FromArray
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        return $this->data;
    }
}
