<table>
    <tr>
        <td>{{ $activity->name }} ({{ $year }})</td>
        <td>Beneficiarios</td>
        <td>Presupuesto</td>
    </tr>
    <tr>
        <td style="font-weight: 700" width="400px">{{ $faculty->name }}</td>
        <td style="font-weight: 700" width="100px">{{ $total_students }}</td>
        <td style="font-weight: 700" width="100px">{{ $total_budget }}</td>
    </tr>
    @foreach ($records as $record)
        <tr>
            <td style="font-weight: 700">{{ $record->school }}</td>
            <td style="font-weight: 700">{{ $record->total_students + $record->total_graduates }}</td>
            <td style="font-weight: 700">{{ $record->total_budget }}</td>
        </tr>
        <tr>
            <td>Estudiantes</td>
            <td>{{ $record->total_students }}</td>
            <td></td>
        </tr>
        <tr>
            <td>Graduados</td>
            <td>{{ $record->total_graduates }}</td>
            <td></td>
        </tr>
    @endforeach
</table>
