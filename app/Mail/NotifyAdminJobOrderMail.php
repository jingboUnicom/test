<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminJobOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $vacancy;
    public array $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Vacancy $vacancy, User $user)
    {
        $this->vacancy = $vacancy->toArray();
        $this->user = $user->toArray();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You have a new Job Order')->markdown('emails.admin.notify-job-order')->with([$this->vacancy, $this->user]);
    }
}
