<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\Contact;

class MailContact extends Mailable
{
    use Queueable, SerializesModels;

    public $request_data;
    public $contacts;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request_data)
    {
        $this->request_data = $request_data;
        $this->contacts = Contact::$contacts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('【トランスポーター】お問い合わせを受付いたしました。')
                    ->view('mailbody.contact.complete');
    }
}
