<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $submitInvoicesMergedArray;

    /**
     * Create a new message instance.
     *
     * @param array $submitInvoicesMergedArray
     * @return void
     */
    public function __construct($submitInvoicesMergedArray)
    {
        $this->submitInvoicesMergedArray = $submitInvoicesMergedArray;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.invoice')
                    ->subject('Your Invoice');
    }
}
