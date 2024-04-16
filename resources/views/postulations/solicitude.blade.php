<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud</title>
    <style>
        @page {
            margin-left: 2.5cm;
            margin-right: 2.5cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
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

        .font-uppercase {
            text-transform: uppercase;
        }

        .img-qr {
            max-width: 150px;
            padding-bottom: 10px;
            padding-right: 5px;
        }

        .text-qr {
            line-height: 0.5;
            vertical-align: bottom;
            margin-bottom: 0px;
            padding-bottom: 0px
        }

        .font-bold {
            font-weight: 700;
        }

        .title {
            font-weight: 700;
            text-align: center;
            font-size: 20px;
            padding-bottom: 25px;
        }

        .url {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <p class="title">SOLICITUD DE SUBVENCIÓN</p>
    <p class="text-right">SOLICITA: Subvención de {{ $postulation->activity->name }}</p>
    <p class="text-justify">SEÑOR(A) VICERRECTOR(A) DE INVESTIGACIÓN DE LA UNASAM <span
            class="font-uppercase">{{ $postulation->announcement->vicerrector->last_name }}
            {{ $postulation->announcement->vicerrector->name }}</span> S.V.</p>
    <table>

        <body>
            <td style="width: 70px">
            </td>
            <td>
                <p class="text-justify">Yo, {{ $user->name }} {{ $user->last_name }} en mi calidad de
                    {{ $user->student->condition }} de la
                    {{ $user->student->school->faculty->name }}, Identificado con DNI: {{ $user->student->dni }}, con
                    correo
                    electrónico
                    institucional: {{ $user->email }}, celular: {{ $user->student->phone }}, ante usted con el debido
                    respeto me
                    presento
                    y digo:</p>
            </td>
        </body>
    </table>


    <p class="text-justify">Que, habiendo tomado conocimiento de la {{ $postulation->announcement->name }} para ser
        subvencionado con el uso de Recursos determinados {{ date('Y') }} de la UNASAM, solicito a usted se me
        considere como
        participante en dicho concurso, con el proyecto, propuesta o Actividad titulado(a):</p>
    <p class="text-justify"> "{{ $postulation->name }}"
        @if ($postulation->adviser)
            , contanto como asesor o mentor a: {{ $postulation->adviser }}
        @else
            .
        @endif
    </p>
    <p class="text-justify">Para tal fin cumplo con adjuntar la documentación mínima requerida por el reglamento de
        Concurso, sobre requisitos según corresponda.</p>
    <p>POR TANTO:</p>
    <p class="text-justify">Ruego a usted señor(a), Vicerrector(a) de Investigación de la UNASAM, acceder a mi
        solicitud,
        por ser de justicia.</p>
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
    <p>Huaraz, {{ date('d') }} de {{ $mounths_es[(int) date('m') - 1] }} {{ date('Y') }}</p>
    <p>Nombres y apellidos: {{ $user->name }} {{ $user->last_name }}</p>
    <p>Firma: </p>
    <p>DNI N.°: {{ $user->student->dni }}</p>

    <p>Puede ver los documentos requeridos escaneando el siguiente código QR: </p>
    <table>
        <tbody>
            <td>
                <img src="data:image/png;base64,{{ $qrcode }}" class="img-qr">
            </td>
            <td class="text-qr">
                <p>O accediendo al siguiente enlace: </p>
                <p class="url">{{ $url }}</p>
            </td>
        </tbody>
    </table>
</body>

</html>
