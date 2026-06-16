<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Invoice;
use App\Models\SmtpSetting;
use App\Models\InvoiceSetting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OrderConfirmationMail extends Mailable
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
                'Order Confirmation - ' .
                $this->order->order_number
            )
            ->view(
                'emails.order-confirmation'
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

        /*
        |--------------------------------------------------------------------------
        | Attach Invoice PDF (Optional)
        |--------------------------------------------------------------------------
        */

        $invoiceSetting = InvoiceSetting::with([
            'state',
            'city',
        ])->first();

        if ($invoiceSetting?->email_invoice_customer) {

            try {

                $invoice = Invoice::where(
                    'order_id',
                    $this->order->id
                )->first();


                $logo_64 = null;

                if ($invoiceSetting?->company_logo) {
                    $logoPath = storage_path('app/public/' . $invoiceSetting->company_logo);

                    if (file_exists($logoPath)) {
                        $mime = mime_content_type($logoPath);

                        $logo_64 = 'data:' . $mime . ';base64,' .
                            base64_encode(file_get_contents($logoPath));
                    }
                }

                if ($invoice) {

                    $this->order->load([
                        'items.product',
                        'items.variant.values.attributeValue.attribute',
                        'state',
                        'city',
                    ]);

                    $pdf = Pdf::loadView(
                        'admin.orders.invoice',
                        [
                            'order' => $this->order,
                            'invoice' => $invoice,
                            'setting' => $invoiceSetting,
                            'isPdf' => true,
                            'logo_64' => $logo_64,
                        ]
                    )
                        ->setPaper('a4', 'portrait')
                        ->setOptions([
                            'defaultFont' => 'DejaVu Sans',
                            'isRemoteEnabled' => false,
                            'isHtml5ParserEnabled' => true,
                            'dpi' => 150,
                        ]);

                    $mail->attachData(
                        $pdf->output(),
                        'Invoice-' .
                        $invoice->invoice_number .
                        '.pdf',
                        [
                            'mime' => 'application/pdf',
                        ]
                    );
                }

            } catch (\Exception $e) {

                Log::error(
                    'Invoice Attachment Failed: ' .
                    $e->getMessage()
                );
            }
        }

        return $mail;
    }

}
