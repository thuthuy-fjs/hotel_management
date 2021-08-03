<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailToUser extends Mailable
{
    use Queueable, SerializesModels;
    public $hotel_name;
    public $total_price;
    public $booking_date;
    public $check_in_date;
    public $check_out_date;
    public $payment_method;


    /**
     * SendMailToUser constructor.
     * @param $hotel_name
     * @param $total_price
     * @param $booking_date
     * @param $check_in_date
     * @param $check_out_date
     * @param $payment_method
     */
    public function __construct($hotel_name, $total_price, $booking_date, $check_in_date, $check_out_date, $payment_method)
    {
        $this->hotel_name = $hotel_name;
        $this->total_price = $total_price;
        $this->booking_date = $booking_date;
        $this->check_in_date = $check_in_date;
        $this->check_out_date = $check_out_date;
        $this->payment_method = $payment_method;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $hotel_name = $this->hotel_name;
        $total_price = $this->total_price;
        $booking_date = $this->booking_date;
        $check_in_date = $this->check_in_date;
        $check_out_date = $this->check_out_date;
        $payment_method = $this->payment_method;
        return $this->subject('Xác nhận đơn đặt phòng')
            ->view('frontend.contents.email.index', [
                'hotel_name' => $hotel_name,
                'total_price' => $total_price,
                'booking_date' => $booking_date,
                'check_in_date' => $check_in_date,
                'check_out_date' => $check_out_date,
                'payment_method' => $payment_method
            ]);
    }
}
