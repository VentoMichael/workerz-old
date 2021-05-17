<tr>
<td class="header">
<a href="{{ env('APP_URL') }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{asset('svg/logo.svg')}}" class="logo" alt="Workerz Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
