<table>
    <tr>
        <td colspan='4'>{{ $activity->name }} ({{ $year }})</td>
    </tr>
    <tr>
        <td>N°</td>
        <td>FACULTAD</td>
        <td>N° BENEFICIARIOS</td>
        <td>PRESUPUESTO</td>
    </tr>
    @foreach ($records as $index => $record)
        <tr>
            <td width='20px'>{{ $index + 1 }}</td>
            <td width='200px'>{{ $record->faculty }}</td>
            <td width='120px'>{{ $record->total_students + $record->total_graduates }}</td>
            <td width='100px'>{{ $record->total_budget }}</td>
        </tr>
    @endforeach
</table>
