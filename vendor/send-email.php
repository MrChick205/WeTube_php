<?php
    session_start();
    error_reporting(E_ALL ^ E_DEPRECATED);
    require_once '../app/config/connect.php';
/////////////////////////
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Đảm bảo bạn đã tải PHPMailer từ GitHub vào thư mục 'PHPMailer'
require 'PHPMailer-master/src/Exception.php';  // Đường dẫn đến Exception.php / Xử lý lỗi khi gửi email.
require 'PHPMailer-master/src/PHPMailer.php';   // Đường dẫn đến PHPMailer.php / Chứa các lớp và phương thức để tạo và gửi email.
require 'PHPMailer-master/src/SMTP.php';        // Đường dẫn đến SMTP.php /Cung cấp các phương thức gửi email qua SMTP.

////////////////////////
//Xử lý dữ liệu từ form đăng ký
    if (isset($_POST['submit']))
    {
        if (isset($_POST['fullname'])) {
            $fullname = $_POST['fullname'];
        }

        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        }

        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }

        $sql = "INSERT INTO users (fullname, password, email,role)
                VALUES ('$fullname', md5('$password'), '$email', 1)";
        $res = mysqli_query($conn,$sql);


        ///////////////////////////////////////////
        if ($res) {
            // Gửi email thông báo đăng ký thành công
            try {
                $mail = new PHPMailer(true);
    
                // Cấu hình SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';  // Máy chủ SMTP của Gmail
                $mail->SMTPAuth = true;
                $mail->Username = 'bohonuochthihoaitien@gmail.com';  // Thay đổi với email của bạn
                $mail->Password = 'pnidwamhjblawyvp';     // Thay đổi với mật khẩu ứng dụng của bạn
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // Sử dụng STARTTLS
                $mail->Port = 465;  // Cổng cho STARTTLS
    
                // Tắt kiểm tra chứng chỉ SSL
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
    
                // Thiết lập người gửi và người nhận
                $mail->setFrom('bohonuochthihoaitien@gmail.com', 'MyLiShop');
                $mail->addAddress($email);  // Người nhận từ form
    
                // Cấu hình email
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';  // Đảm bảo email sử dụng mã hóa UTF-8
                $mail->Subject = "Thông báo đăng ký tài khoản thành công";  
                $mail->Body    = "<h2>Chúc mừng bạn đã đăng ký tài khoản thành công tại MyLiShop!</h2>
                                  <p><strong>Tên đăng nhập:</strong> $fullname</p>
                                  <p><strong>Mật khẩu:</strong> $password</p>
                                  <p>Vui lòng sử dụng thông tin này để đăng nhập vào tài khoản của bạn.</p>";
    
                // Gửi email
                $mail->send();
    
                // Điều hướng người dùng về trang đăng nhập với thông báo thành công
                header("location:login.php?rs=success");
                exit();
    
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            // Nếu không thành công trong việc đăng ký, chuyển đến trang đăng nhập với thông báo lỗi
            header("location:login.php?rf=fail");
            exit();
        }
        ///////////////////////////////​07:45/-strong/-heart:>:o:-((:-h Xem trước khi gửiThả Files vào đây để xem lại trước khi gửi
    }
    ?>