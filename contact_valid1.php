<?php 

$error="";

if($error=="")
{

    require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->IsSMTP();                                      // Set mailer to use SMTP
      
        $mail->Host = "smtp.gmail.com";              // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'designernetcom@gmail.com';                 // SMTP username
        $mail->Password = 'ghyawntdxubcnkhr';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to
      //  $mail->Port = 587;                                    // TCP port to connect to

        $mail->From = 'srivallabhinvestment@gmail.com';
        $mail->FromName ='srivallabhinvestment@gmail.com';
        $mail->addAddress('srivallabhinvestment@gmail.com'); 
       
        $message_body="<html><body><table border=5px>";
        $message_body.="<tr><td colspan='2' style='color : #C50B33; font-size : 20px; '><b>Request For Contact Form</b></td></tr>";
        $message_body.="<tr><td>Contact's Full Name : </td><td>".$_POST['name']."</td></tr>";
        $message_body.="<tr><td>Contact's Email : </td><td>".$_POST['email']."</td></tr>";
        $message_body.="<tr><td>Contact's Number : </td><td>".$_POST['phone']."</td></tr>";
      
      
        $message_body.="</table></body></html>"; 
    
       
       // $mail->AddAttachment( $_FILES['file']['tmp_name'], $_FILES['file']['name'] );
        $mail->Subject  = 'Shri Vallabh Investment';
        $mail->isHTML(true);
        $mail->Body = $message_body;

        if(!$mail->send())
         {
            echo "Sorry, error occured this time sending your Mail.Please send again..!";
        } 
        else 
        {
            echo "sent";
        }
        $mail->ClearAllRecipients();
        //$mail->clearAttachments();
        $mail->addAddress($_POST['email']);
        $message_body="Thank You....We Will Back To You Soon..";
        $mail->Subject  = 'Shri Vallabh Investment';
        $mail->Body = $message_body;
        $mail->send();
         
}

else
{   
    echo $error;
}
?>