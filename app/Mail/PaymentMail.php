<?php

namespace App\Mail;

use App\Models\Datas;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;
    
    // public $requestData;
    public $paymentId;
    public $requestData;
    public $firstName;
    public $lastName;
    public $eventName;
    // public $email;
    // public $paymentId;

    /**
     * Create a new message instance.
     */
    public function __construct($firstName, $lastName, $paymentId)
    {
        $this->paymentId = $paymentId;
        $this->requestData = Datas::where('payments_id', $paymentId)->with('users','events','positions', 'buckets.prices', 'payments')->get();
        $this->eventName = Datas::where('payments_id', $paymentId)->with('events', 'payments')->first();
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        // $this->email = $email;
        // $this->paymentId = $paymentId;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pembayaran Berhasil',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.successPayment',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
