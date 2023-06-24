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

/* details extracts from link 
http://10.1.6.32/selfpublishing/get_method.php?companyId=11829044757&groupId=11829076861

& bookInfo={"Author Name": "John Doe","Email": "JD@gmail.com","ISBN": "","Cover": "Color","Editorial Complexity": "Low",
    "Number of Manuscript Pages": "251"}
    
    &redirectURL=https://www.pagemajik.com/
    
    &bookDetails={"categoryName":"Cover Design","bookName":" Arbitration & Conciliation ","chapterCount":"2", "isCoverDesignOnly":"true"}
    
    &userDetails={"firstName": "Sulthana","surName": "S","mailId": "sulthanas@s4carlisle.com" }


*/
$bookInfo=null;
$bookDetails=null;
$userDetails=null;
if(isset($_GET['bookInfo']))
{
    $bookInfo = json_decode($_GET['bookInfo'],true);

}
if(isset($_GET['bookDetails']))
{
    $bookDetails = json_decode($_GET['bookDetails'],true);

}
if(isset($_GET['bookInfo']))
{
    $userDetails = json_decode($_GET['userDetails'],true);

}

//echo("test".$bookInfo["Editorial Complexity"]);

if (!empty($bookInfo["Author Name"])) {
    $authorName = $bookInfo["Author Name"];
} else {
    $authorName = null;
}

if (!empty($bookInfo["Email"])) {
    $authorEmail = $bookInfo["Email"];
} else {
    $authorEmail= null;
}

if (!empty($bookInfo["ISBN"])) {
    $isbn = $bookInfo["ISBN"];
} else {
    $isbn = null;
}

if (!empty($bookInfo["Cover"])) {
    $interiorDesign = $bookInfo["Cover"];
} else {
    $interiorDesign = null;
}

if (!empty($bookInfo["Editorial Complexity"])) {
    $editorialComplexity = $bookInfo["Editorial Complexity"];
} else {
    $editorialComplexity = null;
}



if (!empty($bookInfo["Number of Manuscript Pages"])) {
    $nuberOfMenuscriptPages = $bookInfo["Number of Manuscript Pages"];
} else {
    $nuberOfMenuscriptPages = null;
}

if (!empty($bookDetails["categoryName"])) {
    $category = $bookDetails["categoryName"];
} else {
    $category =null;
}
if($category=="Index")
{
    $category="Index Services";
}
$categoryName = cleanStr($category);

if (!empty($bookDetails["bookName"])) {
    $bookTitle = $bookDetails["bookName"];
} else {
    $bookTitle = null;
}

if (!empty($userDetails["firstName"] . " " . $userDetails["surName"])) {
    $userName = $userDetails["firstName"] . " " .$userDetails["surName"];
} else {
    $userName = null;
}

if (!empty($userDetails["mailId"])) {
    $userMail = $userDetails["mailId"];
} else {
    $userMail = null;
}




/*echo "Author Name:".$authorName."<br>Author Mail:".$authorEmail."<br>ISBN:".$isbn."<br>Interior Design:".$interiorDesign."<br>Editorial Complexity".$editorialComplexity."
<br>Number of Menuscript Pages:".$nuberOfMenuscriptPages."<br>Category:".$category."<br>Book Title:".$bookTitle."<br>User Name:".$userName."<br>User Mail:".$userMail;

/*Project Id */
//$id = substr($authorName, 0, 4) . time() . substr($category, 0, 4);
if($category=="Full Services")
{
    $id = substr($authorName, 0, 4) . time().rand(0,9) ."fs";
}
else if($category=="Cover Design")
{
    $id = substr($authorName, 0, 4) . time().rand(0,9) ."cd";
}
else if($category=="Production and Index")
{
    $id = substr($authorName, 0, 4) . time().rand(0,9) ."pi";
}
else if($category=="Cover and Production")
{
    $id = substr($authorName, 0, 4) . time().rand(0,9) ."cp";
}
else if($category=="Production, Cover, and Editorial")
{
    $id = substr($authorName, 0, 4) . time() ."pce";
}
else if($category=="Production and Editorial")
{
    $id = substr($authorName, 0, 4) . time().rand(0,9) ."pe";
}
else if($category=="Production Services")
{
    $id = substr($authorName, 0, 4) . time().rand(0,9) ."ps";
}
else if($category=="Index Services")
{
    
    $id = substr($authorName, 0, 4) . time().rand(0,9) ."i";
}
else if($category=="Editorial Services")
{
    
    $id = substr($authorName, 0, 4) . time().rand(0,9) ."es";
}
else if($category=="Production, Editorial, and Index")
{
    
    $id = substr($authorName, 0, 4) . time().rand(0,9) ."pei";
}
else if($category=="Production, Cover, and Index")
{
    
    $id = substr($authorName, 0, 4) . time().rand(0,9) ."pci";
}
else
{
    $id = substr($authorName, 0, 4) . time().rand(0,9);
}
//echo "<br>Project Id:" . $id;
$eid = encryptor('encrypt', $id);
//echo "<br>$id";

try {
    $sql1 = "INSERT INTO services (id,authorName,authorEmail,category,bookTitle,isbn,interiorDesign,editorialComplexity,nuberOfMenuscriptPages,userName,userMail) 
VALUES ('" . $id . "','" . $authorName . "','" . $authorEmail . "','" . $category . "','" . $bookTitle . "','" . $isbn . "','" . $interiorDesign . "','" . $editorialComplexity . "','" . $nuberOfMenuscriptPages . "','" . $userName . "','" . $userMail . "')";
    mysqli_query($conn, $sql1);
    //echo "Record inserted";
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Mailer</title>
</head>

<body>
    <?php
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

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
        $mail->addAddress($userMail); //Name is optional
        // $mail->addReplyTo('info@gmail.com', 'Information');
        //$mail->addCC('cc@gmail.com');
        // $mail->addBCC('bcc@gmail.com');
    
        //Attachments
        //  $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Starting your cover design project';
        $mail->Body = '
    <p>Dear ' . $userName . '</p>
    <p>Thank you for choosing to work with us to create your book cover design. Our professional design team stands ready to guide you through each step of the process. We will work closely with you to deliver an eye-catching cover design that will make readers take notice. 
    We will be asking you to provide information and various elements we will need to complete this project, such as relevant specifications, text to appear on the cover, and any images (for which you own all rights and permissions) you would like us to use.</p>
    <p>Just <a href="http://10.1.6.32/selfpublishing/' . $categoryName . '.php?id=' . $eid . '">[Click Here]</a> to begin. Please feel free to contact us if you have any questions at <a href="mailto:selfpublish@s4carlisle.com" target="_blank" >selfpublish@s4carlisle.com</a></p>
    <p>Regards,<br>S4Carlisle Design Team</p>
    ';
        $mail->AltBody = $category;
        $mail->send(); ?>
        <script>alert('\n\u2139 Link has been sent to author. Please check.');</script>
    <?php
    } catch (Exception $e) {
        ?>
        <script>alert('\n\u26A0 Message could not be sent');</script>
    <?php
    }
    echo $mail->Body;
    ?>

</body>

</html>