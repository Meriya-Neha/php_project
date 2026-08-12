<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    $mail=new PHPMailer(true);

    try{

          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth =true;
          $mail->Username ='backendtrainee01@gmail.com';
          $mail->Password ='lfps dabk knkc isvn';
          $mail->SMTPSecure =PHPMailer::ENCRYPTION_STARTTLS;
          $mail->port = 587;


          $mail->setFrom('backendtrainee01@gmail.com', 'Meriya Neha');
          $mail->addAddress('backendtrainee01@gmail.com', 'Meriya Neha'); 


           $mail->isHTML(true);                                  // Set email format to HTML
           $mail->Subject = 'Authenticated SMTP Email';
           $mail->Body    = 'This email is sent using <b>PHPMailer via SMTP</b>!';
           $mail->AltBody = 'This is the plain text version for non-HTML email clients';

           $mail->send();
           echo 'Message has been sent successfully';
    }
    catch(Exception $e){
       echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>