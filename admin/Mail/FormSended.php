<?php

namespace Admin\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Form;

class FormSended extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $form;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch ($this->form->name) {
            case 'header' :
                $subject = 'Заказ обратного звонка';
                break;
            case 'order' :
                $subject = 'Заказ с сайта';
                break;
            case 'for_designers' :
                $subject = 'Предложение для дизайнеров';
                break;
            default :
                $subject = 'Форма на сайте';
        }

        return $this->subject($subject)->view('mail.default')->with([
            'data' => $this->form->data
        ]);
    }
}
