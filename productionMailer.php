<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'connection.php';
require 'config.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function cleanStr($string)
{
    $result = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $string));

    return $result;
}



$category = '';


/*$coverType =null;
$priceBarcode =0;
$trimSize =0;
$trimSizeWidth =0;
$trimSizeHeight =0;
$paperWeight =0;
$requestedServices =null;
$visonInteriorDesign=null;
$dimenSpecification =null;
$bookCoverFront =null;
$spine = null;
$bookCoverBack =null;
$authorImage = null;
$artImage = null;
$visionDesign = null;
$template_id = null;
$other = null;*/

$error_count = 0;
$resp = array();


/*if (isset($_POST['authorName'])) {
    $authorName = $_POST['authorName'];
} else {
    $authorName = null;
    $resp[] = array(
        'StatusCode' => 'JSON001',
        'Status' => 'authorName is not found.'
    );
    $error_count += 1;

}

if (isset($_GET['authorEmail'])) {
    $authorMail = $_GET['authorEmail'];
} else {
    $authorMail = null;
    $resp[] = array(
        'StatusCode' => 'JSON001',
        'Status' => 'authorEmail is not found.'
    );
    $error_count += 1;

}
*/
if (isset($_POST['bookSubTitle'])) {
    $bookSubtitle = $_POST['bookSubTitle'];
} else {
    $bookSubtitle = null;
}

if (isset($_POST['isbn'])) {
    $isbn = $_POST['isbn'];
} else {
    $isbn = null;
}

if (isset($_POST['coverType'])) {
    $coverType = $_POST['coverType'];
} else {
    $coverType = null;
}

if (isset($_POST['priceBarcode'])) {
    $priceBarcode = $_POST['priceBarcode'];
} else {
    $priceBarcode = 0;
}

if (isset($_POST['trimSize'])) {
    $trimSize = $_POST['trimSize'];

} else {
    $trimSize = 0;
}


if (isset($_POST['paperWeight'])) {
    $paperWeight = $_POST['paperWeight'];
} else {
    $paperWeight = 0;
}

if (isset($_POST['requestedServices'])) {
    if (!empty($_POST['requestedServices'])) {
        $requestedServices = implode(',', ($_POST['requestedServices']));
    } else {
        $requestedServices = "";
    }
}
else
{
    $requestedServices = null;
}

if (isset($_POST['visonInteriorDesign'])) {
    $visonInteriorDesign = trim($_POST['visonInteriorDesign']);
} else {
    $visonInteriorDesign = null;
}

if (isset($_POST['dimenSpecification'])) {
    $dimenSpecification = $_POST['dimenSpecification'];
} else {
    $dimenSpecification = null;
}


if (isset($_POST['cfrontText'])) {
    $bookCoverFront = $_POST['cfrontText'];
} else {
    $bookCoverFront = null;
}


if (isset($_POST['spineText'])) {
    $spine = $_POST['spineText'];
} else {
    $spine = null;
}

if (isset($_POST['cbackText'])) {
    $bookCoverBack = $_POST['cbackText'];
} else {
    $bookCoverBack = null;
}


if (isset($_POST['authorImage'])) {
    $authorImage = $_POST['authorImage'];
} else {
    $authorImage = null;
}


if (isset($_POST['artImage'])) {
    $artImage = $_POST['artImage'];
} else {
    $artImage = null;
}


if (isset($_POST['visionDesign'])) {
    $visionDesign = $_POST['visionDesign'];
} else {
    $visionDesign = null;
}


if (isset($_POST['coverImageId'])) {
    $template_id = trim($_POST['coverImageId']);
} else {
    $template_id = null;
}

if (isset($_POST['trimSizeWidth'])) {
    $trimSizeWidth = $_POST['trimSizeWidth'];
} else {
    $trimSizeWidth = 0;
}


if (isset($_POST['trimSizeHeight'])) {
    $trimSizeHeight = $_POST['trimSizeHeight'];
} else {
    $trimSizeHeight = 0;
}

if (isset($_POST['other'])) {
    $other = $_POST['other'];
} else {
    $other = null;
}

$submitCount = 1;

//if (isset($_POST['save'])) {
    /* Update the entries in table*/
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $id = encryptor('decrypt', $id);
        //echo $id;
        $sql="select * from services where id='$id'";
        $query_run = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            if ($query_run == false) {

                $resp[] = array(
                    'StatusCode' => 'JSON004',
                    'Status' => 'Mysql select query is failed.'
                );
                $error_count += 1;
            }
            else{
                $fetch_data = mysqli_query($conn, $sql);
                $result = mysqli_fetch_array($fetch_data);
                if(!empty($result['category']))
                {
                    $category = $result['category'];
                    $categoryName = cleanStr($category);
                    $eid = encryptor('encrypt', $id);
                }
                else{
                    $category='';
                    $resp[] = array(
                        'StatusCode' => 'JSON001',
                        'Status' => 'category is not found.'
                    );
                    $error_count += 1;
                }
                if(!empty($result['authorName']))
                {
                    $authorName = $result['authorName'];
                   
                }
                else{
                    $authorName=null;
                    $resp[] = array(
                        'StatusCode' => 'JSON001',
                        'Status' => 'category is not found.'
                    );
                    $error_count += 1;
                }
                if(!empty($result['authorEmail']))
                {
                    $authorMail = $result['authorEmail'];
                   
                }
                else{
                    $authorMail=null;
                    $resp[] = array(
                        'StatusCode' => 'JSON001',
                        'Status' => 'category is not found.'
                    );
                    $error_count += 1;
                }
            
              
            }
       

            $sql1 = "update services set bookSubtitle='$bookSubtitle',isbn='$isbn',coverType='$coverType',
            priceBarcode='$priceBarcode',trimSize='$trimSize',visonInteriorDesign='$visonInteriorDesign',paperWeight='$paperWeight',requestedServices='$requestedServices',
            dimenSpecification='$dimenSpecification',bookCoverFront='$bookCoverFront',
            spine='$spine',bookCoverBack='$bookCoverBack',
            authorImage='$authorImage',artImage='$artImage',visionDesign='$visionDesign',template_id='$template_id',submitCount='$submitCount',trimSizeWidth='$trimSizeWidth',trimSizeHeight='$trimSizeHeight',other='$other'
            where id='$id'";

            $query_run = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

            if ($query_run == false) {

                $resp[] = array(
                    'StatusCode' => 'JSON004',
                    'Status' => 'Mysql update query is failed.'
                );
                $error_count += 1;
            }
            mysqli_close($conn);

}
else{
    $resp[] = array(
        'StatusCode' => 'JSON001',
        'Status' => 'Project id is not found.'
    );
    $error_count += 1;
}
//}

/* Mail to production team*/

if($error_count==0)
{
     //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $emailBody=' <p>Dear Team,</p>
    <p>The below services are scheduled.</p>
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
            <td style="border: 1px solid black;border-collapse: collapse; text-align:left;padding:10px;"><a href="http://10.1.6.32/selfpublishing/' . $categoryName . 'P.php?id=' . $eid . '">[Click Here]</a>
            </td>
        </tr>

    </table>
    <p>Regards,<br>
        S4Carlisle Design Team.

    </p>';
    $emailBody = mb_convert_encoding($emailBody, "HTML-ENTITIES", 'UTF-8');
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
        $mail->setFrom('sulthanaofficial111@gmail.com', 'S4C Cover Design');
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
        $mail->Body = $emailBody;

        $mail->AltBody = $category;

        $mail->send(); 
        $resp = array(
            'StatusCode' => 'JSON200',
            'Status' => 'Thank you! Form submitted successfully.'
        );
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($resp);
    }catch (Exception $e) { 
        //<script>alert('\n\u2139 Message could not be sent.');</script>-->
        $resp = array(
            'StatusCode' => 'JSON005',
            'Status' => 'Form cannot be submitted. Please try again!'
        );
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($resp);
    
    }
}
else{
    $resp[] = array(
        'StatusCode' => 'JSON005',
        'Status' => 'Form cannot be submitted. Please try again!'
    );
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($resp);
}

    
   
    
   
        //<script>alert('\n\u2139 Mail has been sent to Production team. Please check.');</script>
       