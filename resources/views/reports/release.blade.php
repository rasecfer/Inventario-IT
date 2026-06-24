<!doctype html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Liberación{{ $release->id }}</title>

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
                            Carta de Liberación de Equipo
                        </h2>
                    </div>
                    <div style="text-align: right;">
                        <h2 style="color: #0d47a1">Folio: {{ $release->id }}</h2>
                    </div>
                </td>
            </tr>
        </table>

        <hr style="color:#0d47a1">

        <div style="text-align: right">
            <p>
                Departamento: {{ $release->department_name }}
            </p>
            <p>
                Fecha: {{ \Carbon\Carbon::parse($release->date)->format('d/m/Y') }}
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
                @foreach ($release->release_details as $item)
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
                    <td>{{ $release->comments }}</td>
                </tr>
            </tbody>
        </table>

        <p>
            Con esta Carta de Liberación el Departamento de IT y el usuario están de acuerdo con la entrega del equipo y
            las condiciones en que se entrega. Servirá al usuario como comprobante de no adeudo de equipo, con las
            excepciones descritas en los "comentarios" de la misma, mismos que deberán aclararse con el departamento de
            Recursos Humanos.
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
                    {{ $release->last_name }}, {{ $release->first_name }}
                </td>
                <td width="10%"></td>
                <td width="45%" align="center">
                    Recibe Departamento de TI
                </td>
            </tr>
        </table>

    </body>

</html>
