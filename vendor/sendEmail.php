<?php
    session_start();
    error_reporting(E_ALL ^ E_DEPRECATED);
    // require_once '../app/config/connect.php';
/////////////////////////
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

class SendEmail {
    public function sendEmail($email, $fullname, $password) {
        try {
            $mail = new PHPMailer(true);

            // Cấu hình SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'bohonuochthihoaitien@gmail.com';
            $mail->Password = 'pnidwamhjblawyvp'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Tắt kiểm tra chứng chỉ SSL
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            // Thiết lập người gửi và người nhận
            $mail->setFrom('bohonuochthihoaitien@gmail.com', 'WeTube');
            $mail->addAddress($email); 

            // Cấu hình email
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = "Thông báo đăng ký tài khoản thành công";
            $mail->Body    = "<h2>Chúc mừng bạn đã đăng ký tài khoản thành công tại WeTube!</h2>
                              <p><strong>Tên đăng nhập:</strong> $fullname</p>
                              <p><strong>Mật khẩu:</strong> $password</p>
                              <p>Vui lòng sử dụng thông tin này để đăng nhập vào tài khoản của bạn.</p>";

            // Gửi email
            $mail->send();

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
    
    ?>