<?php

namespace App\Mail;

use App\Models\Candidate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyEmployerCandidateMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $candidate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate->toArray();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You have a new Candidate')->markdown('emails.employer.notify-candidate')->with($this->candidate);
    }
}
