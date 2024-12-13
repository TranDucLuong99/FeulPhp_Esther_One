<?php

class Service_Sendmail
{
    public function send_email_to_user()
    {
        // Các dữ liệu truyền vào view
        $data = [
            'customer_name' => 'Nguyễn Văn A',
            'shop_name' => 'Shop ABC',
            'order_items' => [
                ['name' => 'Áo Thun Nam', 'quantity' => 2, 'price' => 200000],
                ['name' => 'Quần Jean', 'quantity' => 1, 'price' => 500000],
            ],
            'total_price' => 900000,
            'delivery_address' => '123 Đường ABC, Quận 1, TP. HCM',
            'delivery_date' => '3-5 ngày',
        ];

        $body = \View::forge('send/index', $data)->render();

        \Package::load('email');

        $email = Email::forge();
        $email->from('tranducluong8899999@gmail.com', 'tranducluong');
        $email->to('tranducluong8899@gmail.com', 'tranducluong');
        $email->subject('This is the subject');
        $email->html_body($body);
        try {
            $email->send();
            echo "Email sent successfully!";
        } catch (\Email\EmailException $e) {
            echo "Failed to send email: " . $e->getMessage();
        }
    }
}