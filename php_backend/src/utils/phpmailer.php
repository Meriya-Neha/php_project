 <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    function send_custom_email($toAddress,$bodyText){

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
          $mail->addAddress($toAddress); 


           $mail->isHTML(true);                                  
           $mail->Subject = 'Authenticated SMTP Email';
           $mail->Body    = ($bodyText);
           $mail->AltBody = 'This is the plain text version for non-HTML email clients';

           $mail->send();
           echo 'Message has been sent successfully';
    }
    catch(Exception $e){
       echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    }
?>