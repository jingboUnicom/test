@component('mail::message')
# Contact Us Enquiry

<div>
	<div><strong>Given Name:</strong> <span>{{ $data['name'] }}</span></div>
	<div><strong>Family Name:</strong> <span>{{ $data['surname'] }}</span></div>
	<div><strong>Email Address:</strong> <span>{{ $data['email'] }}</span></div>
	<div><strong>Contact Number:</strong> <span>{{ $data['phone'] }}</span></div>
	<div><strong>Query:</strong> <span>{{ $data['enquiry'] }}</span></div>
	<div><strong>Message:</strong> <span>{{ $data['notes'] }}</span></div>
</div>

@component('mail::button', ['url' => config('app.url')])
Okay
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent