<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Interview;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminInterviewMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $interview;
    public array $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Interview $interview, User $user)
    {
        $this->interview = $interview->toArray();
        $this->user = $user->toArray();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You have a new Interview Request')->markdown('emails.admin.notify-interview')->with([$this->interview, $this->user]);
    }
}
