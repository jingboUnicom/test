@component('mail::message')
# You have a new Candidate

<div>
	<div><strong>Candidate ID:</strong> <span>{{ $candidate['id'] }}</span></div>
</div>

@component('mail::button', ['url' => config('app.url') . '/portal/candidates'])
Check Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent