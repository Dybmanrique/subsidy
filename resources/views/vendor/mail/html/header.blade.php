@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
{{-- <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo"> --}}
<p style='text-align: center; font-size: 30px'><span style='font-weight: 700;'>SUBVENCIONES</span> UNASAM</p>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
