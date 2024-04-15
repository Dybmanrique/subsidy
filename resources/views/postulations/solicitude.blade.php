<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud</title>
    <style>
        @page {
            margin-left: 2cm;
            margin-right: 2cm;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-justify {
            text-align: justify;
        }
    </style>
</head>

<body>
    <h1 class="text-center">SOLICITUD DE SUBVENCIÓN</h1>
    {{-- <p class="text-right">SOLICITA: Subvención de: {{ $announcement_type }}</p>
    <p>SEÑORA VICERRECTORA DE INVESTIGACIÓN DE LA UNASAM Consuelo Teresa Valencia Vera S.V.</p>
    <p class="text-justify">Yo, {{ $user->name }} {{ $user->apellidos }} en mi calidad de estudiante/egresado de la
        {{ $user->student->school->faculty->nombre }}, Identificado con DNI: {{ $user->dni }}, con correo electrónico
        institucional: {{ $user->email }}, celular: {{ $user->celular }}, ante usted con el debido respeto me presento
        y digo:</p>
    <p class="text-justify">Que, habiendo tomado conocimiento de la {{ $announcement_name }} para ser
        subvencionado con el uso de Recursos determinados 2024 de la UNASAM, solicito a usted se me considere como
        participante en dicho concurso, con el proyecto, propuesta o Actividad titulado(a): ..., contanto como asesor o
        mentor(de ser el caso) a: ...</p>
    <p class="text-justify">Para tal fin cumplo con adjuntar la documentación mínima requerida por el reglamento de
        Concurso, sobre requisitos según corresponda</p>
    <p>POR TANTO:</p>
    <p class="text-justify">Ruego a usted señora, Vicerrectora de Investigación de la UNASAM, acceder a mi solicitud,
        por ser de justicia</p>
    @php
        $mounths_es = [
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Setiembre',
            'Octubre',
            'Noviembre',
            'Diciembre',
        ];
    @endphp
    <p>Huaraz, {{ date('d') }} de {{ $mounths_es[(int) date('m') - 1] }} 2024</p>
    <p>Nombres y apellidos: {{ $user->name }} {{ $user->apellidos }}</p>
    <p>Firma: ...</p>
    <p>DNI N.°: {{ $user->dni }}</p>
    <br>
    <p>Puede ver los documentos escaneando el siguiente código QR: </p>
    <img src="data:image/png;base64,{{ $qrcode }}">
    <p>O accediendo al siguiente enlace: {{ $url }}</p> --}}
</body>

</html>
