<?php
require 'config.php';
require 'connection.php';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <link href="style/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <script src="style/bootstrap.bundle.min.js"></script>
    <script src="style/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css">
    <script>

       

   // Defining a function to display error message
   function printError(elemId, hintMsg) {
    try{
        document.getElementById(elemId).innerHTML = hintMsg;
    }
    catch(err)
    {
        console.log(err);
    }
} 


function validateForm() {
    try{
 // Retrieving the values of form elements 
    var file=document.getElementById("fileLength").value;

    var  fileErr= true;


    // Validate manuscript file
    if (file == "") {
        printError("fileErr", "Please select file(s).");
    } else {

        printError("fileErr", "");
        fileErr = false;
    }
    
 if ((fileErr) == true) {
    console.log("fileErr:"+fileErr);

    alert("Please fill the mandatory fileds.");
    return false;
    }
    else {
    
        console.log("fileErr:"+fileErr);
        return true;
    }
    }catch(err)
    {
        console.log(err);
    }
   
};

/*Files upload
window.addEventListener("load", () => {
    const input = document.getElementById("fileLength");
    // const filewrapper=document.getElementById("filewrapper");

    input.addEventListener("change", (e) => {
        let fileLength = e.target.files.length;
        //let filetype=e.target.value.split(".").pop();
        console.log(fileLength);
        fileshow(fileLength);
    })

    const fileshow = (fileLength) => {
        if (fileLength == 1) {
            document.getElementById("noOfFiles").innerHTML = fileLength + " file selected";
        }
        else {
            document.getElementById("noOfFiles").innerHTML = fileLength + " files selected";
        }

        // console.log(showfileboxElem);
        //  filewrapper.append(showfileboxElem);
    }
})
*/
    </script>
</head>

<body>
    <?php
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
                <h3 class="text-center p-2 heading">INDEX</h3>
            </div>

        </div>


        <div class="wrapper rounded bg-white">

            <form name="authorForm" onsubmit="return validateForm()"
                action="http://10.1.6.32/selfpublishing/productionMailer.php?id=<?php echo $eid; ?>" method="post"
                enctype="multipart/form-data" class="form" novalidate>

                <!--<h5 class="text-danger text-center">
                    <?php if (($result['submitCount'])) {
                        echo "If any query, please contact <span class='text-primary'><u>selfpublish@s4carlisle.com</u></span>.";
                    } ?>
                </h5> -->
                <div class="row">

                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Author name</label>
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
                        <label>Book title</label>
                        <input type="text" class="form-control required" value="<?php if ((!empty($result['bookTitle']))) {
                            echo $result['bookTitle'];
                        } ?>" name="bookTitle" id="bookTitle" required readonly="readonly">

                    </div>

                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Book subtitle</label>
                        <input type="text" class="form-control" name="bookSubTitle" id="bookSubTitle" value="<?php if ((!empty($result['bookSubtitle']))) {
                            echo $result['bookSubtitle'];
                        } ?>" <?php if ((!empty($result['bookSubtitle']))) {
                             echo 'readonly="readonly"';
                         } ?>>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Interior design</label>
                        <input type="text" class="form-control" name="interiorDesign" id="interiorDesign" value="<?php if ((!empty($result['interiorDesign']))) {
                            echo $result['interiorDesign'];
                        } ?>" required readonly="readonly">
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">
                        <label>Editorial complexity</label>
                        <input type="text" class="form-control" name="editorialCompexity" id="editorialCompexity" value="<?php if ((!empty($result['editorialComplexity']))) {
                            echo $result['editorialComplexity'];
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
                            echo $result['isbn'];
                        } ?>" <?php if ((!empty($result['isbn']))) {
                             echo 'readonly="readonly"';
                        } ?>>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                            <label>Any other details that you like to include?<!--<span class="text-danger">*</span>-->
                            </label>
                            <textarea class="form-control" name="other" id="other" rows="5" <?php if ((!empty($result['other']))) {
                                echo 'readonly="readonly"';
                            } ?>   data-toggle="tooltip" data-placement="top"
                                title="Any other details that you like to include?"><?php if ((!empty($result['other']))) {
                                    echo $result['other'];
                                } ?></textarea>
                        
                    </div>
                    <div class="col-md-6 mt-md-0 mt-3">

                        <div <?php if ((!empty($result['fileName']))&&(($result['submitCount']))) {
                            echo 'style="display:none;"';
                        } else {
                            echo 'style="display:block;"';
                        } ?>>
                            <label>Upload your manuscript and other files<span class="text-danger">*</span>
                                <div style="display: inline-block;" data-toggle="tooltip" data-placement="top"
                                    title="You can upload your files as either one zip file or multiple files. Allowed file types are Image, Text, Pdf, Word, Excel, PowerPoint and Zip. Overall maximum file size limit is 500 MB.">
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
                            <!--<div class="text-center">
                                    <label class="form-control upload_label">
                                        <input type="file" class="form-control upload_hide" id="fileInput"
                                            name="myfile[]" multiple required>


                                        <span><i class="fa fa-cloud-upload text-centre text-primary fa-5x"></i></span>
                                        <p class="text-centre text-primary" id="noOfFiles">Drag & Drop to upload your file(s) here!
                                        </p>

                                    </label>

                                </div>-->
                            <div class="border p-2">
                                <div class="dropZone text-primary" id="dropZone">
                                <span style="display:block"><i class="fa fa-cloud-upload text-centre text-primary fa-5x"></i></span>
                                    Drag & Drop to upload your file(s) here!
                                   
                                </div>
                                <div class="msg text-primary" style="display: none;" id="msg">
                                File(s) uploaded successfully!
                                    <input type="text" id="fileLength" style="display: none;" name="fileLength" readonly="readonly"/>
                                    
                                </div>
                                <div class="file-list" id="fileList">
                                    <!-- File items will be dynamically added here -->
                                </div>
                                <div class="text-center"><button class="upload-button" type="button" id="uploadButton"
                                        disabled>Upload</button></div>

                            </div>
                            <script>
                                 // file Upload

                                    var fileList = [];
                                    var totalFileSize = 0;
                                    var maxFileSize = 500 * 1024 * 1024; // 500MB limit

                                    // Function to handle file drop
                                    function handleDrop(e) {
                                        e.preventDefault();
                                        var files = e.dataTransfer.files;
                                        for (var i = 0; i < files.length; i++) {
                                            var file = files[i];
                                            if (isValidFile(file)) {
                                                addFileToList(file);
                                                totalFileSize += file.size;
                                            } else {
                                               // alert('Invalid file format or size exceeded. \n\nAllowed file types (Image, Text, Pdf, Word, Excel, PowerPoint, Zip) \nOverall maximum file size limit is 500 MB.');
                                               alert('\n\u26A0\uFE0F Invalid file format or size exceeded. \n\nAllowed file types are Image, Text, Pdf, Word, Excel, PowerPoint and Zip. \nOverall maximum file size limit is 500 MB.');


                                            }
                                        }
                                        document.getElementById('uploadButton').disabled = !canUpload();
                                    }

                                    // Function to handle file drag over
                                    function handleDragOver(e) {
                                        e.preventDefault();
                                    }

                                    // Function to check if file is valid
                                    function isValidFile(file) {
                                        var fileType = file.type.toLowerCase();
                                        var validExtensions = [ 'image/jpeg',
                                                                'image/png',
                                                                'application/msword',
                                                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                                                'application/pdf',
                                                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                                                'application/zip',
                                                                'application/x-zip-compressed',
                                                                'application/x-7z-compressed',
                                                                'application/x-rar-compressed',
                                                                'text/plain',
                                                                'application/xml',
                                                                'application/vnd.ms-powerpoint',
                                                                'application/vnd.openxmlformats-officedocument.presentationml.presentation'];
                                        var maxFileSizeExceeded = file.size > maxFileSize;

                                        return validExtensions.includes(fileType) && !maxFileSizeExceeded;
                                    }

                                    // Function to add file to the file list
                                    function addFileToList(file) {
                                        var fileItem = document.createElement('div');
                                        fileItem.className = 'file-item';

                                        var fileName = document.createElement('span');
                                        fileName.className = 'file-name';
                                        fileName.textContent = file.name;
                                        fileItem.appendChild(fileName);

                                        var deleteButton = document.createElement('span');
                                        deleteButton.className = 'delete-button';
                                        deleteButton.textContent = 'Delete';
                                        deleteButton.addEventListener('click', function () {
                                            deleteFile(file);
                                            fileItem.remove();
                                        });
                                        fileItem.appendChild(deleteButton);

                                        fileList.push(file);
                                        document.getElementById('fileList').appendChild(fileItem);
                                    }

                                    // Function to delete file from the file list
                                    function deleteFile(file) {
                                        var index = fileList.indexOf(file);
                                        if (index !== -1) {
                                            fileList.splice(index, 1);
                                            totalFileSize -= file.size;
                                        }
                                    }

                                    // Function to check if files can be uploaded
                                    function canUpload() {
                                        return fileList.length > 0 && totalFileSize <= maxFileSize;
                                    }

                                    // Function to upload the files to the server
                                    function uploadFiles() {
                                        var formData = new FormData();
                                        for (var i = 0; i < fileList.length; i++) {
                                            var file = fileList[i];
                                            document.getElementById("fileLength").value=fileList.length;
                                            formData.append('files[]', file);
                                        }

                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', 'zip_files.php?id=<?php echo $eid; ?>', true);
                                        xhr.onreadystatechange = function () {
                                            if (xhr.readyState === 4 && xhr.status === 200) {
                                                var response = JSON.parse(xhr.responseText);
                                                //console.log(response);
                                                //var fileUploadresponse = JSON.parse(xhr.responseText);

                                                /*if (fileUploadresponse.success) {
                                                    alert('Files were uploaded in mysql');
                                                    resetFileList();
                                                    dropZone.style.display = 'none';
                                                    msg.style.display = 'block';
                                                } else {
                                                    alert('An error occurred while zipping the files.');
                                                }*/

                                                if (response.success) {
                                                    alert('\n\u2714 File(s) uploaded successfully!');
                                                    resetFileList();
                                                    dropZone.style.display = 'none';
                                                    upload.style.display = 'none';
                                                    msg.style.display = 'block';
                                                } else {
                                                    alert('\n\u26A0 An error occurred while uploading the files.');
                                                }
                                            }
                                        };
                                        xhr.send(formData);
                                    }

                                    // Function to reset the file list
                                    function resetFileList() {
                                        fileList = [];
                                        totalFileSize = 0;
                                        document.getElementById('fileList').innerHTML = '';
                                        document.getElementById('uploadButton').disabled = true;
                                    }

                                    // Attach event listeners to the drop zone
                                    var dropZone = document.getElementById('dropZone');
                                    var msg = document.getElementById('msg');
                                    var upload = document.getElementById('uploadButton');
                                    dropZone.addEventListener('dragover', handleDragOver);
                                    dropZone.addEventListener('drop', handleDrop);

                                    // Attach event listener to the upload button
                                    var uploadButton = document.getElementById('uploadButton');
                                    uploadButton.addEventListener('click', uploadFiles);
                            </script>

                        </div>
                        <div <?php if ((!empty($result['fileName']))&&(($result['submitCount']))) {
                            echo 'style="display:block;"';
                        } else {
                            echo 'style="display:none;"';
                        } ?>>
                            <label> Download manuscript file(s)<span class="text-danger">*</span></label>
                            <div class="text-center">
                                <label class="form-control dropzone1">
                                    <a download="<?php echo $result['fileName']; ?>"
                                        href="uploads/<?php echo $result['fileName'] ?>"><span><i
                                                class="fa fa-cloud-download text-centre text-primary fa-5x"></i></span>
                                        <p class="text-centre text-primary" id="noOfFiles">Download manuscript
                                            file(s)
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
                            } ?>>Submit</button>
                        </div>
                </div>
                <div class="row">
                        <div class="col-md-12 mt-md-0 mt-3 text-center">
                            <p class="text-danger text-center">
                                <?php if (($result['submitCount'])) {
                                     
                                    echo 'Form already submitted, please contact <a href="mailto:selfpublish@s4carlisle.com" target="_blank" >selfpublish@s4carlisle.com</a> for updates.';
                                } 
                                else
                                { 
                                    echo 'If any query, please contact <a href="mailto:selfpublish@s4carlisle.com" target="_blank">selfpublish@s4carlisle.com</a>.';
                                }?>
                            </p>
                        </div>
                </div>
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