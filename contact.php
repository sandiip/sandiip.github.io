<?php
ob_start();
require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
if (isset($_POST['name']) || isset($_POST['email']) || isset($_POST['contact-msg'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    // $mobile = $_POST['contact-phone'];
    $message = $_POST['message'];
    // $jobprofile = $_POST['job-profile'];
 
    // $fileatt = $_FILES['resume']['tmp_name']; 
    // $fileatt_type = $_FILES['resume']['type']; 
    // $fileatt_name = $_FILES['resume']['name']; 
    // check if folder is created on server or not then create it using power shell
    if (!file_exists('resume/')) {
      mkdir('resume/', 0755, true);
    }
    $upload_folder = 'resume/';
    $path_of_uploaded_file = $upload_folder . $fileatt_name;
    $tmp_path = $_FILES["resume"]["tmp_name"];
    //Upload file on server temporarily later on below file is deleted from server automatically
    if(is_uploaded_file($tmp_path))
    {
     if(!copy($tmp_path,$path_of_uploaded_file))
       {
         $errors .= '\n error while copying the uploaded file';
       }
    }

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    if (!empty($name) && !empty($email) && !empty($message)) {
        //$mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.teklinkinternational.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'info@teklinkinternational.com';                 // SMTP username
        $mail->Password = 'techlink123';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 25;                                    // TCP port to connect to

        $mail->setFrom('info@teklinkinternational.com', 'TekLink');
        //To address goes here
        $mail->addAddress('priyanka.c@teklink.in', 'Priyanka Chauhan');
        //$mail->addAddress('priyanka.chauhan2416@gmail.com', 'Priyanka Chauhan');
        
             
        $mail->addAttachment($path_of_uploaded_file); //Filename is optional

        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'TekLink New Enquiry';
        $mail->Body = "Hi <b>Admin</b>,<br> Please find below details for new job request.<br><br> Name : <b>" . $name . "</b> <br> Email : <b>" . $email . "</b> <br> Contact No. : <b>" . $mobile . "</b> <br> Job Profile : <b>" .$jobprofile. "</b> <br> Resume : <b> Please find attachment for resume." . "</b> <br> Message : <b>" . $message . "</b><br><br><br> Thanks,<br>TekLink<br><img src='http://teklinkinternational.com/images/logo.png' width='200px' height='105px'>";

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'success';
            // delete file from server after sending email 
            unlink($path_of_uploaded_file);
            session_start();
            $_SESSION['message'] = 'success';
            $location = '/career.php';
            header("Location: $location");
        }
    }
}
?>	





