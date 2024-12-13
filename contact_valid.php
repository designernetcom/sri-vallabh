<?php 
//print_r($_POST);exit();

 require_once "recaptchalib.php";
   
  // your secret key
  $secret = "6Le33U4iAAAAAP0ppou6mXSRPh3XRJ8j_A1MiC0J";
 
    // empty response
    $response = null;
 
    // check secret key
    $reCaptcha = new ReCaptcha($secret);
    
    // if submitted check response
    if ($_POST["g-recaptcha-response"]) {
        $response = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
        );
    }

    if ($response != null && $response->success) { 
$error="";

if(!isset($_POST['name']) || $_POST['name']=="")
{
    $error .="\nName is required";
}

else
{
    if(!preg_match('/^[a-zA-Z\\s]*$/',$_POST['name']))
    {
        $error .="\nEnter valid Name";
    }
}

if(!isset($_POST['email']) || $_POST['email']=="")
{
    $error .=" \nEmail Id is required";
}
else
{
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
    {   
    
        $error .=" \nEnter valid Email Id";
    }
}


if(!isset($_POST['message']) || $_POST['message']=="" || trim($_POST['message'])=="")
{
    $error .=" \nMessage is required";
}

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
      
        $message_body.="<tr><td>Contact's Message : </td><td>".$_POST['message']."</td></tr>";
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
}
else
{   
    echo $error;
}
?>