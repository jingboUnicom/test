@component('mail::message')
# You have a new Candidate

<div>
	<div><strong>Candidate Name:</strong> <span>{{ $data['candidate_name'] }}</span></div>
</div>

@component('mail::button', ['url' => config('app.url') . '/portal/candidates'])
Check Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent