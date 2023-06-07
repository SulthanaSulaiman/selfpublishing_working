<?php
require 'config.php';
require 'connection.php';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cover and Production</title>

    <link href="style/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <script src="style/bootstrap.bundle.min.js"></script>
    <script src="style/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css">
    <script>

    </script>
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
                <h3 class="text-center p-2 " style="color:white; margin-top: 10px;">COVER AND PRODUCTION</h3>
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

                        <label>Cover type<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="coverType" id="coverType" value="<?php if ((!empty($result['coverType']))) {
                            echo encodeValue($result['coverType']);
                        } ?>" readonly="readonly">

                        <div class="text-danger" id="coverTypeErr"></div>
                    </div>

                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Price to create barcode in dollars<span class="text-danger">*</span></label>
                        <input type="number" step="any" min="0" name="priceBarcode" class="form-control" value="<?php if ((!empty($result['priceBarcode']))) {
                            echo $result['priceBarcode'];
                        } ?>" required readonly="readonly">
                        <div class="text-danger" id="priceBarcodeErr"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Trim size<span class="text-danger">*</span></label>

                        <input type="text" class="form-control" name="isbn" id="isbn" value="<?php if ((!empty($result['trimSize']))) {
                            echo encodeValue($result['trimSize']);
                        } ?>" readonly="readonly">
                        <div class="text-danger" id="trimSizeErr"></div>

                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Paper weight<span class="text-danger">*</span>
                            <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                title="Paper Weignt in Grams per Square Millimeter">
                                <sup> <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18"
                                        viewBox="0 0 512 512">
                                        <path fill="#25B7D3"
                                            d="M504.1,256C504.1,119,393,7.9,256,7.9C119,7.9,7.9,119,7.9,256C7.9,393,119,504.1,256,504.1C393,504.1,504.1,393,504.1,256z">
                                        </path>
                                        <path fill="#FFF"
                                            d="M323.2 367.5c-1.4-2-4-2.8-6.3-1.7-24.6 11.6-52.5 23.9-58 25-.1-.1-.4-.3-.6-.7-.7-1-1.1-2.3-1.1-4 0-13.9 10.5-56.2 31.2-125.7 17.5-58.4 19.5-70.5 19.5-74.5 0-6.2-2.4-11.4-6.9-15.1-4.3-3.5-10.2-5.3-17.7-5.3-12.5 0-26.9 4.7-44.1 14.5-16.7 9.4-35.4 25.4-55.4 47.5-1.6 1.7-1.7 4.3-.4 6.2 1.3 1.9 3.8 2.6 6 1.8 7-2.9 42.4-17.4 47.6-20.6 4.2-2.6 7.9-4 10.9-4 .1 0 .2 0 .3 0 0 .2.1.5.1.9 0 3-.6 6.7-1.9 10.7-30.1 97.6-44.8 157.5-44.8 183 0 9 2.5 16.2 7.4 21.5 5 5.4 11.8 8.1 20.1 8.1 8.9 0 19.7-3.7 33.1-11.4 12.9-7.4 32.7-23.7 60.4-49.7C324.3 372.2 324.6 369.5 323.2 367.5zM322.2 84.6c-4.9-5-11.2-7.6-18.7-7.6-9.3 0-17.5 3.7-24.2 11-6.6 7.2-9.9 15.9-9.9 26.1 0 8 2.5 14.7 7.3 19.8 4.9 5.2 11.1 7.8 18.5 7.8 9 0 17-3.9 24-11.6 6.9-7.6 10.4-16.4 10.4-26.4C329.6 96 327.1 89.6 322.2 84.6z">
                                        </path>
                                    </svg></sup>
                            </div>
                        </label>
                        <input type="number" min="0" step="any" name="paperWeight" id="paperWeight" class="form-control"
                            value="<?php if ((!empty($result['paperWeight']))) {
                                echo $result['paperWeight'];
                            } ?>" required readonly="readonly">
                        <div class="text-danger" id="paperWeightErr"></div>


                    </div>

                </div>


                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                            <label>Your vision for your interior design.<!--<span class="text-danger">*</span>-->
                               
                            </label>
                            <textarea class="form-control" name="visonInteriorDesign" id="visonInteriorDesign" rows="1" readonly="readonly"
                            data-toggle="tooltip" data-placement="top"
                                title="Complete this information as you wish to have it appear on Spine."><?php if ((!empty($result['visonInteriorDesign']))) {
                                    echo encodeValue($result['visonInteriorDesign']);
                                } ?></textarea>

                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                    <label>Do you have confirmed dimension specifications?<span class="text-danger">*</span>
                            <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                title="I have confirmed the above dimension specifications with my printer/publisher.">
                                <sup> <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18"
                                        viewBox="0 0 512 512">
                                        <path fill="#25B7D3"
                                            d="M504.1,256C504.1,119,393,7.9,256,7.9C119,7.9,7.9,119,7.9,256C7.9,393,119,504.1,256,504.1C393,504.1,504.1,393,504.1,256z">
                                        </path>
                                        <path fill="#FFF"
                                            d="M323.2 367.5c-1.4-2-4-2.8-6.3-1.7-24.6 11.6-52.5 23.9-58 25-.1-.1-.4-.3-.6-.7-.7-1-1.1-2.3-1.1-4 0-13.9 10.5-56.2 31.2-125.7 17.5-58.4 19.5-70.5 19.5-74.5 0-6.2-2.4-11.4-6.9-15.1-4.3-3.5-10.2-5.3-17.7-5.3-12.5 0-26.9 4.7-44.1 14.5-16.7 9.4-35.4 25.4-55.4 47.5-1.6 1.7-1.7 4.3-.4 6.2 1.3 1.9 3.8 2.6 6 1.8 7-2.9 42.4-17.4 47.6-20.6 4.2-2.6 7.9-4 10.9-4 .1 0 .2 0 .3 0 0 .2.1.5.1.9 0 3-.6 6.7-1.9 10.7-30.1 97.6-44.8 157.5-44.8 183 0 9 2.5 16.2 7.4 21.5 5 5.4 11.8 8.1 20.1 8.1 8.9 0 19.7-3.7 33.1-11.4 12.9-7.4 32.7-23.7 60.4-49.7C324.3 372.2 324.6 369.5 323.2 367.5zM322.2 84.6c-4.9-5-11.2-7.6-18.7-7.6-9.3 0-17.5 3.7-24.2 11-6.6 7.2-9.9 15.9-9.9 26.1 0 8 2.5 14.7 7.3 19.8 4.9 5.2 11.1 7.8 18.5 7.8 9 0 17-3.9 24-11.6 6.9-7.6 10.4-16.4 10.4-26.4C329.6 96 327.1 89.6 322.2 84.6z">
                                        </path>
                                    </svg></sup>
                            </div>
                        </label>
                        <input type="text" class="form-control" name="dimenSpecification" id="dimenSpecification" value="<?php if ((!empty($result['dimenSpecification']))) {
                            echo encodeValue($result['dimenSpecification']);
                        } ?>" readonly="readonly">

                        <div class="text-danger" id="dimenSpecificationErr"></div>

                    </div>

                </div>
                
                
                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        
                        <label>Do you have content for front cover?

                            <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                title="Appears on the front cover of the book.">
                                <sup> <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18"
                                        viewBox="0 0 512 512">
                                        <path fill="#25B7D3"
                                            d="M504.1,256C504.1,119,393,7.9,256,7.9C119,7.9,7.9,119,7.9,256C7.9,393,119,504.1,256,504.1C393,504.1,504.1,393,504.1,256z">
                                        </path>
                                        <path fill="#FFF"
                                            d="M323.2 367.5c-1.4-2-4-2.8-6.3-1.7-24.6 11.6-52.5 23.9-58 25-.1-.1-.4-.3-.6-.7-.7-1-1.1-2.3-1.1-4 0-13.9 10.5-56.2 31.2-125.7 17.5-58.4 19.5-70.5 19.5-74.5 0-6.2-2.4-11.4-6.9-15.1-4.3-3.5-10.2-5.3-17.7-5.3-12.5 0-26.9 4.7-44.1 14.5-16.7 9.4-35.4 25.4-55.4 47.5-1.6 1.7-1.7 4.3-.4 6.2 1.3 1.9 3.8 2.6 6 1.8 7-2.9 42.4-17.4 47.6-20.6 4.2-2.6 7.9-4 10.9-4 .1 0 .2 0 .3 0 0 .2.1.5.1.9 0 3-.6 6.7-1.9 10.7-30.1 97.6-44.8 157.5-44.8 183 0 9 2.5 16.2 7.4 21.5 5 5.4 11.8 8.1 20.1 8.1 8.9 0 19.7-3.7 33.1-11.4 12.9-7.4 32.7-23.7 60.4-49.7C324.3 372.2 324.6 369.5 323.2 367.5zM322.2 84.6c-4.9-5-11.2-7.6-18.7-7.6-9.3 0-17.5 3.7-24.2 11-6.6 7.2-9.9 15.9-9.9 26.1 0 8 2.5 14.7 7.3 19.8 4.9 5.2 11.1 7.8 18.5 7.8 9 0 17-3.9 24-11.6 6.9-7.6 10.4-16.4 10.4-26.4C329.6 96 327.1 89.6 322.2 84.6z">
                                        </path>
                                    </svg></sup>
                            </div>
                        </label>

                        <textarea class="form-control" id="cfrontText" name="cfrontText" rows="3" value="<?php if ((!empty($result['bookCoverFront']))) {
                            echo encodeValue($result['bookCoverFront']);
                        } ?>" readonly="readonly" data-toggle="tooltip" data-placement="top"
                            title="Complete this information as you wish to have it appear on Book cover-front."><?php if ((!empty($result['bookCoverFront']))) {
                                echo encodeValue($result['bookCoverFront']);
                            } ?></textarea>


                        <br>
                        <label>Do you have content for back cover?
                            <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                title="Appears on the back cover of the book.">
                                <sup> <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18"
                                        viewBox="0 0 512 512">
                                        <path fill="#25B7D3"
                                            d="M504.1,256C504.1,119,393,7.9,256,7.9C119,7.9,7.9,119,7.9,256C7.9,393,119,504.1,256,504.1C393,504.1,504.1,393,504.1,256z">
                                        </path>
                                        <path fill="#FFF"
                                            d="M323.2 367.5c-1.4-2-4-2.8-6.3-1.7-24.6 11.6-52.5 23.9-58 25-.1-.1-.4-.3-.6-.7-.7-1-1.1-2.3-1.1-4 0-13.9 10.5-56.2 31.2-125.7 17.5-58.4 19.5-70.5 19.5-74.5 0-6.2-2.4-11.4-6.9-15.1-4.3-3.5-10.2-5.3-17.7-5.3-12.5 0-26.9 4.7-44.1 14.5-16.7 9.4-35.4 25.4-55.4 47.5-1.6 1.7-1.7 4.3-.4 6.2 1.3 1.9 3.8 2.6 6 1.8 7-2.9 42.4-17.4 47.6-20.6 4.2-2.6 7.9-4 10.9-4 .1 0 .2 0 .3 0 0 .2.1.5.1.9 0 3-.6 6.7-1.9 10.7-30.1 97.6-44.8 157.5-44.8 183 0 9 2.5 16.2 7.4 21.5 5 5.4 11.8 8.1 20.1 8.1 8.9 0 19.7-3.7 33.1-11.4 12.9-7.4 32.7-23.7 60.4-49.7C324.3 372.2 324.6 369.5 323.2 367.5zM322.2 84.6c-4.9-5-11.2-7.6-18.7-7.6-9.3 0-17.5 3.7-24.2 11-6.6 7.2-9.9 15.9-9.9 26.1 0 8 2.5 14.7 7.3 19.8 4.9 5.2 11.1 7.8 18.5 7.8 9 0 17-3.9 24-11.6 6.9-7.6 10.4-16.4 10.4-26.4C329.6 96 327.1 89.6 322.2 84.6z">
                                        </path>
                                    </svg></sup>
                            </div>
                        </label>


                        <textarea class="form-control" id="cbackText" name="cbackText" rows="3" value="<?php if ((!empty($result['bookCoverBack']))) {
                            echo encodeValue($result['bookCoverBack']);
                        } ?>" readonly="readonly" data-toggle="tooltip" data-placement="top"
                            title="Complete this information as you wish to have it appear on Book cover-front."><?php if ((!empty($result['bookCoverBack']))) {
                                echo encodeValue($result['bookCoverBack']);
                            } ?></textarea>


                        <br>

                        <label>Do you have content for spine?
                            <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                title=" Appears on the spine of the book.">
                                <sup> <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18"
                                        viewBox="0 0 512 512">
                                        <path fill="#25B7D3"
                                            d="M504.1,256C504.1,119,393,7.9,256,7.9C119,7.9,7.9,119,7.9,256C7.9,393,119,504.1,256,504.1C393,504.1,504.1,393,504.1,256z">
                                        </path>
                                        <path fill="#FFF"
                                            d="M323.2 367.5c-1.4-2-4-2.8-6.3-1.7-24.6 11.6-52.5 23.9-58 25-.1-.1-.4-.3-.6-.7-.7-1-1.1-2.3-1.1-4 0-13.9 10.5-56.2 31.2-125.7 17.5-58.4 19.5-70.5 19.5-74.5 0-6.2-2.4-11.4-6.9-15.1-4.3-3.5-10.2-5.3-17.7-5.3-12.5 0-26.9 4.7-44.1 14.5-16.7 9.4-35.4 25.4-55.4 47.5-1.6 1.7-1.7 4.3-.4 6.2 1.3 1.9 3.8 2.6 6 1.8 7-2.9 42.4-17.4 47.6-20.6 4.2-2.6 7.9-4 10.9-4 .1 0 .2 0 .3 0 0 .2.1.5.1.9 0 3-.6 6.7-1.9 10.7-30.1 97.6-44.8 157.5-44.8 183 0 9 2.5 16.2 7.4 21.5 5 5.4 11.8 8.1 20.1 8.1 8.9 0 19.7-3.7 33.1-11.4 12.9-7.4 32.7-23.7 60.4-49.7C324.3 372.2 324.6 369.5 323.2 367.5zM322.2 84.6c-4.9-5-11.2-7.6-18.7-7.6-9.3 0-17.5 3.7-24.2 11-6.6 7.2-9.9 15.9-9.9 26.1 0 8 2.5 14.7 7.3 19.8 4.9 5.2 11.1 7.8 18.5 7.8 9 0 17-3.9 24-11.6 6.9-7.6 10.4-16.4 10.4-26.4C329.6 96 327.1 89.6 322.2 84.6z">
                                        </path>
                                    </svg></sup>
                            </div>
                        </label>

                        <textarea class="form-control" id="spineText" name="spineText" rows="3" readonly="readonly"
                            data-toggle="tooltip" data-placement="top"
                            title="Complete this information as you wish to have it appear on Spine."><?php if ((!empty($result['spine']))) {
                                echo encodeValue($result['spine']);
                            } ?></textarea>

                    </div>


                    <div class="col-md-6 mt-md-0 mt-3">


                        <label>Author Selected Template<!--<span class="text-danger">* </span>-->
                            <input type="text" id="coverImageId" name="coverImageId" class="text-primary" <?php if ((!empty($result['template_id']))) {
                                echo 'style="display:inline;font-weight: bold;  border:none;" readonly="readonly"';
                            } else {
                                echo 'style="display:none;font-weight: bold;  border:none;" readonly="readonly"';
                            } ?> value="<?php if ((!empty($result['template_id']))) {
                                  echo $result['template_id'];
                              } ?>">
                            </input>
                        </label>
                        <!--<div class="text-danger" id="coverImageIdErr"></div>-->

                        <div class="border" <?php if ((!empty($result['template_id']))) {
                            echo 'style="display:block;"';
                        } else {
                            echo 'style="display:none;"';
                        } ?>>

                            <div class="row" id="result">
                                <?php
                                $coverId = trim($result['template_id']);
                                //echo $coverId;
                                $sql2 = "select * from covers where cover_id='$coverId'";
                                //echo $sql2;
                                //$sql = "SELECT * FROM covers where cover_id='$cover_id'";
                                $fetch_data1 = mysqli_query($conn, $sql2);

                                $result2 = mysqli_fetch_array($fetch_data1);
                                ?>
                                <img src="images/<?php if ((!empty($result2['cover_image']))) {
                                    echo $result2['cover_image'];
                                } ?>" alt="<?php if ((!empty($result2['cover_image']))) {
                                     echo $result2['cover_image'];
                                 } ?>" />

                            </div>
                        </div>
                        <div class="border" <?php if ((!empty($result['template_id']))) {
                            echo 'style="display:none;"';
                        } else {
                            echo 'style="display:block;"';
                        } ?>>

                            <div class="row" id="result">
                                <img src="images/empty_000.jpg" alt="No template selected" />

                            </div>
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-6 mt-md-0 mt-3">
                            <label>Author image provided with manuscript?<span class="text-danger">*</span>
                                <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                    title="Author photo for the book cover.">
                                    <sup> <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18"
                                            viewBox="0 0 512 512">
                                            <path fill="#25B7D3"
                                                d="M504.1,256C504.1,119,393,7.9,256,7.9C119,7.9,7.9,119,7.9,256C7.9,393,119,504.1,256,504.1C393,504.1,504.1,393,504.1,256z">
                                            </path>
                                            <path fill="#FFF"
                                                d="M323.2 367.5c-1.4-2-4-2.8-6.3-1.7-24.6 11.6-52.5 23.9-58 25-.1-.1-.4-.3-.6-.7-.7-1-1.1-2.3-1.1-4 0-13.9 10.5-56.2 31.2-125.7 17.5-58.4 19.5-70.5 19.5-74.5 0-6.2-2.4-11.4-6.9-15.1-4.3-3.5-10.2-5.3-17.7-5.3-12.5 0-26.9 4.7-44.1 14.5-16.7 9.4-35.4 25.4-55.4 47.5-1.6 1.7-1.7 4.3-.4 6.2 1.3 1.9 3.8 2.6 6 1.8 7-2.9 42.4-17.4 47.6-20.6 4.2-2.6 7.9-4 10.9-4 .1 0 .2 0 .3 0 0 .2.1.5.1.9 0 3-.6 6.7-1.9 10.7-30.1 97.6-44.8 157.5-44.8 183 0 9 2.5 16.2 7.4 21.5 5 5.4 11.8 8.1 20.1 8.1 8.9 0 19.7-3.7 33.1-11.4 12.9-7.4 32.7-23.7 60.4-49.7C324.3 372.2 324.6 369.5 323.2 367.5zM322.2 84.6c-4.9-5-11.2-7.6-18.7-7.6-9.3 0-17.5 3.7-24.2 11-6.6 7.2-9.9 15.9-9.9 26.1 0 8 2.5 14.7 7.3 19.8 4.9 5.2 11.1 7.8 18.5 7.8 9 0 17-3.9 24-11.6 6.9-7.6 10.4-16.4 10.4-26.4C329.6 96 327.1 89.6 322.2 84.6z">
                                            </path>
                                        </svg></sup>
                                </div>
                            </label>

                            <input type="text" class="form-control" name="authorImage" id="authorImage" value="<?php if ((!empty($result['authorImage']))) {
                                echo $result['authorImage'];
                            } ?>" readonly="readonly">

                            <div class="text-danger" id="authorImageErr"></div>

                        </div>
                        <div class="col-md-6 mt-md-0 mt-3">
                            <label>Cover image provided with manuscript?<span class="text-danger">*</span>
                                <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                    title="Do you have original art for the cover? (If you have original art which you intend to use as part of your cover design, you may do so. Make sure you have permission to reprint the art, and credit the artist by listing their name with copyright. Resolution of original image should be 300 dpi or more.)">
                                    <sup> <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="18" height="18"
                                            viewBox="0 0 512 512">
                                            <path fill="#25B7D3"
                                                d="M504.1,256C504.1,119,393,7.9,256,7.9C119,7.9,7.9,119,7.9,256C7.9,393,119,504.1,256,504.1C393,504.1,504.1,393,504.1,256z">
                                            </path>
                                            <path fill="#FFF"
                                                d="M323.2 367.5c-1.4-2-4-2.8-6.3-1.7-24.6 11.6-52.5 23.9-58 25-.1-.1-.4-.3-.6-.7-.7-1-1.1-2.3-1.1-4 0-13.9 10.5-56.2 31.2-125.7 17.5-58.4 19.5-70.5 19.5-74.5 0-6.2-2.4-11.4-6.9-15.1-4.3-3.5-10.2-5.3-17.7-5.3-12.5 0-26.9 4.7-44.1 14.5-16.7 9.4-35.4 25.4-55.4 47.5-1.6 1.7-1.7 4.3-.4 6.2 1.3 1.9 3.8 2.6 6 1.8 7-2.9 42.4-17.4 47.6-20.6 4.2-2.6 7.9-4 10.9-4 .1 0 .2 0 .3 0 0 .2.1.5.1.9 0 3-.6 6.7-1.9 10.7-30.1 97.6-44.8 157.5-44.8 183 0 9 2.5 16.2 7.4 21.5 5 5.4 11.8 8.1 20.1 8.1 8.9 0 19.7-3.7 33.1-11.4 12.9-7.4 32.7-23.7 60.4-49.7C324.3 372.2 324.6 369.5 323.2 367.5zM322.2 84.6c-4.9-5-11.2-7.6-18.7-7.6-9.3 0-17.5 3.7-24.2 11-6.6 7.2-9.9 15.9-9.9 26.1 0 8 2.5 14.7 7.3 19.8 4.9 5.2 11.1 7.8 18.5 7.8 9 0 17-3.9 24-11.6 6.9-7.6 10.4-16.4 10.4-26.4C329.6 96 327.1 89.6 322.2 84.6z">
                                            </path>
                                        </svg></sup>
                                </div>
                            </label>
                            <input type="text" class="form-control" name="artImage" id="artImage" value="<?php if ((!empty($result['artImage']))) {
                                echo $result['artImage'];
                            } ?>" readonly="readonly">

                            <div class="text-danger" id="artImageErr"></div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-md-0 mt-3">
                            <label>Your vision for your design.<!--<span class="text-danger">*</span>-->
                                <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                    title="The more information you provide, the better able we are to provide you with a cover projecting the image you wish to portray. And in the end, this will save you money. If we have a better idea what you want up front, we won't need to make changes later.">
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
                            <textarea class="form-control" name="visionDesign" id="visionDesign" rows="5" <?php if ((!empty($result['visionDesign']))) {
                                echo 'readonly="readonly"';
                            } ?>   data-toggle="tooltip" data-placement="top"
                                title="Complete this information as you wish to have it appear on Spine."><?php if ((!empty($result['visionDesign']))) {
                                    echo encodeValue($result['visionDesign']);
                                } ?></textarea>
                            <!--<div class="text-danger" id="visionDesignErr"></div>-->

                        </div>
                        <div class="col-md-6 mt-md-0 mt-3">

                            <div <?php if ((!empty($result['fileName']))) {
                                echo 'style="display:none;"';
                            } else {
                                echo 'style="display:block;"';
                            } ?>>
                                <label>Upload your manuscript and other files?<span class="text-danger">*</span>
                                <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                    title="You can upload your files as either one zip file and multiple files.">
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
                                    <div style="display:inline;" class="text-danger" id="fileErr"></div>
                                </label>
                                <div class="text-center">
                                    <label class="form-control upload_label">
                                        <input type="file" class="form-control upload_hide" id="fileUpload"
                                            name="myfile[]" multiple required>


                                        <span><i class="fa fa-cloud-upload text-centre text-primary fa-5x"></i></span>
                                        <p class="text-centre text-primary" id="noOfFiles">Drag & Drop to Upload File
                                        </p>

                                    </label>

                                </div>

                            </div>
                            <div <?php if ((!empty($result['fileName']))) {
                                echo 'style="display:block;"';
                            } else {
                                echo 'style="display:none;"';
                            } ?>>
                                <label> Download Manuscript File<span class="text-danger">*</span></label>
                                <div class="text-center">
                                    <label class="form-control upload_label">
                                        <a download="<?php echo $result['fileName']; ?>"
                                            href="uploads/<?php echo $result['fileName'] ?>"><span><i
                                                    class="fa fa-cloud-download text-centre text-primary fa-5x"></i></span>
                                            <p class="text-centre text-primary" id="noOfFiles">Download Manuscript
                                                file
                                            </p>
                                        </a>

                                    </label>

                                </div>

                            </div>


                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12 mt-md-0 mt-3 text-center">
                            <button type="submit" class="btn btn-primary btn-lg" name="save" <?php if (($result['submitCount'])) {
                                echo 'disabled="disabled"';
                            } ?>>Export to Excel</button>
                        </div>
                    </div>
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