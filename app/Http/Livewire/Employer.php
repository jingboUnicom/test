<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use App\Mail\EmployerMail;
use Statamic\Facades\GlobalSet;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class Employer extends Component
{
    public $content;
    public $google;
    public $recipients;

    public $company_name;
    public $position;
    public $name;
    public $surname;
    public $email;
    public $phone;
    public $job_title;
    public $job_description;
    public $google_recaptcha_token;

    public $show_error_recaptcha;
    public $show_message_success;
    public $show_message_failure;

    protected $listeners = ['setGoogleRecaptchaToken', 'hideMessageSuccess', 'hideMessageFailure'];

    public function mount(): void
    {
        $this->content = GlobalSet::findByHandle('employer')->in('default')->data()->all();
        $this->google = GlobalSet::findByHandle('google')->in('default')->data()->all();
        $this->recipients = GlobalSet::findByHandle('employer')->in('default')->data()->get('recipients');
    }

    public function setGoogleRecaptchaToken($token): void
    {
        $this->google_recaptcha_token = $token;

        $result = Http::post('https://www.google.com/recaptcha/api/siteverify?secret=' . $this->google['google_recaptcha_secret_key'] . '&response=' . $this->google_recaptcha_token)->json();

        if ($result['success'] && ($result['score'] > 0.3)) {
            $this->show_error_recaptcha = false;
            $this->submit();
        } else {
            $this->show_error_recaptcha = true;
        }
    }

    public function submit(): void
    {
        $data = $this->validate(
            [
                'company_name' => 'required',
                'position' => 'required',
                'name' => 'required',
                'surname' => 'required',
                'email' => 'required|email:rfc',
                'phone' => 'required',
                'job_title' => 'required',
                'job_description' => 'required',
            ],
            [
                'company_name.required' => $this->content['error_company_name'],
                'position.required' => $this->content['error_position'],
                'name.required' => $this->content['error_name'],
                'surname.required' => $this->content['error_surname'],
                'email.required' => $this->content['error_email_1'],
                'email.email' => $this->content['error_email_2'],
                'phone.required' => $this->content['error_phone'],
                'job_title.required' => $this->content['error_job_title'],
                'job_description.required' => $this->content['error_job_description'],
            ]
        );

        try {
            foreach ($this->recipients as $recipient) {
                Mail::to($recipient['email'], $recipient['name'])->queue(new EmployerMail($data));
            }

            $this->reset([
                'company_name',
                'position',
                'name',
                'surname',
                'email',
                'phone',
                'job_title',
                'job_description',
                'google_recaptcha_token',
                'show_error_recaptcha',
            ]);

            $this->show_message_success = true;
        } catch (Exception $e) {
            Log::error($e);
            $this->show_message_failure = true;
        }
    }

    public function hideMessageSuccess(): void
    {
        $this->show_message_success = false;
    }

    public function hideMessageFailure(): void
    {
        $this->show_message_failure = false;
    }

    public function render(): View
    {
        return view('livewire.employer');
    }
}
