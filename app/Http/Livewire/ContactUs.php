<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use App\Mail\ContactUsMail;
use Statamic\Facades\GlobalSet;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ContactUs extends Component
{
    public $content;
    public $google;
    public $company;
    public $recipients;

    public $name;
    public $surname;
    public $email;
    public $phone;
    public $enquiry;
    public $notes;
    public $google_recaptcha_token;

    public $show_error_recaptcha;
    public $show_message_success;
    public $show_message_failure;

    protected $listeners = ['setGoogleRecaptchaToken', 'hideMessageSuccess', 'hideMessageFailure'];

    public function mount(): void
    {
        $this->content = GlobalSet::findByHandle('contact_us')->in('default')->data()->all();
        $this->google = GlobalSet::findByHandle('google')->in('default')->data()->all();
        $this->company = GlobalSet::findByHandle('company')->in('default')->data()->all();
        $this->recipients = GlobalSet::findByHandle('contact_us')->in('default')->data()->get('recipients');
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
                'name' => 'required',
                'surname' => 'required',
                'email' => 'required|email:rfc',
                'phone' => 'required',
                'enquiry' => 'required',
                'notes' => 'required',
            ],
            [
                'name.required' => $this->content['error_name'],
                'surname.required' => $this->content['error_surname'],
                'email.required' => $this->content['error_email_1'],
                'email.email' => $this->content['error_email_2'],
                'phone.required' => $this->content['error_phone'],
                'enquiry.required' => $this->content['error_enquiry'],
                'notes.required' => $this->content['error_notes'],
            ]
        );

        try {
            foreach ($this->recipients as $recipient) {
                Mail::to($recipient['email'], $recipient['name'])->queue(new ContactUsMail($data));
            }

            $this->reset([
                'name',
                'surname',
                'email',
                'phone',
                'enquiry',
                'notes',
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
        return view('livewire.contact-us');
    }
}
