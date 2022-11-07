<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Location: http://localhost:8080/contact/thank_you");

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// If necessary, modify the path in the require statement below to refer to the
// location of your Composer autoload.php file.
require '/var/task/user/vendor/autoload.php';

// Replace sender@example.com with your "From" address.
// This address must be verified with Amazon SES.
$sender = 'contact.webberman@gmail.com';
$senderName = 'Bankress Party World';

// Replace recipient@example.com with a "To" address. If your account
// is still in the sandbox, this address must be verified.
$recipient = 'akinsanmidev@gmail.com';

// Replace smtp_username with your Amazon SES SMTP user name.
$usernameSmtp = 'AKIAZI6CELMNOEXAY4CR';

// Replace smtp_password with your Amazon SES SMTP password.
$passwordSmtp = 'BB+IEJEKCqzgSTEJ0w6qtOsA+mCWCxBmwTaJtH9ZnyBM';

// Specify a configuration set. If you do not want to use a configuration
// set, comment or remove the next line.
// $configurationSet = 'ConfigSet';

// If you're using Amazon SES in a region other than US West (Oregon),
// replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
// endpoint in the appropriate region.
$host = 'email-smtp.us-east-1.amazonaws.com';
$port = 587;

// if(isset($_POST['submit']))  {
    function test_input($data)
{
    # code...
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
};
    $fullname = $email = $phone = $message = 'heyy';
    
    if (isset($_POST['submit']) ) {
        # code...
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
   $phone = $_POST['number'];
   $message = $_POST['message'];
   


   
   
   // The subject line of the email
   $subject = "Hello Bankress a Client (".$fullname.") sent a message from your website";
   
   // The plain-text body of the email
$bodyText =  "Hey Bankress \r\n".$message;

// The HTML-formatted body of the email
$bodyHtml = "<h1>Message from client (".$fullname.")</h1>
<p>".$message." <br/>
client's email: ".$email." <br/>
client's phone number: ".$phone."
</p>";

$mail = new PHPMailer(true);

try {
    // Specify the SMTP settings.
    $mail->isSMTP();
    $mail->setFrom($sender, $senderName);
    $mail->Username   = $usernameSmtp;
    $mail->Password   = $passwordSmtp;
    $mail->Host       = $host;
    $mail->Port       = $port;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = 'tls';
    $mail->addCustomHeader('X-SES-CONFIGURATION-SET');
    
    // Specify the message recipients.
    $mail->addAddress($recipient);
    // You can also add CC, BCC, and additional To recipients here.

    // Specify the content of the message.
    $mail->isHTML(true);
    $mail->Subject    = $subject;
    $mail->Body       = $bodyHtml;
    $mail->AltBody    = $bodyText;
    $mail->Send();
    echo "Email sent!" , PHP_EOL;
} catch (phpmailerException $e) {
    echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
} catch (Exception $e) {
    echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
}
}

exit();
?>