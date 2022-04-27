@component('mail::message')
# Employer Enquiry

<div>
	<div><strong>Company Name:</strong> <span>{{ $data['company_name'] }}</span></div>
	<div><strong>Position:</strong> <span>{{ $data['position'] }}</span></div>
	<div><strong>Given Name:</strong> <span>{{ $data['name'] }}</span></div>
	<div><strong>Family Name:</strong> <span>{{ $data['surname'] }}</span></div>
	<div><strong>Email Address:</strong> <span>{{ $data['email'] }}</span></div>
	<div><strong>Contact Number:</strong> <span>{{ $data['phone'] }}</span></div>
	<div><strong>Job Title:</strong> <span>{{ $data['job_title'] }}</span></div>
	<div><strong>Job Description:</strong> <span>{{ $data['job_description'] }}</span></div>
</div>

@component('mail::button', ['url' => config('app.url')])
Okay
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent