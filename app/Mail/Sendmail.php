<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\View;

class Sendmail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    /**
     * Create a new message instance.
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->mailData['title'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        if ($this->mailData['title'] === 'Forget Password') {
            $view2Content = View::make('forgetPass', ['mailData' => $this->mailData])->render();
            $this->subject('Forget Password');
            return $this->subject($this->mailData['title'])
                ->html($view2Content);
        } elseif ($this->mailData['title'] === 'New Account') {
            $view3Content = View::make('newAccount', ['mailData' => $this->mailData])->render();
            $this->subject('New Account');
            return $this->subject($this->mailData['title'])
                ->html($view3Content);
        } elseif ($this->mailData['title'] === 'Leave Application') {
            $view4Content = View::make('leaveApplication', ['mailData' => $this->mailData])->render();
            $this->subject('Leave Application');
            return $this->subject($this->mailData['title'])
                ->html($view4Content);
        } elseif ($this->mailData['title'] === 'Salary Payslip') {
            $view5Content = View::make('payslip', ['mailData' => $this->mailData])->render();
            $this->subject('Salary Payslip');
            return $this->subject($this->mailData['title'])
                ->html($view5Content);
        } else {
            $view1Content = View::make('email', ['mailData' => $this->mailData])->render();
            $this->subject($this->mailData['title']);
            return $this->subject($this->mailData['title'])
                ->html($view1Content);
        }
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        return [];
    }
}
