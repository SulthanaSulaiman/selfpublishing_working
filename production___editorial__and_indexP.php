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
                <h3 class="text-center p-2 heading">PRODUCTION, EDITORIAL, AND INDEX</h3>
            </div>

        </div>


        <div class="wrapper rounded bg-white">

            <form name="authorForm" onsubmit="return validateForm()"
                action="http://10.1.6.32/selfpublishing/productionMailer.php?id=<?php echo $eid; ?>" method="post"
                enctype="multipart/form-data" class="form" novalidate>

                <h5 style="text-align:right;" class="text-primary">
                    Project Id:
                    <?php echo $id; ?>
                </h5>
                <div class="row">

                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Author name</label>
                        <input type="text" class="form-control required" value="<?php if ((!empty($result['authorName']))) {
                            echo encodeValue($result['authorName']);
                        } ?>" name="authorName" id="authorName" required readonly="readonly">

                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Email</label>
                        <input type="text" class="form-control required" value="<?php if ((!empty($result['authorEmail']))) {
                            echo encodeValue($result['authorEmail']);
                        } ?>" name="authorEmail" id="authorEmail" required readonly="readonly">

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Book title</label>
                        <input type="text" class="form-control required" value="<?php if ((!empty($result['bookTitle']))) {
                            echo encodeValue($result['bookTitle']);
                        } ?>" name="bookTitle" id="bookTitle" required readonly="readonly">

                    </div>

                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Book subtitle</label>
                        <input type="text" class="form-control" name="bookSubTitle" id="bookSubTitle" value="<?php if ((!empty($result['bookSubtitle']))) {
                            echo encodeValue($result['bookSubtitle']);
                        } ?>" readonly="readonly">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Interior design</label>
                        <input type="text" class="form-control" name="interiorDesign" id="interiorDesign" value="<?php if ((!empty($result['interiorDesign']))) {
                            echo encodeValue($result['interiorDesign']);
                        } ?>" required readonly="readonly">
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Editorial Complexity</label>
                        <input type="text" class="form-control" name="editorialCompexity" id="editorialCompexity" value="<?php if ((!empty($result['editorialComplexity']))) {
                            echo encodeValue($result['editorialComplexity']);
                        } ?>" required readonly="readonly">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Number of manuscript pages</label>
                        <input type="text" class="form-control" name="numberOfMenuscriptPages"
                            id="numberOfMenuscriptPages" value="<?php if ((!empty($result['nuberOfMenuscriptPages']))) {
                                echo $result['nuberOfMenuscriptPages'];
                            } ?>" required readonly="readonly">
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>ISBN</label>
                        <input type="text" class="form-control" name="isbn" id="isbn" value="<?php if ((!empty($result['isbn']))) {
                            echo encodeValue($result['isbn']);
                        } ?>" readonly="readonly">

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Trim size<span class="text-danger">*</span></label>

                        <input type="text" class="form-control" name="isbn" id="isbn" value="<?php if ((!empty($result['trimSize']))) {
                            echo encodeValue($result['trimSize']);
                        } ?>" readonly="readonly">
                        
                        <br>
                        

                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Requested services<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="isbn" id="isbn" value="<?php if ((!empty($result['requestedServices']))) {
                            echo encodeValue($result['requestedServices']);
                         } ?>" readonly="readonly">

                       
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                    <label>Your vision for your interior design.<!--<span class="text-danger">*</span>-->
                            </label>
                            <textarea class="form-control" name="visonInteriorDesign" id="visonInteriorDesign" rows="5" readonly="readonly"
                            data-toggle="tooltip" data-placement="top"
                                title="Your vision for your interior design."><?php if ((!empty($result['visonInteriorDesign']))) {
                                    echo encodeValue($result['visonInteriorDesign']);
                                } ?></textarea>
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <div>
                                <label>Download manuscript file(s)<span class="text-danger">*</span></label>
                                <div class="text-center">
                                    <label class="form-control dropzone1">
                                        <a download="<?php if(!empty($result['fileName'])){echo $result['fileName'];}else{ echo 'fileNotUploaded';} ?>"
                                            href="uploads/<?php if(!empty($result['fileName'])){echo $result['fileName'];}else{ echo 'fileNotUploaded';} ?>"><span><i
                                                    class="fa fa-cloud-download text-centre text-primary fa-5x"></i></span>
                                            <p class="text-centre text-primary" id="noOfFiles">Download manuscript file(s)
                                            </p>
                                        </a>

                                    </label>

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


    <script src="style/script.js"></script>
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