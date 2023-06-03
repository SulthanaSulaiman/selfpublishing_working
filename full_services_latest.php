<?php
require 'config.php';
require 'connection.php';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Services</title>

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
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $id = encryptor('decrypt', $id);
        echo $id;
        $eid = encryptor('encrypt', $id);
        try {
            if (!empty($id)) {
                $fetch_data = mysqli_query($conn, "select * from services where id='$id'");
                $result = mysqli_fetch_array($fetch_data);
                $submit = 1;
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
                <h3 class="text-center p-2 " style="color:white; margin-top: 10px;">FULL SERVICES</h3>
            </div>

        </div>


        <div class="wrapper rounded bg-white">

            <form name="authorForm" onsubmit="return validateForm()"
                action="http://10.1.6.32/selfpublishing/productionMailer.php?id=<?php echo $eid;?>" method="post"
                enctype="multipart/form-data" class="form" novalidate>
                

                <div class="row">

                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Author Name</label>
                        <input type="text" class="form-control required" value="<?php if ((!empty($result['authorName']))) {
                            echo $result['authorName'];
                        } ?>" name="authorName" id="authorName" required readonly="readonly">

                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Email</label>
                        <input type="text" class="form-control required" value="<?php if ((!empty($result['authorEmail']))) {
                            echo $result['authorEmail'];
                        } ?>" name="authorEmail" id="authorEmail" required readonly="readonly">

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Book Title</label>
                        <input type="text" class="form-control required" value="<?php if ((!empty($result['bookTitle']))) {
                            echo $result['bookTitle'];
                        } ?>" name="bookTitle" id="bookTitle" required readonly="readonly">

                    </div>

                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Book Subtitle</label>
                        <input type="text" class="form-control" name="bookSubTitle" id="bookSubTitle" value="<?php if ((!empty($result['bookSubtitle']))) {
                            echo $result['bookSubtitle'];
                        } ?>" <?php if ((!empty($result['bookSubtitle']))) {
                             echo 'readonly="readonly"';
                         } ?>>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Interior Design</label>
                        <input type="text" class="form-control" name="interiorDesign" id="interiorDesign" value="<?php if ((!empty($result['interiorDesign']))) {
                            echo $result['interiorDesign'];
                        } ?>" required readonly="readonly">
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Editorial Complexity</label>
                        <input type="text" class="form-control" name="editorialCompexity" id="editorialCompexity" value="<?php if ((!empty($result['editorialComplexity']))) {
                            echo $result['editorialComplexity'];
                        } ?>" required readonly="readonly">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Number of Manuscript Pages</label>
                        <input type="text" class="form-control" name="numberOfMenuscriptPages"
                            id="numberOfMenuscriptPages" value="<?php if ((!empty($result['nuberOfMenuscriptPages']))) {
                                echo $result['nuberOfMenuscriptPages'];
                            } ?>" required readonly="readonly">
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>ISBN</label>
                        <input type="text" class="form-control" name="isbn" id="isbn" value="<?php if ((!empty($result['isbn']))) {
                            echo $result['isbn'];
                        } ?>" <?php if ((!empty($result['isbn']))) {
                             echo 'readonly="readonly"';
                         } ?>>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        
                        <label>Cover Type<span class="text-danger">*</span></label>

                        <select class="form-control" name="coverType" id="coverType" required <?php if ((!empty($result['coverType']))) {
                            echo 'readonly="readonly"';
                        } ?>>
                            <option value="Choose...">Choose...</option>
                            <option value="Paperback" <?php if (($result['coverType'] != "Choose...") && ($result['coverType'] == "Paperback")) {
                                echo "selected";
                            } ?>>
                                Paperback</option>
                            <option value="Hardcover" <?php if (($result['coverType'] != "Choose...") && ($result['coverType'] == "Hardcover")) {
                                echo "selected";
                            } ?>>
                                Hardcover</option>
                        </select>
                        <div class="text-danger" id="coverTypeErr"></div>
                    </div>
                    
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Price to Create Barcode <span class="text-danger">*</span></label>
                        <input type="text" name="priceBarcode" class="form-control" value="<?php if ((!empty($result['priceBarcode']))) {
                            echo $result['priceBarcode'];
                        } ?>" required <?php if ((!empty($result['priceBarcode']))) {
                             echo 'readonly="readonly"';
                         } ?>>
                        <div class="text-danger" id="priceBarcodeErr"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Trim Size <span class="text-danger">*</span></label>

                        <div class="align-items-center">
                            <label class="option ">
                                <input type="radio" name="trimSize" value='Trade Novels 5" x 8"' <?php if ((!empty($result['trimSize'])) && ($result['trimSize'] == 'Trade Novels 5" x 8"')) {
                                    echo "checked";
                                } ?>>Trade Novels 5" x
                                8"
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ">
                                <input type="radio" name="trimSize" value='Trade Novels 6" x 9"' <?php if ((!empty($result['trimSize'])) && ($result['trimSize'] == 'Trade Novels 6" x 9"')) {
                                    echo "checked";
                                } ?>>Trade Novels 6" x
                                9"
                                <span class="checkmark"></span>
                            </label>

                            <label class="option ">
                                <input type="radio" name="trimSize" value='Mass Market Paperback 4.25" x 6.87"' <?php if ((!empty($result['trimSize'])) && ($result['trimSize'] == 'Mass Market Paperback 4.25" x 6.87"')) {
                                    echo "checked";
                                } ?>>Mass
                                Market
                                Paperback 4.25" x 6.87"
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ">
                                <input type="radio" name="trimSize" value='Text Book 6" x 9"' <?php if ((!empty($result['trimSize'])) && ($result['trimSize'] == 'Text Book 6" x 9"')) {
                                    echo "checked";
                                } ?>>Text Book 6" x 9"
                                <span class="checkmark"></span>
                            </label>

                            <label class="option">
                                <input type="radio" name="trimSize" value='Text Book 8.5" x 11"' <?php if ((!empty($result['trimSize'])) && ($result['trimSize'] == 'Text Book 8.5" x 11"')) {
                                    echo "checked";
                                } ?>>Text Book 8.5" x
                                11"
                                <span class="checkmark"></span>
                            </label>
                            <label class="option">
                                <input type="radio" name="trimSize" value='Comic Book 6.625" x 10.25"' <?php if ((!empty($result['trimSize'])) && ($result['trimSize'] == 'Comic Book 6.625" x 10.25"')) {
                                    echo "checked";
                                } ?>>Comic Book 6.625"
                                x
                                10.25"
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="text-danger" id="trimSizeErr"></div>

                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Paper Weignt<span class="text-danger">*</span>
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
                        <input type="number" name="paperWeight" id="paperWeight" class="form-control" value="<?php if ((!empty($result['paperWeight']))) {
                            echo $result['paperWeight'];
                        } ?>" required <?php if ((!empty($result['paperWeight']))) {
                             echo 'readonly="readonly"';
                         } ?>>
                        <div class="text-danger" id="paperWeightErr"></div>
                        <br>
                       
                        <label>Requested Services<span class="text-danger">*</span></label>
                        <div class=" align-items-center mt-2">
                            <label class="option1"><input type="checkbox"  name="requestedServices[]"
                                    value="Copyediting" <?php if ((!empty($result['requestedServices']))) {
                             echo in_array('Copyediting',(explode(',', $result['requestedServices'])))?'checked="checked"':'';}?> >Copyediting<span class="checkmark"></span></label>
                            <label class="option1"><input type="checkbox" name="requestedServices[]"
                                    value="Indexing" <?php if ((!empty($result['requestedServices']))) {
                             echo in_array('Indexing',(explode(',', $result['requestedServices'])))?'checked="checked"':'';}?>>Indexing<span class="checkmark"></span></label>
                        </div>
                        <div class="text-danger" id="servicesErr"></div>
                    </div>

                </div>


                <div class="row">

                    <div div class="col-md-6 mt-md-0 mt-3">

                        <label>Book Cover-Front Content?

                            <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                title="Do you have information you'd like to appear on Book cover - front?">
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
                        <div class="d-flex align-items-center mt-2">
                            <label class="option">
                                <input type="radio" name="cfrontOption" <?php if ((!empty($result['bookCoverFront']))) {
                                    echo "checked";
                                } ?> onclick="Show_cfrontText(1)">Yes
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ms-4">
                                <input type="radio" name="cfrontOption" onclick="Show_cfrontText(0)" <?php if ((empty($result['bookCoverFront']))) {
                                    echo "checked";
                                } ?>>No
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <textarea class="form-control" id="cfrontText" name="cfrontText" rows="1" value="<?php if ((!empty($result['bookCoverFront']))) {
                            echo $result['bookCoverFront'];
                        } ?>" <?php if ((empty($result['bookCoverFront']))) {
                             echo 'style="display:none;"';
                         } ?> <?php if ((!empty($result['bookCoverFront']))) {
                               echo 'readonly="readonly';
                           } ?>   data-toggle="tooltip" data-placement="top"
                            title="Complete this information as you wish to have it appear on Book cover-front."><?php if ((!empty($result['bookCoverFront']))) {
                                echo $result['bookCoverFront'];
                            } ?></textarea>


                        <br>
                        <label>Book Cover-Back Content?
                            <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                title="Do you have information you'd like to appear on Book cover - back?">
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
                        <div class="d-flex align-items-center mt-2">
                            <label class="option">
                                <input type="radio" name="cbackOption" <?php if ((!empty($result['bookCoverBack']))) {
                                    echo "checked";
                                } ?> onclick="Show_cbackText(1)">Yes
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ms-4">
                                <input type="radio" name="cbackOption" onclick="Show_cbackText(0)" <?php if ((empty($result['bookCoverBack']))) {
                                    echo "checked";
                                } ?>>No
                                <span class="checkmark"></span>
                            </label>
                        </div>

                        <textarea class="form-control" id="cbackText" name="cbackText" rows="1" value="<?php if ((!empty($result['bookCoverBack']))) {
                            echo $result['bookCoverBack'];
                        } ?>" <?php if ((empty($result['bookCoverBack']))) {
                             echo 'style="display:none;"';
                         } ?> <?php if ((!empty($result['bookCoverBack']))) {
                               echo 'readonly="readonly';
                           } ?>   data-toggle="tooltip" data-placement="top"
                            title="Complete this information as you wish to have it appear on Book cover-front."><?php if ((!empty($result['bookCoverBack']))) {
                                echo $result['bookCoverBack'];
                            } ?></textarea>


                        <br>

                        <label>Spine Content?
                            <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                title="Do you have information you'd like to appear on Spine?">
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
                        <div class="d-flex align-items-center mt-2">
                            <label class="option">
                                <input type="radio" name="spine" <?php if ((!empty($result['spine']))) {
                                    echo "checked";
                                } ?> onclick="Show_spineText(1)">Yes
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ms-4">
                                <input type="radio" name="spine" onclick="Show_spineText(0)" <?php if ((empty($result['spine']))) {
                                    echo "checked";
                                } ?>>No
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <textarea class="form-control" id="spineText" name="spineText" rows="1" <?php if ((empty($result['spine']))) {
                            echo 'style="display:none;"';
                        } ?>  <?php if ((!empty($result['spine']))) {
                               echo 'readonly="readonly';
                           } ?> data-toggle="tooltip"
                            data-placement="top"
                            title="Complete this information as you wish to have it appear on Spine."><?php if ((!empty($result['spine']))) {
                                echo $result['spine'];
                            } ?></textarea>

                        <br>

                        <label>Author Image? <span class="text-danger">*</span>
                            <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                title="Will you be supplying an author photo for the cover?">
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
                        <div class="d-flex align-items-center mt-2">
                            <label class="option">
                                <input type="radio" name="authorImage" <?php if ((!empty($result['authorImage'])) && ($result['authorImage'] == "Yes")) {
                                    echo "checked";
                                } ?> value="Yes">Yes
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ms-4">
                                <input type="radio" name="authorImage" <?php if ((!empty($result['authorImage'])) && ($result['authorImage'] == "No")) {
                                    echo "checked";
                                } ?> value="No">No
                                <span class="checkmark"></span>
                            </label>

                        </div>
                        <div class="text-danger" id="authorImageErr"></div>
                        <br>
                        <label>Art Image <span class="text-danger">*</span>
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
                        <div class="d-flex align-items-center mt-2">
                            <label class="option">
                                <input type="radio" name="artImage" <?php if ((!empty($result['artImage'])) && ($result['artImage'] == "Yes")) {
                                    echo "checked";
                                } ?> value="Yes">Yes
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ms-4">
                                <input type="radio" name="artImage" <?php if ((!empty($result['artImage'])) && ($result['artImage'] == "No")) {
                                    echo "checked";
                                } ?> value="No">No
                                <span class="checkmark"></span>
                            </label>
                            <div class="text-danger" id="artrImageErr"></div>
                        </div>
                        <div class="text-danger" id="artImageErr"></div>

                    </div>


                    <div class="col-md-6 mt-md-0 mt-3">

                        <label>Confirmed Dimension Specifications?<span class="text-danger">*</span>
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
                        <div class="d-flex align-items-center mt-2">
                            <label class="option">
                                <input type="radio" name="dimenSpecification" <?php if ((!empty($result['dimenSpecification']))) {
                                    echo "checked";
                                } ?> value="Yes">Yes
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ms-4">
                                <input type="radio" name="dimenSpecification" value="No">No
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="text-danger" id="dimenSpecificationErr"></div>
                        <br>
 

                        <label>Please see sample templates below and pick a template that best suits your book.
                            <input type="text"
                                id="coverImageId" name="coverImageId" class="text-primary"
                                style="display:none;font-weight: bold;"></input></label>

                        <div class="col-lg-12 border p-2">
                            <div class="row" id="result">
                                <?php
                                $sql = "SELECT * FROM covers";
                                $result1 = $conn->query($sql);
                                while ($row = $result1->fetch_assoc()) {
                                    ?>
                                    <div class="col-md-3 mb-2" id="<?= $row['cover_id']; ?>"
                                        value="<?= $row['cover_id']; ?>">

                                        <button type="button" id="<?= $row['cover_id']; ?>"
                                            onclick="show_coverId('<?= $row['cover_id']; ?>')"
                                            value="<?= $row['cover_id']; ?>">
                                            <img class="card-img-top" src="images/<?= $row['cover_image']; ?>"
                                                alt="<?= $row['cover_image']; ?>" />
                                        </button>

                                    </div>

                                <?php } ?>
                            </div>
                        </div>

                    </div>

                </div> 
                                
                <div class="row">
                        <div class="col-md-6 mt-md-0 mt-3">
                            <label>Your vision for your Design <span class="text-danger">*</span>
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
                            } ?> data-toggle="tooltip" data-placement="top"
                                title="Complete this information as you wish to have it appear on Spine."><?php if ((!empty($result['visionDesign']))) {
                                    echo $result['visionDesign'];
                                } ?></textarea>
                            <div class="text-danger" id="visionDesignErr"></div>

                        </div>
                        <div class="col-md-6 mt-md-0 mt-3">

                            <div>
                                <label> Upload Manuscript File(s) <div class="text-danger" id="fileErr"></div> </label>
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


                        </div>

                </div>
             
                
                <div class="row">
                        <div class="col-md-12 mt-md-0 mt-3 text-center">
                            <button type="submit" class="btn btn-primary btn-lg" name="save">Submit</button>
                        </div>
                </div>
            </form>
        </div>
    </div>


    <script src="style/script.js"></script>
    <div class="footer-copyright text-center py-3"><span class="text-white">©
            <script>
                document.write((new Date().getFullYear()).toString());
            </script> Copyright: <a style="color:white" href="https://www.s4carlisle.com/">S4Carlisle Publishing
                Services Pvt.
                Ltd.
            </a>
        </span>
    </div>
</body>

</html>