<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'connection.php';
require 'config.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//to remove the space and special characters from category name
function cleanStr($string)
{
    $result = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $string));

    return $result;
}

//extract($_GET);
/* details extracts from link 
https://selfpublish.s4carlisle.com/get_method.php?companyId=11829044757&groupId=11829076861

& bookInfo={"Author Name": "John Doe","Email": "JD@gmail.com","ISBN": "","Cover": "Color","Editorial Complexity": "Low",
    "Number of Manuscript Pages": "251"}
    
    &redirectURL=https://www.pagemajik.com/
    
    &bookDetails={"categoryName":"Cover Design","bookName":" Arbitration & Conciliation ","chapterCount":"2", "isCoverDesignOnly":"true"}
    
    &userDetails={"firstName": "Sulthana","surName": "S","mailId": "sulthanas@s4carlisle.com" }


    {
 "StatusCode": <<code>>,
 "Status": <<status message>> "


*/


$error_count = 0;
$resp=array();
//Book info
if (isset($_GET['bookInfo'])) {
    if (!empty(($_GET['bookInfo']))) {


        $bookInfo = json_decode($_GET['bookInfo'], true);

        //echo "bookInfo:" . json_encode($bookInfo) . "\n\n";

        //Author name
        if (isset($bookInfo["Author Name"])) {
            if (!empty($bookInfo["Author Name"])) {
                $authorName = $bookInfo["Author Name"];
            } else {
                $authorName = null;
                //$error_count += 1;
            }
        } else {
            $authorName = null;
            /*$resp[] = array(
                'StatusCode' => 'JSON001',
                'Status' => 'Author Name is not found.'
            );
            $error_count += 1;
            //header('Content-Type: application/json; charset=utf-8');
            //echo json_encode($resp);*/
        }

        //Author email
        if (isset($bookInfo["Email"])) {
            if (!empty($bookInfo["Email"])) {
                $authorEmail = $bookInfo["Email"];
                $pattern = '/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/';
                if (preg_match($pattern, $authorEmail) == 0) {
                   /* $resp[] = array(
                        'StatusCode' => 'JSON003',
                        'Status' => 'Email contains invalid mail id.'
                    );
                  //  $error_count += 1;*/
                   // header('Content-Type: application/json; charset=utf-8');
                   // echo json_encode($resp);
                }
            } else {
                $authorEmail = null;
                /*$resp[] = array(
                    'StatusCode' => 'JSON002',
                    'Author Email' => 'Author Email is empty.'

                );
                $error_count += 1;
                //header('Content-Type: application/json; charset=utf-8');
                //echo json_encode($resp);*/
            }
        } else {
            $authorEmail = null;
            /*$resp[] = array(
                'StatusCode' => 'JSON001',
                'Status' => 'Author Email is not found.'
            );
            $error_count += 1;
            //header('Content-Type: application/json; charset=utf-8');
            //echo json_encode($resp);*/
        }

        //ISBN
        if (isset($bookInfo["ISBN"])) {
            if (!empty($bookInfo["ISBN"])) {
                $isbn = $bookInfo["ISBN"];
            } else {
                $isbn = null;
            }
        } else {
           $isbn = null;
           /*
            $resp[] = array(
                'StatusCode' => 'JSON001',
                'Status' => 'ISBN is not found.'
            );
           // header('Content-Type: application/json; charset=utf-8');
            //echo json_encode($resp);*/
        }


        //Cover
        if (isset($bookInfo["Cover"])) {
            if (!empty($bookInfo["Cover"])) {
                $interiorDesign = $bookInfo["Cover"];
            } else {
                $interiorDesign = null;

            }
        } else {
            $interiorDesign = null;

            /*$resp[] = array(
                'StatusCode' => 'JSON001',
                'Status' => 'Cover is not found.'
            );
           // header('Content-Type: application/json; charset=utf-8');
            //echo json_encode($resp);*/

        }

        //Editorial Complexity
        if (isset($bookInfo["Editorial Complexity"])) {
            if (!empty($bookInfo["Editorial Complexity"])) {
                $editorialComplexity = $bookInfo["Editorial Complexity"];
            } else {
                $editorialComplexity = null;

            }
        } else {
            $editorialComplexity = null;
            /*$resp[] = array(
                'StatusCode' => 'JSON001',
                'Status' => 'Editorial Complexity is not found.'
            );

            //header('Content-Type: application/json; charset=utf-8');
            //echo json_encode($resp);*/
        }

        //Number of Manuscript Pages
        if (isset($bookInfo["Number of Manuscript Pages"])) {
            if (!empty($bookInfo["Number of Manuscript Pages"])) {
                $nuberOfMenuscriptPages = $bookInfo["Number of Manuscript Pages"];
            } else {
                $nuberOfMenuscriptPages = 0;
            }
        } else {
            $nuberOfMenuscriptPages = 0;
            /*$resp[] = array(
                'StatusCode' => 'JSON001',
                'Status' => 'Number of Manuscript Pages is not found.'
            );
            //header('Content-Type: application/json; charset=utf-8');
            //echo json_encode($resp);*/
        }

    } else {
        $bookInfo = null;
        $authorName = null;
        $authorEmail = null;
        $isbn = null;
        $interiorDesign = null;
        $editorialComplexity = null;
        $nuberOfMenuscriptPages = 0;

       /* $resp[] = array(
            'StatusCode' => 'JSON002',
            'Status' => 'Book Info is empty.'
        );
        $error_count += 1;
        //header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($resp);*/
    }
} else {
    $bookInfo = null;
    $authorName = null;
    $authorEmail = null;
    $isbn = null;
    $interiorDesign = null;
    $editorialComplexity = null;
    $nuberOfMenuscriptPages = 0;

    /*$resp[] = array(
        'StatusCode' => 'JSON001',
        'Status' => 'Book Info is not found.'
    );
    $error_count += 1;
    //header('Content-Type: application/json; charset=utf-8');
    //echo json_encode($resp);*/
}

//Book Details
if (isset($_GET['bookDetails'])) {
    if ((!empty(($_GET['bookDetails'])))) {
        $bookDetails = json_decode($_GET['bookDetails'], true);

        //echo "bookDetails:" . json_encode($bookDetails) . "\n\n";

        //Category
        if (isset($bookDetails["categoryName"])) {
            if (!empty($bookDetails["categoryName"])) {
                $category = $bookDetails["categoryName"];
                if ($category == "Index") {
                    $category = "Index Services";
                }
                //echo ($category=="Cover Design");

                if (($category == "Full Services") || ($category == "Cover Design") || ($category == "Production and Index") || ($category == "Cover and Production") || ($category == "Production, Cover, and Editorial") || ($category == "Production and Editorial") || ($category == "Production Services") || ($category == "Index Services") || ($category == "Editorial Services") || ($category == "Production, Editorial, and Index") || ($category == "Production, Cover, and Index")||($category == "Editorial and Index")) {
                    $categoryName = cleanStr($category);
                } else {
                    $categoryName = cleanStr($category);
                    $resp[] = array(
                        'StatusCode' => 'JSON003',
                        'Status' => 'categoryName contains invalid service.'
                    );
                    $error_count += 1;
                    //header('Content-Type: application/json; charset=utf-8');
                    //echo json_encode($resp);
                }

            } else {
                $category = null;
                $resp[] = array(
                    'StatusCode' => 'JSON002',
                    'Status' => 'categoryName is empty.'
                );
                $error_count += 1;
                //header('Content-Type: application/json; charset=utf-8');
                //echo json_encode($resp);
            }
        } else {
            $category = null;
            $resp[] = array(
                'StatusCode' => 'JSON001',
                'Status' => 'categoryName is not found.'
            );
            $error_count += 1;
            //header('Content-Type: application/json; charset=utf-8');
            //echo json_encode($resp);
        }

        //bookName
        if (isset($bookDetails["bookName"])) {
            if (!empty($bookDetails["bookName"])) {
                $bookTitle = $bookDetails["bookName"];
            } else {
                $bookTitle = null;
                $resp[] = array(
                    'StatusCode' => 'JSON002',
                    'Status' => 'bookName is empty.'
                );
                $error_count += 1;
            }
        } else {
            $bookTitle = null;
            $resp[] = array(
                'StatusCode' => 'JSON001',
                'Status' => 'bookName is not found.'
            );
            $error_count += 1;
            //header('Content-Type: application/json; charset=utf-8');
            //echo json_encode($resp);
        }

    } else {
        $bookDetails = null;
        $category = null;
        $categoryName = null;
        $bookTitle = null;

        $resp[] = array(
            'StatusCode' => 'JSON002',
            'Status' => 'bookDetails is empty.'
        );
        $error_count += 1;
        //header('Content-Type: application/json; charset=utf-8');
       // echo json_encode($resp);
    }
} else {
    $bookDetails = null;
    $category = null;
    $categoryName = null;
    $bookTitle = null;

    $resp[] = array(
        'StatusCode' => 'JSON001',
        'Status' => 'bookDetails is not found.'
    );
    $error_count += 1;
    //header('Content-Type: application/json; charset=utf-8');
    //echo json_encode($resp);
}

//User details
if (isset($_GET['userDetails'])) {
    if (!empty(($_GET['userDetails']))) {
        $userDetails = json_decode($_GET['userDetails'], true);

        //echo "userDetails:" . json_encode($userDetails) . "\n\n";

        //User first name
        if (isset($userDetails["firstName"])) {
            if (!empty($userDetails["firstName"])) {
                $firstName = $userDetails["firstName"];
            } else {
                $firstName = null;
                $resp[] = array(
                    'StatusCode' => 'JSON002',
                    'Status' => 'firstName is empty.'
                );
                $error_count += 1;
            }
        } else {
            $firstName = null;
            $resp[] = array(
                'StatusCode' => 'JSON001',
                'Status' => 'firstName is not found.'
            );
            $error_count += 1;
            //header('Content-Type: application/json; charset=utf-8');
            //echo json_encode($resp);
        }

        //User surName
        if (isset($userDetails["surName"])) {
            if (!empty($userDetails["surName"])) {
                $surName = $userDetails["surName"];
            } else {
                $surName = null;
               /* $resp[] = array(
                    'StatusCode' => 'JSON002',
                    'Status' => 'surName is empty.'
                );
                $error_count += 1;*/
            }
        } else {
            $surName = null;
           /* $resp[] = array(
                'StatusCode' => 'JSON001',
                'Status' => 'surName is not found.'
            );
            $error_count += 1;*/
            //header('Content-Type: application/json; charset=utf-8');
            //echo json_encode($resp);
        }
        if(!empty($surName))
        {
            $surName=" ".$surName;
        }
        else{
            $surName=null;
        }
        $userName = $firstName.$surName;
        $authorName=$userName;

        //user email
        if (isset($userDetails["mailId"])) {
            if (!empty($userDetails["mailId"])) {
                $userMail = $userDetails["mailId"];
                
                $pattern = '/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/';
                
                if (preg_match($pattern, $userMail) == 0) {
                    $resp[] = array(
                        'StatusCode' => 'JSON003',
                        'Status' => 'mailId contains invalid mail id.'
                    );
                    $error_count += 1;
                    //header('Content-Type: application/json; charset=utf-8');
                    //echo json_encode($resp);
                }
                $authorEmail=$userMail;
            } else {
                $userMail = null;
                $authorEmail=null;
                $resp[] = array(
                    'StatusCode' => 'JSON002',
                    'Status' => 'mailId is empty'
                );
                $error_count += 1;
                //header('Content-Type: application/json; charset=utf-8');
                //echo json_encode($resp);
            }
        } else {
            $userMail = null;
            $authorEmail=null;
            $resp[] = array(
                'StatusCode' => 'JSON001',
                'Status' => 'mailId is not found'
            );
            $error_count += 1;
            //header('Content-Type: application/json; charset=utf-8');
            //echo json_encode($resp);
        }

    } else {
        $userDetails = null;
        $firstName = null;
        $surName = null;
        $userName = null;
        $userMail = null;
        $authorName=null;
        $authorEmail=null;
        $resp[] = array(
            'StatusCode' => 'JSON002',
            'Status' => 'userDetails is empty.'
        );
        $error_count += 1;
       // header('Content-Type: application/json; charset=utf-8');
       // echo json_encode($resp);
    }

} else {
    $userDetails = null;
    $firstName = null;
    $surName = null;
    $userName = null;
    $authorName=null;
    $userMail = null;
    $authorEmail=null;
    $resp[] = array(
        'StatusCode' => 'JSON002',
        'Status' => 'userDetails is not found.'
    );
    $error_count += 1;
   //header('Content-Type: application/json; charset=utf-8');
   // echo json_encode($resp);
}



/*echo "\n\n---Given Details---\nAuthor Name: " . $authorName . "
Author Mail: " . $authorEmail . "
ISBN: " . $isbn . "
Interior Design: " . $interiorDesign . "
Editorial Complexity: " . $editorialComplexity . "
Number of Menuscript Pages: " . $nuberOfMenuscriptPages . "
Category: " . $category . "
Book Title: " . $bookTitle . "
User Name: " . $userName . "
User Mail: " . $userMail;*/


/*Project Id Creattion */
if ($category == "Full Services") {
    $id = substr($authorName, 0, 4) . time() . rand(0, 9) . "fs";

} else if ($category == "Cover Design") {
    $id = substr($authorName, 0, 4) . time() . rand(0, 9) . "cd";
} else if ($category == "Production and Index") {
    $id = substr($authorName, 0, 4) . time() . rand(0, 9) . "pi";
} else if ($category == "Cover and Production") {
    $id = substr($authorName, 0, 4) . time() . rand(0, 9) . "cp";
} else if ($category == "Production, Cover, and Editorial") {
    $id = substr($authorName, 0, 4) . time() . "pce";
} else if ($category == "Production and Editorial") {
    $id = substr($authorName, 0, 4) . time() . rand(0, 9) . "pe";
} else if ($category == "Production Services") {
    $id = substr($authorName, 0, 4) . time() . rand(0, 9) . "ps";
} else if ($category == "Index Services") {

    $id = substr($authorName, 0, 4) . time() . rand(0, 9) . "i";
} else if ($category == "Editorial Services") {

    $id = substr($authorName, 0, 4) . time() . rand(0, 9) . "es";
} else if ($category == "Production, Editorial, and Index") {

    $id = substr($authorName, 0, 4) . time() . rand(0, 9) . "pei";
} else if ($category == "Production, Cover, and Index") {

    $id = substr($authorName, 0, 4) . time() . rand(0, 9) . "pci";
}else if ($category == "Editorial and Index") {

    $id = substr($authorName, 0, 4) . time() . rand(0, 9) . "ei";
}
else {
    $id = substr($authorName, 0, 4) . time() . rand(0, 9);
    $resp[] = array(
        'StatusCode' => 'JSON004',
        'Status' => 'Project id creation is failed.'
    );
    $error_count += 1;
    //header('Content-Type: application/json; charset=utf-8');
    //echo json_encode($resp);
}

//echo "\n\nGenerated project_id:" . $id;
$eid = encryptor('encrypt', $id);

//Inserting data into table
$sql1 = "INSERT INTO services (id,authorName,authorEmail,category,bookTitle,isbn,interiorDesign,editorialComplexity,nuberOfMenuscriptPages,userName,userMail) 
VALUES ('" . $id . "','" . $authorName . "','" . $authorEmail . "','" . $category . "','" . $bookTitle . "','" . $isbn . "','" . $interiorDesign . "','" . $editorialComplexity . "','" . $nuberOfMenuscriptPages . "','" . $userName . "','" . $userMail . "')";

$query_run = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

if ($query_run == false) {

    $resp = array(
        'StatusCode' => 'JSON004',
        'Status' => 'Mysql insert query is failed.'
    );
    $error_count += 1;
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($resp);
}
mysqli_close($conn);



//Mail to author
if ($error_count == 0) {


    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    //Email Body
    if ($category == "Full Services") {
        $emailBody = '<p>Dear ' . $userName . ',</p>
        <p>Thank you for trusting our team to create a great-looking page layout for your book. We will handle all technical aspects of the project, ensure that your book will meet all standard print requirements, and deliver a high-quality, professional design. We’re confident you will be pleased with the results.</p>
        <p>In order to complete this project in a timely manner, you will need to upload your manuscript and provide specific pieces of information regarding color, dimensions, and other specifications as we work together to produce a finished work we will all be proud of. You wrote a great book – we’ll make it look great!</p>
        <p>Just <a href="http://10.1.6.32/selfpublishing/' . $categoryName . '.php?id=' . $eid . '">[Click Here]</a> to begin. Please feel free to contact us if you have any questions at <a href="mailto:selfpublish@s4carlisle.com" target="_blank" >selfpublish@s4carlisle.com</a></p>
        <p>Regards,<br>S4Carlisle Design Team.</p>';
        $emailBody = mb_convert_encoding($emailBody, "HTML-ENTITIES", 'UTF-8');
    } else if ($category == "Cover Design") {
        $emailBody = '<p>Dear ' . $userName . ',</p>
        <p>Thank you for choosing to work with us to create your book cover design. Our professional design team stands ready to guide you through each step of the process. We will work closely with you to deliver an eye-catching cover design that will make readers take notice.</p>
        <p>We will be asking you to provide information and various elements we will need to complete this project, such as relevant specifications, text to appear on the cover, and any images (for which you own all rights and permissions) you would like us to use.</p>
        <p>Just <a href="http://10.1.6.32/selfpublishing/' . $categoryName . '.php?id=' . $eid . '">[Click Here]</a> to begin. Please feel free to contact us if you have any questions at <a href="mailto:selfpublish@s4carlisle.com" target="_blank" >selfpublish@s4carlisle.com</a></p>
        <p>Regards,<br>S4Carlisle Design Team.</p>';
        $emailBody = mb_convert_encoding($emailBody, "HTML-ENTITIES", 'UTF-8');
    } else if ($category == "Editorial Services") {
        $emailBody = '<p>Dear ' . $userName . ',</p>
        <p>Thank you for trusting our team to create a great-looking page layout for your book. We will manage all technical aspects of the project, ensure that your book will meet all standard print requirements, and deliver a high-quality, professional design.</p>
        <p>Avail of our copy editing, proofreading and indexing services to give your manuscript a final polish that will give it an edge over others. We’re confident you will be pleased with the results.</p>
        <p>In order to complete this project in a timely manner, you will need to upload your manuscript and provide specific pieces of information regarding color, dimensions, and other specifications as we work together to produce a finished work we will all be proud of. You wrote a great book – we’ll make it look great!</p>
        <p>Just <a href="http://10.1.6.32/selfpublishing/' . $categoryName . '.php?id=' . $eid . '">[Click Here]</a> to begin. Please feel free to contact us if you have any questions at <a href="mailto:selfpublish@s4carlisle.com" target="_blank" >selfpublish@s4carlisle.com</a></p>
        <p>Regards,<br>S4Carlisle Design Team.</p>';
        $emailBody = mb_convert_encoding($emailBody, "HTML-ENTITIES", 'UTF-8');
    } else if (($category == "Index Services") || ($category == "Index")) {
        $emailBody = '<p>Dear ' . $userName . ',</p>
        <p>Thank you for trusting our team to create a great-looking page layout for your book. We will manage all technical aspects of the project, ensure that your book will meet all standard print requirements, and deliver a high-quality, professional design.</p>
        <p>Avail of our copy editing, proofreading and indexing services to give your manuscript a final polish that will give it an edge over others. We’re confident you will be pleased with the results.</p>
        <p>In order to complete this project in a timely manner, you will need to upload your manuscript and provide specific pieces of information regarding color, dimensions, and other specifications as we work together to produce a finished work we will all be proud of. You wrote a great book – we’ll make it look great!</p>
        <p>Just <a href="http://10.1.6.32/selfpublishing/' . $categoryName . '.php?id=' . $eid . '">[Click Here]</a> to begin. Please feel free to contact us if you have any questions at <a href="mailto:selfpublish@s4carlisle.com" target="_blank" >selfpublish@s4carlisle.com</a></p>
        <p>Regards,<br>S4Carlisle Design Team.</p>';
        $emailBody = mb_convert_encoding($emailBody, "HTML-ENTITIES", 'UTF-8');
    } else {
        $emailBody = '<p>Dear ' . $userName . ',</p>
        <p>Thank you for trusting our team to create a great-looking page layout for your book. We will handle all technical aspects of the project, ensure that your book will meet all standard print requirements, and deliver a high-quality, professional design. We’re confident you will be pleased with the results.</p>
        <p>In order to complete this project in a timely manner, you will need to upload your manuscript and provide specific pieces of information regarding color, dimensions, and other specifications as we work together to produce a finished work we will all be proud of. You wrote a great book – we’ll make it look great!</p>
        <p>Just <a href="http://10.1.6.32/selfpublishing/' . $categoryName . '.php?id=' . $eid . '">[Click Here]</a> to begin. Please feel free to contact us if you have any questions at <a href="mailto:selfpublish@s4carlisle.com" target="_blank" >selfpublish@s4carlisle.com</a></p>
        <p>Regards,<br>S4Carlisle Design Team.</p>';
        $emailBody = mb_convert_encoding($emailBody, "HTML-ENTITIES", 'UTF-8');
    }



    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.office365.com'; // smtp.gmail.com Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'selfpublish@s4carlisle.com'; // sulthanaofficial111@gmail.com SMTP username
        $mail->Password = 'Mad87652'; // zrjqzsandnvphfnc SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //ENCRYPTION_SMTPS Enable implicit TLS encryption
        $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('selfpublish@s4carlisle.com', 'Self-Publish-S4C');
        //$mail->addAddress('joe@gmail.net', 'Joe User');     //Add a recipient
        $mail->addAddress($userMail); //Name is optional
        // $mail->addReplyTo('info@gmail.com', 'Information');
        $mail->addCC('selfpublish@s4carlisle.com');
        // $mail->addBCC('bcc@gmail.com');

        //Attachments
        //  $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true); //Set email format to HTML
        
        $mail->Subject = 'Starting your '.strtolower($category).' project';
        $mail->Body = $emailBody;
        //$mail->AltBody = "Project:".$id;
        $mail->send();

        $resp[] = array(
            'StatusCode' => 'JSON200',
            'Status' => 'Mail sent successfully. Please check your mail.'
        );
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($resp);

    } catch (Exception $e) {
        $resp = array(
            'StatusCode' => 'JSON005',
            'Status' => 'Mail not sent.'
        );
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($resp);

    }

} else {
    $resp[] = array(
        'StatusCode' => 'JSON005',
        'Status' => 'Mail not sent.'
    );
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($resp);
}

?>