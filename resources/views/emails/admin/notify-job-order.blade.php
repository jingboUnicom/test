@component('mail::message')
# You have a new Job Order

<div>
	<div><strong>Main Contact:</strong> <span>{{ $user['contact_name'] }}</span></div>
	<div><strong>Job Order ID:</strong> <span>{{ $vacancy['id'] }}</span></div>
</div>

@component('mail::button', ['url' => config('app.url') . '/portal/job-orders'])
Check Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent