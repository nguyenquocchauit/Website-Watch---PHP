<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    if(isset($_POST['send']))
    {
        $mail = new PHPMailer(); // khởi tạo đối tượng PHP Mailer
        $mail->isSMTP();
        $mail->SMTPDebug  = 2;
        $mail->CharSet = 'UTF-8';
        $mail->Debugoutput = "html"; 
        $mail->Host ='smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tcwatchfeedback.customer@gmail.com';
        $mail->Password = 'wblcffxkzqcomfcl';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465 ;

        // $mail->setFrom('tram.pth.61cntt@ntu.edu.vn');
        $mail->AddAddress('chau.nq.61cntt@ntu.edu.vn');//Email của người nhận
        $mail->isHTML=true;
        $title = "Chăm sóc khách hàng"; //tiêu đề email
        $body = "Thông tin khách hàng liên hệ : <br>" 
        ."Họ tên khách hàng :".$_POST['name'] ."<br>"
        ."Email khách hàng : ".$_POST['email']."<br>"
        ."Số điện thoại khách hàng :".$_POST['phone']."<br>"
        ."Địa chỉ khách hàng : " .$_POST['add']."<br>"
        ."Lời nhắn của khách hàng :" .$_POST['content'];
        $mail->Subject = $title; 
        $mail->Body = $body; 
        $mail->Send();

        //Tiến hành gửi mail và thông báo lỗi
        if($mail->Send()) 
        {
            echo "<script>
                document.location.href = 'tbcontact.php';
            </script>";
        }
        else 
        {
            echo "Có lỗi khi gửi mail: " . $mail->ErrorInfo;
        }
    }
?>
