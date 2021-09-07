<?php
session_start();
include "PHPMailer/PHPMailerAutoload.php";


function createRandomPassword() { 

    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $pass = '' ; 

    while ($i <= 7) { 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $pass = $pass . $tmp; 
        $i++; 
    } 

    return $pass; 

} 


function smtpmailer($to, $from, $from_name, $subject, $body)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true; 
 
        $mail->SMTPSecure = 'ssl'; 
        $mail->Host = '***************************************';
        $mail->Port = *******************;  
        $mail->Username = '*************************************';
        $mail->Password = '************************************';   
   
   //   $path = 'reseller.pdf';
   //   $mail->AddAttachment($path);
   
        $mail->IsHTML(true);
        $mail->From="***************************************";
        $mail->FromName=$from_name;
        $mail->Sender=$from;
        $mail->AddReplyTo($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        if(!$mail->Send())
        {
            $error ="Please try Later, Error Occured while Processing...";
            return $error; 
        }
        else 
        {
            $error = "Thank You !! Your email is sent.";  
            return $error;
        }
    }
    
    $to   = $_SESSION['Register_email'];
    $from = '********************************';
    $name = '********************************';
    $subj = 'Verification Code';

    $code = createRandomPassword();
    $msg = 'Your verification code is: ' . $code;
    
    $error=smtpmailer($to,$from, $name ,$subj, $msg);
    
    $sql = "SELECT * FROM verification";
    $result = mysqli_query($connection, $sql);
    $mails = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $mail_found = 'false';

    foreach ($mails as $mail ) 
    {
        if($mail['mail'] == $to)
        {
            $mail_found = 'true';
        }
    }

    if($mail_found == 'true')
    {
        $sql = "UPDATE verification SET code = '$code' WHERE mail = '$to' ";
    }
    else
    {
        $sql = "INSERT INTO verification(mail,code) VALUES('$to', '$code')";
    }

    mysqli_query($connection, $sql);
    


?>
