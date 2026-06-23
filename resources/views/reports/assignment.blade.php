<!doctype html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Asignación_{{ $assignment->id }}</title>

        <style>
            @page {
                margin: 10px 50px;
            }
        </style>

    </head>

    <body>
        <table style="width: 100%;">
            <tr>
                <td style="width:35%">
                    <img style="width: 200px; height: 100px;" src="{{ public_path('storage/' . $settings->logo_path) }}"
                        alt="Company" />
                </td>
                <td style="width: 65%" align="right">
                    <div style="text-align: left;">
                        <h2 style="font-weight: bold; font-size: 28px; color: #0d47a1;">
                            Carta de Asignación de Equipo
                        </h2>
                    </div>
                    <div style="text-align: right;">
                        <h2 style="color: #0d47a1">Folio: {{ $assignment->id }}</h2>
                    </div>
                </td>
            </tr>
        </table>

        <hr style="color:#0d47a1">

        <div style="text-align: right">
            <p>
                Departamento: {{ $assignment->department_name }}
            </p>
            <p>
                Fecha: {{ \Carbon\Carbon::parse($assignment->date)->format('d/m/Y') }}
            </p>
        </div>

        <table border="1" cellpadding="8" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #0d47a1; color: #ffffff; font-weight: bold;">
                    <td>Marca</td>
                    <td>Clasificación</td>
                    <td>Modelo</td>
                    <td># Serie</td>
                </tr>
            </thead>
            @php
                $lines = 0;
            @endphp
            <tbody>
                @foreach ($assignment->assignment_details as $item)
                    <tr>
                        <td>{{ $item->device->device_model->brand->name }}</td>
                        <td>{{ $item->device->device_model->classification->name }}</td>
                        <td>{{ $item->device->device_model->description }}</td>
                        <td>{{ $item->device->serial_number }}</td>
                    </tr>
                    @php
                        $lines++;
                    @endphp
                @endforeach
            </tbody>
        </table>

        @for ($i = $lines; $i < 20; $i++)
            <div>&nbsp;</div>
        @endfor

        <table border="1" cellpadding="8" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #0d47a1; color: #ffffff; font-weight: bold;">
                    <td>Comentarios</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Prueba de comentarios</td>
                </tr>
            </tbody>
        </table>

        <p>
            {{ $settings->disclaimer }}
        </p>

        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>

        <table style="width: 100%">
            <tr>
                <td width="45%">
                    <hr style="color:#0d47a1">
                </td>
                <td width="10%"></td>
                <td width="45%">
                    <hr style="color:#0d47a1">
                </td>
            </tr>
            <tr>
                <td width="45%" align="center">
                    Entrega Departamento de TI
                </td>
                <td width="10%"></td>
                <td width="45%" align="center">
                    {{ $assignment->last_name }}, {{ $assignment->first_name }}
                </td>
            </tr>
        </table>

    </body>

</html>
