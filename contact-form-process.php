<?php
if (isset($_POST['Submit'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "lucymassie@live.co.uk";
    $email_subject = "New booking enquiry - Creag Mhor";

    function problem($error)
    {
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br><br>";
        echo $error . "<br><br>";
        echo "Please go back and fix these errors.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Phone'])||
        !isset($_POST['Check-in']) ||
        !isset($_POST['Check-out'])||
        !isset($_POST['Flexible']) ||
        !isset($_POST['Contact-method'])||
        !isset($_POST['Comment'])
    ) {
        problem('We are sorry, but there appears to be a problem with the form you submitted.');
    }

    $name = $_POST['Name']; // required
    $email = $_POST['Email']; // required
    $phone = $_POST['Phone']; // required
    $checkin = $_POST['Check-in']; // required
    $checkout = $_POST['Check-out']; // required
    $flexible = $_POST['Flexible']; // required
    $contactmethod = $_POST['Contact-method']; // required    
    $comment = $_POST['Comment']; // required


    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'The Email address you entered does not appear to be valid.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'The Name you entered does not appear to be valid.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'The Message you entered do not appear to be valid.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }
    if (empty($contactmethod)) {
        $contactmethod .= 'Email'; 
    }


    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Phone: " . clean_string($phone) . "\n";
    $email_message .= "Check-in: " . clean_string($checkin) . "\n";
    $email_message .= "Check-out: " . clean_string($checkout) . "\n";
    $email_message .= "Flexible on dates: " . clean_string($flexible) . "\n";
    $email_message .= "Preferred contact method: " . clean_string($contactmethod) . "\n";
    $email_message .= "Other comments: " . clean_string($comment) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

    Thank you for contacting us. We will be in touch with you very soon.

<?php
}
?>