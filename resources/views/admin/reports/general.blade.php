<table>
    <tbody>
        <tr>
            <td colspan="4">{{ $activity->name }}</td>
        </tr>
        <tr>
            <td width="100px">Modalidad</td>
            <td width="200px">N° de postulantes</td>
            <td width="200px">N° de beneficiarios efectivos</td>
            <td width="150px">Monto ejecutado</td>
        </tr>
        <tr>
            <td >Estudiantes</td>
            <td >{{ ($activities_approved->students +  $activities_disapproved->students) ?? '0'}}</td>
            <td >{{ $activities_approved->students ?? '0' }}</td>
            <td rowspan="2">{{ $activities_approved->budget ?? '0' }}</td>
        </tr>
        <tr>
            <td >Graduados</td>
            <td >{{ ($activities_approved->graduates + $activities_disapproved->graduates) ?? '0' }}</td>
            <td >{{ $activities_approved->graduates ?? '0' }}</td>
        </tr>
    </tbody>
</table>
