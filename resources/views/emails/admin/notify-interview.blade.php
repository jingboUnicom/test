@component('mail::message')
# You have a new Interview Request

<div>
	<div><strong>Main Contact:</strong> <span>{{ $user['contact_name'] }}</span></div>
	<div><strong>Interview ID:</strong> <span>{{ $interview['id'] }}</span></div>
</div>

@component('mail::button', ['url' => config('app.url') . '/portal/interviews'])
Check Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent