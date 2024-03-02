<?php
session_start();
date_default_timezone_set('America/North_Dakota/Center');
$user_first_name=str_replace(" ", "~", $_POST['user_first_name']);
$user_last_name=str_replace(" ", "~", $_POST['user_last_name']);
$user_email=$_POST['user_email'];
$user_password=$_POST['user_password'];
$user_validation='NO';
$last_update=date("Ymd") . '-' .date("His");

// Reference: https://stackoverflow.com/questions/4356289/php-random-string-generator
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
$random_string=generateRandomString(10);

#--------------------------------------------PHP method -----------------------------------------------------------------------------------
$host_name='dpg-cn3qb5qcn0vc738pmp7g-a.oregon-postgres.render.com';
$db_name='inew2374250spring24';
$user_name='inew2374250spring24_user';
$password='4i2U9tzMVYLGbj7ePpxmiyHr4oIflMf1';
$Table_name='"ITSE-2374-APP-4"."USER_LIST"';
$db = pg_connect("host=$host_name port=5432 dbname=$db_name user=$user_name password=$password");
$result = pg_query($db,"INSERT into $Table_name (first_name, last_name, email, password, validation_status, last_update, validation_code) 
VALUES ('$user_first_name', '$user_last_name', '$user_email','$user_password','$user_validation','$last_update', '$random_string')");

pg_free_result($result);
pg_close($db);

#--------------------------------------------PHP method to send an email -------------------------------------------------------------------
#-------------Reference: https://github.com/PHPMailer/PHPMailer/blob/master/examples/gmail.phps  ---------------
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$mail = new PHPMailer();

$mail->isSMTP();

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->SMTPAuth = true;
$mail->Username = 'your_google_email_address';
$mail->Password = 'your_gmail_passkey';
$mail->setFrom('your_google_email_address', 'First Last');
$mail->addReplyTo('your_google_email_address', 'First Last');

$mail->addAddress('user_email', $user_first_name .' '. $user_last_name);

//Set the subject line
$mail->Subject = "ITSE2374 Team 4: New User $user_first_name $user_last_name Registration Confirmation";

$mail->msgHTML("<html>
<body>
    <p>Hi, $user_first_name $user_last_name,<br>            
    &nbsp&nbsp&nbsp Please click <a href='http://localhost/cc/ITSE-2374-APP-4-BACK/story01_user_confirmation.php?validation_code=$random_string'>here</a>
    to confirm your registration.<br>
    &nbsp&nbsp&nbsp If you did not request this registration, please ignore this message. Thanks.<br>
    &nbsp&nbsp&nbsp <span style=\"color:blue\">This is an <b>HTML</b> email sent from PHP using the Gmail SMTP server.</span></p>
</body>
</html>");

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
else {
    echo "<p> $user_first_name ,<br>Thanks for your registration. <br>Please check your email, follow the instrustions, and complete the verification. Thanks.</p>";
}
?>
 
















