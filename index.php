<html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Services</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>

    <script src="style/jquery-2.1.3.min.js"></script>
    <link href="style/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!--<script src="style/bootstrap.bundle.min.js"></script>-->
    <script src="style/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="style/jquery.bootpag.min.js"></script>
    <link rel="stylesheet" href="style/style1.css">
    <link rel="stylesheet" href="style/style.css">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>


    <style>
        form label {
            font-size: 18;
        }
    </style>
</head>

<body>
    <div class="col-lg-9 container">
        <div><img src="style/S4Clogo.png" style="height:55px;width:180px; margin-top: 10px;"
                alt="S4Carlisle Publishing Services"></div>

        <form class="wrapper" name="serviceForm" id="serviceForm" method="POST" enctype="multipart/form-data">
            <h2>Services form</h2>
            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>First name<span style="color:red;">*</span></label>
                    <input type="text" name="firstName" id="firstName">
                </div>
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Sur name</label>
                    <input type="text" name="surName" id="surName">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Mail<span style="color:red;">*</span></label>
                    <input type="text" name="mailId" id="mailId">
                </div>
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Book name<span style="color:red;">*</span></label>
                    <input type="text" name="bookName" id="bookName">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>ISBN</label>
                    <input type="text" name="isbn" id="isbn">

                </div>
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Category<span style="color:red;">*</span></label>
                    <select name="category" id="category">
                        <option value="">Select</option>
                        <option value="Cover Design">Cover Design</option>
                        <option value="Production Services">Production Services</option>
                        <option value="Index">Index</option>
                        <option value="Editorial Services">Editorial Services</option>
                        <option value="Full Services">Full Services</option>
                        <option value="Production and Index">Production and Index</option>
                        <option value="Production and Editorial">Production and Editorial</option>
                        <option value="Production, Editorial, and Index">Production, Editorial, and Index</option>
                        <option value="Cover and Production">Cover and Production</option>
                        <option value="Production, Cover, and Index">Production, Cover, and Index</option>
                        <option value="Production, Cover, and Editorial">Production, Cover, and Editorial</option>
                        <option value="Editorial and Index">Editorial and Index</option>

                    </select>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Cover</label>
                    <select name="Cover" id="cover">
                        <option value="">Select</option>
                        <option value="Color">Color</option>
                        <option value="Black and White">Black and White</option>
                    </select>

                </div>
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Editorial complexity</label>
                    <select name="editorialComplexity" id="editorialComplexity">
                        <option value="">Select</option>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Number of manuscript pages</label>
                    <input type="number" name="numberOfManuscriptPages" id="numberOfManuscriptPages">
                </div>

                <div class="col-md-6 mt-md-0 mt-3">
                    <lablel>&nbsp;&nbsp;</lablel>
                    <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
                    <lablel>&nbsp;&nbsp;</lablel>
                    <button id="spinner" class="btn btn-primary" type="button" style="display:none;" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span>Please wait...</span>
                    </button>


                </div>
            </div>
        </form>
        <div class="footer-copyright text-center py-3"><span class="text-white">©
                <script>
                    document.write((new Date().getFullYear()).toString());
                </script> Copyright: <a style="color:white" href="https://www.s4carlisle.com/"
                    target="_blank">S4Carlisle
                    Publishing
                    Services Pvt.
                    Ltd.
                </a>
            </span>
        </div>
    </div>
    <script src="style/js/jquery.js"></script>
    <script src="style/js/jquery.validate.js"></script>
    <script>
        $(document).ready(function () {
            $('#serviceForm').validate({
                rules: {
                    firstName: {
                        required: true,
                    },
                   
                    mailId: {
                        required: true,
                        email: true,
                    },
                    category: {
                        required: true,
                    },
                    isbn: {
                        isbnNo: true,
                    },
                    bookName: {
                        required: true,
                    },

                },
                messages: {
                    firstName: {
                        required: 'Please enter your first name',
                    },
                   
                    mailId: {
                        required: 'Please enter your first name',
                        email: 'Please enter a valid email address',
                    },
                    category: {
                        required: 'Please select your category',
                    },
                    bookName: {
                        required: 'Please enter the book name',
                    },
                },
                submitHandler: function (form) {
                    // This function will be called when the form is valid and submitted
                    // You can perform the AJAX request here
                    sendRequest();
                },
            });
            jQuery.validator.addMethod("isbnNo", function (value, element) {
                if (value.trim() === "") {
                    return true; // Skip validation for empty values
                }

                return isValidISBN(value);
            }, "Please enter a valid 13-digit ISBN number starting with 978 or 979");

            function isValidISBN(isbn) {
                // Remove hyphens from the string
                var digitsOnly = isbn.replace(/-/g, "");

                // Check if the resulting string has exactly 13 digits
                if (!/^\d{13}$/.test(digitsOnly)) {
                    return false;
                }

                // Check if the first three digits are 978 or 979
                var firstThreeDigits = digitsOnly.slice(0, 3);
                if (firstThreeDigits !== "978" && firstThreeDigits !== "979") {
                    return false;
                }

                return true;
            }
        });

        function handleResponse(response) {
            if (typeof response === 'string') {
                // Parse the response as a JSON string
                var data = JSON.parse(response);
                // Handle the individual JSON object
                console.log(data);

            } else if (typeof response === 'object') {
                // Handle the response as an object directly
                alert(response.Status);
            } else {
                // Handle other response formats accordingly
                console.log("Unknown response format");
            }
        }

        function sendRequest() {
            // Disable the submit button to prevent multiple submissions
            $('#submit').hide();

            // Show the spinner inside the submit button
            $('#spinner').show();
            var firstName = document.serviceForm.firstName.value;
            var surName = document.serviceForm.surName.value;
            var mailId = document.serviceForm.mailId.value;
            var category = document.serviceForm.category.value;
            var isbn = document.serviceForm.isbn.value;
            var bookName = document.serviceForm.bookName.value;
            var editorialComplexity = document.serviceForm.editorialComplexity.value;
            var cover = document.serviceForm.Cover.value;
            var numberOfManuscriptPages = document.serviceForm.numberOfManuscriptPages.value;
           
           // console.log("URL before decode:http://10.1.6.32/selfpublishing/authorMailer.php?bookDetails=%7B%22categoryName%22%3A%22" + category + "%22%2C%22bookName%22%3A%22" + bookName + "%22%7D&userDetails=%7B%22firstName%22%3A%22" + firstName + "%22%2C%22surName%22%3A%22" + surName + "%22%2C%22mailId%22%3A%22" + mailId + "%22%7D&bookInfo=%7B%22ISBN%22%3A%20%22" + isbn + "%22%2C%22Cover%22%3A%20%22" + cover + "%22%2C%22Editorial%20Complexity%22%3A%20%22" + editorialComplexity + "%22%2C%22Number%20of%20Manuscript%20Pages%22%3A%20%22" + numberOfManuscriptPages + "%22%7D");
            
            $.ajax({
                method: "POST",
                url: 'http://10.1.6.32/selfpublishing/authorMailer.php?bookDetails={"categoryName":"' + category + '","bookName":"' + bookName + '"}&userDetails={"firstName":"' + firstName + '","surName":"' + surName + '","mailId":"' + mailId + '"}&bookInfo={"ISBN": "' + isbn + '","Cover": "' + cover + '","Editorial Complexity": "' + editorialComplexity + '","Number of Manuscript Pages": "' + numberOfManuscriptPages + '"}',
                dataType: "json",
                data: $('#serviceForm').serialize(),
                success: function (response) {
                    // Enable the submit button
                    $('#submit').show();

                    // Restore the original text of the submit button
                    $('#spinner').hide();
                    // Process the response(s)
                    if (Array.isArray(response)) {
                        // Handle multiple responses
                        response.forEach(function (item) {
                            handleResponse(item);
                        });
                    } else {
                        // Handle a single response
                        handleResponse(response);
                    }
                    location.reload();

                },
                error: function (xhr, status, error) {
                    // Enable the submit button
                    $('#submit').show();

                    // Restore the original text of the submit button
                    $('#spinner').hide();
                    // Handle the error
                    alert("Error: " + error);
                    location.reload();
                }
            });
        }
    </script>
</body>

</html>