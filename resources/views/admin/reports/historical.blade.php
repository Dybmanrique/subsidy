<table>
    <thead>
        <tr>
            <th width="250px">SUBVENCIONES ({{ $year }})</th>
            <th width="100px">PRESUPUESTO</th>
            <th width="100px">BENEFICIARIOS</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($records as $record)
            <tr>
                <td>{{ $record->activity }}</td>
                <td>{{ $record->total_budget }}</td>
                <td>{{ $record->total_students + $record->total_graduates }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
