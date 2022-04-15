<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subscriber;
use Statamic\Facades\GlobalSet;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;

class Subscribers extends Component
{
    public $content;
    public $google;

    public $email;
    public $google_recaptcha_token;

    public $show_error_recaptcha;
    public $show_message_success;
    public $show_message_failure;

    protected $listeners = ['setGoogleRecaptchaToken', 'hideMessageSuccess', 'hideMessageFailure'];

    public function mount(): void
    {
        $this->content = GlobalSet::findByHandle('newsletter')->in('default')->data()->all();
        $this->google = GlobalSet::findByHandle('google')->in('default')->data()->all();
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
                'email' => 'required|email:rfc|unique:subscribers,email',
            ],
            [
                'email.required' => $this->content['error_email_1'],
                'email.email' => $this->content['error_email_2'],
                'email.unique' => $this->content['error_email_3'],
            ]
        );

        $subscriber = Subscriber::create([
            'email' => $data['email'],
        ])->save();

        if ($subscriber) {
            $this->reset([
                'email',
                'google_recaptcha_token',
                'show_error_recaptcha',
            ]);

            $this->show_message_success = true;
        } else {
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
        return view('livewire.subscribers');
    }
}
