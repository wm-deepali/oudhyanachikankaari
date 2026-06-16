<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\SmtpSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        $mail = $this
            ->subject(
                'New Order Received - ' .
                $this->order->order_number
            )
            ->view(
                'emails.admin-new-order'
            );

        /*
        |--------------------------------------------------------------------------
        | Reply-To Settings
        |--------------------------------------------------------------------------
        */

        $smtp = SmtpSetting::first();

        if (
            $smtp &&
            !empty($smtp->reply_to_email)
        ) {
            $mail->replyTo(
                $smtp->reply_to_email,
                $smtp->reply_to_name
            );
        }

        return $mail;
    }
}