<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
echo "production mailer";
require 'connection.php';
require 'config.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$authorName = $_POST['authorName'];
$authorMail = $_POST['authorEmail'];
$category = $_POST['category'];
$bookSubtitle = $_POST['bookSubTitle'];
$isbn = $_POST['isbn'];
$coverType = $_POST['coverType'];
$priceBarcode = $_POST['priceBarcode'];
$trimSize = $_POST['trimSize'];
$paperWeight = $_POST['paperWeight'];
$requestedServices = implode(',', $_POST['requestedServices']);
$dimenSpecification = $_POST['dimenSpecification'];
$bookCoverFront = $_POST['cfrontText'];
$spine = $_POST['spineText'];
$bookCoverBack = $_POST['cbackText'];
$priceBarcode = $_POST['priceBarcode'];
$authorImage = $_POST['authorImage'];
$artImage = $_POST['artImage'];
$visionDesign = $_POST['visionDesign'];
$template_id = $_POST['coverImageId'];
$submitCount=1;

if (isset($_POST['save'])) {
    /* Update the entries in table*/
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $id = encryptor('decrypt', $id);
        echo $id;
        $eid = encryptor('encrypt', $id);


    /* File upload*/
    if ($_FILES && $_FILES['myfile']) {
        try {
            if (!empty($_FILES['myfile']['name'][0])) {
                //echo  phpinfo();
                // echo class_exists('ZipArchive');
                $zip = new ZipArchive();
                $zip_name = getcwd() . "/uploads/proj_" . $id . "_" . time() . ".zip";
                $filename = "proj_" . $id . "_" . time() . ".zip";
                // Create a zip target
                if ($zip->open($zip_name, ZipArchive::CREATE) !== TRUE) {
                    echo "Sorry ZIP creation is not working currently.<br/>";
                }

                $imageCount = count($_FILES['myfile']['name']);
                $totalfileSize = array_sum($_FILES['myfile']['size']);
                //  echo "<br>file size=".$totalfileSize;
                for ($i = 0; $i < $imageCount; $i++) {

                    if ($_FILES['myfile']['tmp_name'][$i] == '') {
                        continue;
                    }
                    // $newname = date('YmdHis', time()) . mt_rand() . '.jpg';

                    // Moving files to zip.
                    $zip->addFromString($_FILES['myfile']['name'][$i], file_get_contents($_FILES['myfile']['tmp_name'][$i]));

                    // moving files to the target folder.
                    //move_uploaded_file($_FILES['myfile']['tmp_name'][$i], './uploads/' .$_FILES['myfile']['name'][$i]);

                }
                $size = 10;
                $zip->close();

                
        try {

            $sql1 = "update services set bookSubtitle='$bookSubtitle',isbn='$isbn',coverType='$coverType',
            priceBarcode='$priceBarcode',trimSize='$trimSize',paperWeight='$paperWeight',requestedServices='$requestedServices',
            dimenSpecification='$dimenSpecification',bookCoverFront='$bookCoverFront',
            spine='$spine',bookCoverBack='$bookCoverBack',priceBarcode='$priceBarcode',
            authorImage='$authorImage',artImage='$artImage',visionDesign='$visionDesign',template_id='$template_id',fileName='$filename',submitCount='$submitCount'
            where id='$id'";
            mysqli_query($conn, $sql1);
        } catch (Exception $e) {
            echo "Error:" . $e . "<br>Please contact Development team.";
        }
                $sql = "insert into files(file_name,file_size,purchase_id)
            values('$filename','$totalfileSize','$id')";
                if (mysqli_query($conn, $sql)) {
                    echo "<br>File uploaded successfully";

                } else {
                    echo "Failed to upload file";
                }

                // Create HTML Link option to download zip
                // $success = basename($zip_name);
            } else {
                $error = '<strong>Error!! </strong> Please select a file.';
            }
        } catch (Exception $e) {
            echo "Error" . $e;
        }

    }
}
}



?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FULL SERVICES</title>
</head>

<body>

    <?php
    /* Mail to production team*/

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $mailId = "sulthanas@s4carlisle.com";
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'sulthanaofficial111@gmail.com'; //SMTP username
        $mail->Password = 'zrjqzsandnvphfnc'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('sulthanaofficial111@gmail.com', 'S4C Cover Design Job');
        //$mail->addAddress('joe@gmail.net', 'Joe User');     //Add a recipient
        $mail->addAddress($mailId); //Name is optional
        // $mail->addReplyTo('info@gmail.com', 'Information');
        //$mail->addCC('cc@gmail.com');
        // $mail->addBCC('bcc@gmail.com');
    
        //Attachments
        //  $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Starting your cover design project';
        $mail->Body = ' <p>Dear Team,</p>
    <p>The Below services are scheduled.</p>
    <table style="border: 1px solid black;border-collapse: collapse; text-align:left;padding:10px;">
        <tr>
            <th style="border: 1px solid black;border-collapse: collapse; text-align:left;padding:10px;">Project Id</th>
            <td style="border: 1px solid black;border-collapse: collapse; text-align:left;padding:10px;">
                ' . $id . '</td>
        </tr>
        <tr>
            <th style="border: 1px solid black;border-collapse: collapse; text-align:left;padding:10px;">Category</th>
            <td style="border: 1px solid black;border-collapse: collapse; text-align:left;padding:10px;">' . $category . '</td>
        </tr>

        
        <tr>
            <th style="border: 1px solid black;border-collapse: collapse; text-align:left;padding:10px;">Author Name</th>
            <td style="border: 1px solid black;border-collapse: collapse; text-align:left;padding:10px;">' . $authorName . '
            </td>
        </tr>
        <tr>
            <th style="border: 1px solid black;border-collapse: collapse; text-align:left;padding:10px;">Author Mail</th>
            <td style="border: 1px solid black;border-collapse: collapse; text-align:left;padding:10px;">' . $authorMail . '
            </td>
        </tr>
        <tr>
            <th style="border: 1px solid black;border-collapse: collapse; text-align:left;padding:10px;">URL</th>
            <td style="border: 1px solid black;border-collapse: collapse; text-align:left;padding:10px;"><a href="http://10.1.6.32/selfpublishing/full_services.php?id=' . $eid . '">[Click Here]</a>
            </td>
        </tr>

    </table>
    <p>Regards,<br>
        S4Carlisle Design Team

    </p>';

        $mail->AltBody = $category;

        $mail->send(); ?>

        <script>alert('Mail has been sent to Production team. Please check.');</script>
        <?php
         echo $mail->Body;
    } catch (Exception $e) { 
        echo $e;
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
    }

    ?>
</body>

</html>