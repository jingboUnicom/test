<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\State;
use App\Models\Vacancy;
use Livewire\Component;
use Statamic\Facades\Entry;
use Livewire\WithFileUploads;
use Statamic\Facades\GlobalSet;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class Job extends Component
{
    use WithFileUploads;

    public $vacancy;

    public $page;
    public $content;
    public $google;

    public $name;
    public $surname;
    public $email;
    public $phone;
    public $resume;
    public $cover_letter;
    public $google_recaptcha_token;

    public $show_error_recaptcha;
    public $show_message_success;
    public $show_message_failure;

    protected $listeners = ['setGoogleRecaptchaToken', 'hideMessageSuccess', 'hideMessageFailure'];

    public function mount($ja_ad_id)
    {
        $vacancy = Vacancy::where('ja_ad_id', $ja_ad_id)
            ->where('status', Vacancy::STATUS_SYNCED)
            ->whereHas('state', fn ($query) => $query->where('name', State::STATE_EXPIRED))
            ->first();

        if ($vacancy) {
            $this->vacancy = $vacancy;
        } else {
            abort(404);
        }

        $this->page = Entry::findBySlug('job', 'pages')->data()->all();
        $this->content = GlobalSet::findByHandle('job_board')->in('default')->data()->all();
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
                'name' => 'required',
                'surname' => 'required',
                'email' => 'required|email:rfc',
                'phone' => 'required',
                'resume' => 'file',
                'cover_letter' => 'file',
            ],
            [
                'name.required' => $this->content['error_name'],
                'surname.required' => $this->content['error_surname'],
                'email.required' => $this->content['error_email_1'],
                'email.email' => $this->content['error_email_2'],
                'phone.required' => $this->content['error_phone'],
                'resume.file' => $this->content['error_resume'],
                'cover_letter.file' => $this->content['error_cover_letter'],
            ]
        );

        try {
            $data['resume'] = $data['resume']->getRealPath();
            $data['cover_letter'] = $data['cover_letter']->getRealPath();

            $jobadder = app()->make('jobadder');
            $job_application = $jobadder->submitAJobApplication($this->vacancy->ja_ad_id, $data['name'], $data['surname'], $data['email'], $data['phone']);
            $job_application_documents_resume = $jobadder->submitJobApplicationDocuments($this->vacancy->ja_ad_id, $job_application['applicationId'], 'Resume', $data['resume']);
            $job_application_documents_cover_letter = $jobadder->submitJobApplicationDocuments($this->vacancy->ja_ad_id, $job_application['applicationId'], 'CoverLetter', $data['cover_letter']);

            $this->reset([
                'name',
                'surname',
                'email',
                'phone',
                'google_recaptcha_token',
                'show_error_recaptcha',
            ]);

            $this->resume = null;
            $this->cover_letter = null;

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

    public function render()
    {
        return view('livewire.job');
    }
}
