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
    <script src="style/script.js"></script>
</head>

<body>
    <?php
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $proj_id = encryptor('decrypt', $id);
        echo $proj_id;
        $eid = encryptor('encrypt', $id);
        try {
            if (!empty($proj_id)) {
                $fetch_data = mysqli_query($conn, "select * from services where id='$proj_id'");
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
        <h3 class="text-center p-2 " style="color:white; margin-top: 10px;">FULL SERVICES</h3>
      </div>

    </div>
    

        <div class="wrapper rounded bg-white">

            <form name="authorForm" onsubmit="return validateForm()"
                action=" "
                method="post" enctype="multipart/form-data" class="form" novalidate>
                <!-- <div style="text-align:right;"><span class="text-danger">*Required fields</span></div>-->
                <div class="row">

                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Author Name</label>
                        <input type="text" class="form-control required" value="<?php if ((!empty($result['authorName']))) {
                            echo $result['authorName'];
                        } ?>" name="authorName" required disabled>

                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Email</label>
                        <input type="text" class="form-control required" value="<?php if ((!empty($result['authorEmail']))) {
                            echo $result['authorEmail'];
                        } ?>" name="authorMail" required disabled>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Book Title</label>
                        <input type="text" class="form-control required" value="<?php if ((!empty($result['bookTitle']))) {
                            echo $result['bookTitle'];
                        } ?>" name="bookTitle" required disabled>

                    </div>

                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Book Subtitle</label>
                        <input type="text" class="form-control" name="bookSubTitle" value="<?php if ((!empty($result['bookSubTitle']))) {
                            echo $result['bookSubTitle'];
                        } ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Interior Design</label>
                        <input type="text" class="form-control" name="interiorDesign" value="<?php if ((!empty($result['interiorDesign']))) {
                            echo $result['interiorDesign'];
                        } ?>" required disabled>
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Editorial Complexity</label>
                        <input type="text" class="form-control" name="editorialCompexity" value="<?php if ((!empty($result['editorialComplexity']))) {
                            echo $result['editorialComplexity'];
                        } ?>" required disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Number of Manuscript Pages</label>
                        <input type="text" class="form-control" name="numberOfMenuscriptPages" value="<?php if ((!empty($result['nuberOfMenuscriptPages']))) {
                            echo $result['nuberOfMenuscriptPages'];
                        } ?>" required disabled>
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>ISBN</label>
                        <input type="text" class="form-control" name="isbn" value="<?php if ((!empty($result['isbn']))) {
                            echo $result['isbn'];
                        } ?>">


                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Cover Type<span class="text-danger">*</span></label>

                        <select class="form-control" name="coverType" required>
                            <option value="Choose...">Choose...</option>
                            <option value="Paperback">Paperback</option>
                            <option value="Hardcover">Hardcover</option>
                        </select>
                        <div class="text-danger" id="coverTypeErr"></div>
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Price to Create Barcode <span class="text-danger">*</span></label>
                        <input type="text" name="priceBarcode" class="form-control" required>
                        <div class="text-danger" id="priceBarcodeErr"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Trim Size <span class="text-danger">*</span></label>

                        <div class="align-items-center">
                            <label class="option ">
                                <input type="radio" name="trimSize" value='Trade Novels 5" x 8"'>Trade Novels 5" x
                                8"
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ">
                                <input type="radio" name="trimSize" value='Trade Novels 6" x 9"'>Trade Novels 6" x
                                9"
                                <span class="checkmark"></span>
                            </label>

                            <label class="option ">
                                <input type="radio" name="trimSize" value='Mass Market Paperback 4.25" x 6.87"'>Mass
                                Market
                                Paperback 4.25" x 6.87"
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ">
                                <input type="radio" name="trimSize" value='Text Book 6" x 9"'>Text Book 6" x 9"
                                <span class="checkmark"></span>
                            </label>

                            <label class="option">
                                <input type="radio" name="trimSize" value='Text Book 8.5" x 11"'>Text Book 8.5" x
                                11"
                                <span class="checkmark"></span>
                            </label>
                            <label class="option">
                                <input type="radio" name="trimSize" value='Comic Book 6.625" x 10.25"'>Comic Book 6.625"
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
                                <svg xmlns="http://www.w3.org/2000/svg" color="#FFA500" width="18" height="18"
                                    fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                                    <path
                                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </div>
                        </label>
                        <input type="number" name="paperWeight" class="form-control" required>
                        <div class="text-danger" id="paperWeightErr"></div>
                        <br>

                        <label>Requested Services<span class="text-danger">*</span></label>
                        <div class=" align-items-center mt-2">
                            <label class="option1"><input type="checkbox" name="services[]"
                                    value="Copyediting">Copyediting<span class="checkmark"></span></label>
                            <label class="option1"><input type="checkbox" name="services[]"
                                    value="Indexing">Indexing<span class="checkmark"></span></label>
                        </div>
                        <div class="text-danger" id="servicesErr"></div>
                    </div>

                </div>


                <div class="row">

                    <div div class="col-md-6 mt-md-0 mt-3">

                        <label>Book Cover-Front Content?

                            <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                title="Do you have information you'd like to appear on Book cover - front?">
                                <svg xmlns="http://www.w3.org/2000/svg" color="#FFA500" width="18" height="18"
                                    fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                                    <path
                                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </div>
                        </label>
                        <div class="d-flex align-items-center mt-2">
                            <label class="option">
                                <input type="radio" name="cfrontOption" onclick="Show_cfrontText(1)">Yes
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ms-4">
                                <input type="radio" name="cfrontOption" onclick="Show_cfrontText(0)">No
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <textarea class="form-control" id="cfrontText" rows="1" style="display: none;"
                            data-toggle="tooltip" data-placement="top"
                            title="Complete this information as you wish to have it appear on Book cover-front."></textarea>


                        <br>
                        <label>Book Cover-Back Content?
                            <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                title="Do you have information you'd like to appear on Book cover - back?">
                                <svg xmlns="http://www.w3.org/2000/svg" color="#FFA500" width="18" height="18"
                                    fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                                    <path
                                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </div>
                        </label>
                        <div class="d-flex align-items-center mt-2">
                            <label class="option">
                                <input type="radio" name="radio" onclick="Show_cbackText(1)">Yes
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ms-4">
                                <input type="radio" name="radio" onclick="Show_cbackText(0)">No
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <textarea class="form-control" id="cbackText" rows="1" style="display: none;"
                            data-toggle="tooltip" data-placement="top"
                            title="Complete this information as you wish to have it appear on Book cover-back."></textarea>

                        <br>

                        <label>Spine Content?
                            <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                title="Do you have information you'd like to appear on Spine?">
                                <svg xmlns="http://www.w3.org/2000/svg" color="#FFA500" width="18" height="18"
                                    fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                                    <path
                                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </div>
                        </label>
                        <div class="d-flex align-items-center mt-2">
                            <label class="option">
                                <input type="radio" name="radio" onclick="Show_spineText(1)">Yes
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ms-4">
                                <input type="radio" name="radio" onclick="Show_spineText(0)">No
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <textarea class="form-control" id="spineText" rows="1" style="display: none;"
                            data-toggle="tooltip" data-placement="top"
                            title="Complete this information as you wish to have it appear on Spine."></textarea>

                        <br>

                        <label>Author Image? <span class="text-danger">*</span>
                            <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                title="Will you be supplying an author photo for the cover?">
                                <svg xmlns="http://www.w3.org/2000/svg" color="#FFA500" width="18" height="18"
                                    fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                                    <path
                                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </div>
                        </label>
                        <div class="d-flex align-items-center mt-2">
                            <label class="option">
                                <input type="radio" name="authorImage" value="Yes">Yes
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ms-4">
                                <input type="radio" name="authorImage" value="No">No
                                <span class="checkmark"></span>
                            </label>

                        </div>
                        <div class="text-danger" id="authorImageErr"></div>
                        <br>
                        <label>Art Image <span class="text-danger">*</span>
                            <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                title="Do you have original art for the cover? (If you have original art which you intend to use as part of your cover design, you may do so. Make sure you have permission to reprint the art, and credit the artist by listing their name with copyright. Resolution of original image should be 300 dpi or more.)">
                                <svg xmlns="http://www.w3.org/2000/svg" color="#FFA500" width="18" height="18"
                                    fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                                    <path
                                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </div>
                        </label>
                        <div class="d-flex align-items-center mt-2">
                            <label class="option">
                                <input type="radio" name="artImage" value="Yes">Yes
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ms-4">
                                <input type="radio" name="artImage" value="No">No
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
                                <svg xmlns="http://www.w3.org/2000/svg" color="#FFA500" width="18" height="18"
                                    fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                                    <path
                                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </div>
                        </label>
                        <div class="d-flex align-items-center mt-2">
                            <label class="option">
                                <input type="radio" name="dimentionSpecifications" value="Yes">Yes
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ms-4">
                                <input type="radio" name="dimentionSpecifications" value="No">No
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="text-danger" id="dimentionSpecificationsErr"></div>
                        <br>


                        <label>Please see sample templates below and pick a template that best suits your book.<p
                                id="coverImageId" style="display:none" class="text-primary"></p></label>

                        <div class="col-lg-12 border p-2">
                            <div class="row" id="result">
                                <?php
                                $sql = "SELECT * FROM covers";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
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



                    <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                    <label>Your vision for your Design <span class="text-danger">*</span>
                                <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                    title="The more information you provide, the better able we are to provide you with a cover projecting the image you wish to portray. And in the end, this will save you money. If we have a better idea what you want up front, we won't need to make changes later.">
                                    <svg xmlns="http://www.w3.org/2000/svg" color="#FFA500" width="18" height="18"
                                        fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                                        <path
                                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                        <path
                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                    </svg>
                                </div>
                            </label>
                            <textarea class="form-control" name="visionDesign" rows="5" data-toggle="tooltip"
                                data-placement="top"
                                title="Complete this information as you wish to have it appear on Spine."></textarea>
                            
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                    <label> Upload File(s)</label>
                            <div class="fileupload text-center">
                                <label class="form-control upload_label">
                                    <input type="file" class="form-control upload_hide" id="fileUpload" name="myfile[]"
                                        multiple required>


                                    <span><i class="fa fa-cloud-upload text-centre text-primary fa-5x"></i></span>
                                    <p class="text-centre text-primary" id="noOfFiles">Drag & Drop to Upload File
                                    </p>

                                </label>
                            </div>
                    </div>
                </div>
                   

                    <div class="row">
                        <div class="col-md-12 mt-md-0 mt-3 text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>


    
    <div class="footer-copyright text-center py-3"><span class="text-white">©
    <script>
      document.write((new Date().getFullYear()).toString());
    </script> Copyright: <a style="color:white" href="https://www.s4carlisle.com/">S4Carlisle Publishing Services Pvt. Ltd.
    </a></span>
  </div>
</body>

</html>