<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RoleAttachMail extends Mailable
{
    use Queueable, SerializesModels;

    // public: Sind im View sofort verfügbar
    public $user;

    // protected und private: Muss über with in der content-Methode an die view weitergegeben werden
    protected $info; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('tomasz@lubowiecki.de', 'Tomasz Lubowiecki'),
            subject: 'Role Attach Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mails.role-attached',
            text: 'mails.role-attached-plain',
            //with: [
            //    'info' => $this->info,
            //]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
            //Attachment::fromPath(storage_path('/path')),
            Attachment::fromStorage('public/images/standard.jpg')
                            ->as('bild.jpg')
                            ->withMime('image/jpeg')

        ];
    }

    /*
    // früher, vor Laravel 9
    public function build()
    {
        return $this->view('mails.role-attached')
                    ->text('mails.role-attached-plain')
                    ->with(['info' => $this->info])
                    ->attach('/pfad');
    }
    */
}
