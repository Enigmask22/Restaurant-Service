<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/PHPMailer/src/Exception.php';
require __DIR__ . '/../../vendor/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../../vendor/PHPMailer/src/SMTP.php';
EnvHelper::loadEnv(__DIR__ . '/../../.env');
class EmailHelper
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        try {
            // Server settings
            $this->mail->isSMTP();
            $this->mail->Host = EnvHelper::getEnv('MAIL_HOST', '');
            $this->mail->SMTPAuth = true;
            $this->mail->Username = EnvHelper::getEnv('MAIL_USERNAME', ''); // Thay bằng email của bạn
            $this->mail->Password = EnvHelper::getEnv('MAIL_PASSWORD', ''); // Thay bằng app password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $this->mail->Port = EnvHelper::getEnv('MAIL_PORT', '');
            $this->mail->CharSet = 'UTF-8';
        } catch (Exception $e) {
            error_log("Mail initialization error: " . $e->getMessage());
        }
    }

    public function sendBookingConfirmation($bookingData)
    {
        try {
            // Recipients
            $this->mail->setFrom($this->mail->Username, 'Restaurant Booking System');
            $this->mail->addAddress($bookingData['usr_mail']);

            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = 'Xác nhận đặt bàn - ' . $bookingData['restaurant_name'];

            $customer_body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #0dcaf0;'>Xác nhận đặt bàn thành công</h2>
                <p>Xin chào {$bookingData['fullname']},</p>
                <p>Cảm ơn bạn đã đặt bàn tại nhà hàng của chúng tôi. Dưới đây là thông tin chi tiết đặt bàn của bạn:</p>
                
                <div style='background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;'>
                    <p><strong>Nhà hàng:</strong> {$bookingData['restaurant_name']}</p>
                    <p><strong>Ngày đặt:</strong> {$bookingData['date']}</p>
                    <p><strong>Số lượng khách:</strong></p>
                    <ul>
                        <li>Người lớn: {$bookingData['adult_num']}</li>
                        <li>Trẻ em: {$bookingData['child_num']}</li>
                    </ul>
                    <p><strong>Tổng tiền:</strong> " . number_format($bookingData['money'], 0, ',', '.') . " VNĐ</p>
                </div>
                
                <p>Thông tin liên hệ:</p>
                <ul>
                    <li>Họ tên: {$bookingData['fullname']}</li>
                    <li>Số điện thoại: {$bookingData['phone']}</li>
                    <li>Địa chỉ: {$bookingData['address']}</li>
                </ul>
                
                <p style='color: #666;'>Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi.</p>
                <p style='color: #666;'>Trân trọng,<br>Restaurant Booking System</p>
            </div>
            ";

            $this->mail->Body = $customer_body;
            $this->mail->send();

            $this->mail->clearAddresses();

            $this->mail->addAddress($bookingData['res_mail']);
            $this->mail->Subject = 'Thông báo có đơn đặt bàn mới - ' . $bookingData['restaurant_name'];

            $restaurantBody = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;'>
                <h2 style='color: #0dcaf0;'>Thông báo đặt bàn mới</h2>
                <p>Xin chào nhà hàng {$bookingData['restaurant_name']},</p>
                <p>Bạn vừa nhận được một đơn đặt bàn mới với thông tin chi tiết như sau:</p>
                
                <div style='background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;'>
                    <p><strong>Thời gian đặt:</strong> {$bookingData['date']}</p>
                    <p><strong>Số lượng khách:</strong></p>
                    <ul>
                        <li>Người lớn: {$bookingData['adult_num']}</li>
                        <li>Trẻ em: {$bookingData['child_num']}</li>
                    </ul>
                    <p><strong>Tổng tiền:</strong> " . number_format($bookingData['money'], 0, ',', '.') . " VNĐ</p>
                </div>
                
                <p><strong>Thông tin khách hàng:</strong></p>
                <ul>
                    <li>Họ tên: {$bookingData['fullname']}</li>
                    <li>Email: {$bookingData['usr_mail']}</li>
                    <li>Số điện thoại: {$bookingData['phone']}</li>
                    <li>Địa chỉ: {$bookingData['address']}</li>
                </ul>
                
                <p style='color: #666;'>Vui lòng kiểm tra và xác nhận đơn đặt bàn này.</p>
                <p style='color: #666;'>Trân trọng,<br>Restaurant Booking System</p>
            </div>
            ";

            $this->mail->Body = $restaurantBody;
            $this->mail->send();

            return true;
        } catch (Exception $e) {
            error_log("Mail sending error: " . $e->getMessage());
            return false;
        }
    }
}