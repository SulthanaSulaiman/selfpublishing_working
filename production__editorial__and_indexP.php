<?php
require 'config.php';
require 'connection.php';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production, Editorial, and Index</title>

    <link href="style/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <script src="style/bootstrap.bundle.min.js"></script>
    <script src="style/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css">
    
</head>

<body>
    <?php
     function encodeValue ($s) {
        return htmlentities($s, ENT_COMPAT|ENT_QUOTES,'ISO-8859-1', true); 
    }
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $id = encryptor('decrypt', $id);
        //echo $id;
        $eid = encryptor('encrypt', $id);
        try {
            if (!empty($id)) {
                $fetch_data = mysqli_query($conn, "select * from services where id='$id'");
                $result = mysqli_fetch_array($fetch_data);

                //$requestedServices = explode(' ', $result['requestedServices']);
    
                //$requestedServices[]=$result['requestedServices'];
                // in_array('CopyEditing',$result['requestedServices']) ? 'checked="checked"' : '';
                //echo in_array('Copyediting',(explode(',', $result['requestedServices'])))?"test":"false";
    
                // echo implode(',',explode(',',$result['requestedServices']));
    
            }
        } catch (Exception $e) {

            echo 'Error: ' . $e->getMessage();
        }
    } ?>

    <div class="container">

        <div class="row">
            <div class="col-lg-3 "><img src="style/S4Clogo.png" style="height:55px;width:180px; margin-top: 10px;"
                    alt="S4Carlisle Publishing Services"></div>


            <div class="col-lg-6">
                <h3 class="text-center p-2 heading  ">PRODUCTION, EDITORIAL, AND INDEX</h3>
            </div>

        </div>


        <div class="wrapper rounded bg-white">

            <form name="authorForm" onsubmit="return validateForm()"
                action="http://10.1.6.32/selfpublishing/productionMailer.php?id=<?php echo $eid; ?>" method="post"
                enctype="multipart/form-data" class="form" novalidate>

                <h5 style="text-align:right;" class="text-primary">
                    Project Id:
                    <?php if(!empty($id))echo $id; ?>
                </h5>
                <div class="row">

                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Author name</label>
                        <input type="text" class="form-control required" value="<?php if ((!empty($result['authorName']))) {
                            echo ($result['authorName']);
                        } ?>" name="authorName" id="authorName" required readonly="readonly">

                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Email</label>
                        <input type="text" class="form-control required" value="<?php if ((!empty($result['authorEmail']))) {
                            echo ($result['authorEmail']);
                        } ?>" name="authorEmail" id="authorEmail" required readonly="readonly">

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Book title</label>
                        <input type="text" class="form-control required" value="<?php if ((!empty($result['bookTitle']))) {
                            echo ($result['bookTitle']);
                        } ?>" name="bookTitle" id="bookTitle" required readonly="readonly">

                    </div>

                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Book subtitle</label>
                        <input type="text" class="form-control" name="bookSubTitle" id="bookSubTitle" value="<?php if ((!empty($result['bookSubtitle']))) {
                            echo ($result['bookSubtitle']);
                        } ?>" readonly="readonly">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Interior design color<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="interiorDesign1" id="interiorDesign1" value="<?php if ((!empty($result['interiorDesign1']))) {
                            echo ($result['interiorDesign1']);
                        } ?>" readonly="readonly">

                        <div class="text-danger" id="servicesErr"></div>

                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Editorial Complexity<span class="text-danger">*</span>
                            <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                title="Editorial complexity is Low or Medium or High.">
                                <sup> <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18"
                                        viewBox="0 0 512 512">
                                        <path fill="#25B7D3"
                                            d="M504.1,256C504.1,119,393,7.9,256,7.9C119,7.9,7.9,119,7.9,256C7.9,393,119,504.1,256,504.1C393,504.1,504.1,393,504.1,256z">
                                        </path>
                                        <path fill="#FFF"
                                            d="M323.2 367.5c-1.4-2-4-2.8-6.3-1.7-24.6 11.6-52.5 23.9-58 25-.1-.1-.4-.3-.6-.7-.7-1-1.1-2.3-1.1-4 0-13.9 10.5-56.2 31.2-125.7 17.5-58.4 19.5-70.5 19.5-74.5 0-6.2-2.4-11.4-6.9-15.1-4.3-3.5-10.2-5.3-17.7-5.3-12.5 0-26.9 4.7-44.1 14.5-16.7 9.4-35.4 25.4-55.4 47.5-1.6 1.7-1.7 4.3-.4 6.2 1.3 1.9 3.8 2.6 6 1.8 7-2.9 42.4-17.4 47.6-20.6 4.2-2.6 7.9-4 10.9-4 .1 0 .2 0 .3 0 0 .2.1.5.1.9 0 3-.6 6.7-1.9 10.7-30.1 97.6-44.8 157.5-44.8 183 0 9 2.5 16.2 7.4 21.5 5 5.4 11.8 8.1 20.1 8.1 8.9 0 19.7-3.7 33.1-11.4 12.9-7.4 32.7-23.7 60.4-49.7C324.3 372.2 324.6 369.5 323.2 367.5zM322.2 84.6c-4.9-5-11.2-7.6-18.7-7.6-9.3 0-17.5 3.7-24.2 11-6.6 7.2-9.9 15.9-9.9 26.1 0 8 2.5 14.7 7.3 19.8 4.9 5.2 11.1 7.8 18.5 7.8 9 0 17-3.9 24-11.6 6.9-7.6 10.4-16.4 10.4-26.4C329.6 96 327.1 89.6 322.2 84.6z">
                                        </path>
                                    </svg></sup>
                            </div></label>
                        <input type="text" class="form-control" name="editorialCompexity" id="editorialCompexity" value="<?php if ((!empty($result['editorialComplexity']))) {
                            echo ($result['editorialComplexity']);
                        } ?>" required readonly="readonly">
                    </div>
                </div>


               
                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Number of manuscript pages<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="numberOfMenuscriptPages"
                            id="numberOfMenuscriptPages" value="<?php if ((!empty($result['nuberOfMenuscriptPages']))) {
                                echo $result['nuberOfMenuscriptPages'];
                            } ?>" required readonly="readonly">

                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Trim size<span class="text-danger">*</span></label>

                        <input type="text" class="form-control" name="isbn" id="isbn" value="<?php if ((!empty($result['trimSize']))) {
                            echo encodeValue($result['trimSize']);
                        } ?>" readonly="readonly">
                        <div class="text-danger" id="trimSizeErr"></div>

                    </div>
                   
                </div>


     
                   
                <div class="row">
                        <div class="col-md-6 mt-md-0 mt-3">
                        <label>ISBN</label>
                        <input type="text" class="form-control" name="isbn" id="isbn" value="<?php if ((!empty($result['isbn']))) {
                            echo ($result['isbn']);
                        } ?>" readonly="readonly">
                        <br>
                         <label>Your vision for interior design.<!--<span class="text-danger">*</span>-->
                                <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                    title="Your vision for interior design.">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18"
                                        viewBox="0 0 512 512">
                                        <path fill="#25B7D3"
                                            d="M504.1,256C504.1,119,393,7.9,256,7.9C119,7.9,7.9,119,7.9,256C7.9,393,119,504.1,256,504.1C393,504.1,504.1,393,504.1,256z">
                                        </path>
                                        <path fill="#FFF"
                                            d="M323.2 367.5c-1.4-2-4-2.8-6.3-1.7-24.6 11.6-52.5 23.9-58 25-.1-.1-.4-.3-.6-.7-.7-1-1.1-2.3-1.1-4 0-13.9 10.5-56.2 31.2-125.7 17.5-58.4 19.5-70.5 19.5-74.5 0-6.2-2.4-11.4-6.9-15.1-4.3-3.5-10.2-5.3-17.7-5.3-12.5 0-26.9 4.7-44.1 14.5-16.7 9.4-35.4 25.4-55.4 47.5-1.6 1.7-1.7 4.3-.4 6.2 1.3 1.9 3.8 2.6 6 1.8 7-2.9 42.4-17.4 47.6-20.6 4.2-2.6 7.9-4 10.9-4 .1 0 .2 0 .3 0 0 .2.1.5.1.9 0 3-.6 6.7-1.9 10.7-30.1 97.6-44.8 157.5-44.8 183 0 9 2.5 16.2 7.4 21.5 5 5.4 11.8 8.1 20.1 8.1 8.9 0 19.7-3.7 33.1-11.4 12.9-7.4 32.7-23.7 60.4-49.7C324.3 372.2 324.6 369.5 323.2 367.5zM322.2 84.6c-4.9-5-11.2-7.6-18.7-7.6-9.3 0-17.5 3.7-24.2 11-6.6 7.2-9.9 15.9-9.9 26.1 0 8 2.5 14.7 7.3 19.8 4.9 5.2 11.1 7.8 18.5 7.8 9 0 17-3.9 24-11.6 6.9-7.6 10.4-16.4 10.4-26.4C329.6 96 327.1 89.6 322.2 84.6z">
                                        </path>
                                    </svg>
                                </div>
                            </label>
                            <textarea class="form-control" name="other" id="other" rows="2" readonly="readonly";
                             data-toggle="tooltip" data-placement="top"
                                title="Your vision for interior design."><?php if ((!empty($result['other']))) {
                                    echo ($result['other']);
                                } ?></textarea>
                        </div>
                        <div class="col-md-6 mt-md-0 mt-3">  
                        <div <?php if ((!empty($result['submitCount']))&&(($result['submitCount']))&&(!empty($result['fileName']))) {
                            echo 'style="display:block;"';
                        } else {
                            echo 'style="display:none;"';
                        } ?>>
                            <label> Download manuscript or other file(s)<!--<span class="text-danger">*</span>--></label>
                            <div class="text-center">
                                <label class="form-control dropzone1">
                                    <a download="<?php if (!empty($result['fileName'])) {
                                        echo $result['fileName'];
                                    } else {
                                        echo 'fileNotUploaded';
                                    } ?>"
                                        href="uploads/<?php if (!empty($result['fileName'])) {
                                            echo $result['fileName'];
                                        } else {
                                            echo 'fileNotUploaded';
                                        } ?>"><span><i
                                                class="fa fa-cloud-download text-centre text-primary fa-5x"></i></span>
                                        <p class="text-centre text-primary" id="noOfFiles">Download manuscript
                                            file(s)
                                        </p>
                                    </a>

                                </label>

                            </div>
                            
                        </div>

                        <div <?php if ((!empty(($result['submitCount'])))&&(($result['submitCount']))&&(empty($result['fileName']))) {
                            echo 'style="display:block;"';
                        } else {
                            echo 'style="display:none;"';
                        } ?>>
                            <label> Download manuscript or other file(s)<!--<span class="text-danger">*</span>--></label>
                            <div class="text-center">
                                <label class="form-control dropzone1">
                                <span><i
                                                class="fa fa-cloud-download text-centre text-primary fa-5x"></i></span>
                                        <p class="text-centre text-primary" id="noOfFiles"> Manuscript file(s) is not uploaded.
                                        </p>
                                   
                                </label>

                            </div>
                            
                        </div>

                    </div>


                        </div>

                    </div>


                    <!--<div class="row">
                        <div class="col-md-12 mt-md-0 mt-3 text-center">
                            <button type="submit" class="btn btn-primary btn-lg" name="export" disabled="disabled">Export to Excel</button>
                        </div>
                    </div>-->
            </form>
        </div>
    </div>
 
    <div class="footer-copyright text-center py-3"><span class="text-white">©
            <script>
                document.write((new Date().getFullYear()).toString());
            </script> Copyright: <a style="color:white" href="https://www.s4carlisle.com/" target="_blank">S4Carlisle Publishing
                Services Pvt.
                Ltd.
            </a>
        </span>
    </div>
</body>

</html>