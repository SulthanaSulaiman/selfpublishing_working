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

    <script>
        // Defining a function to display error message
        function printError(elemId, hintMsg) {
            document.getElementById(elemId).innerHTML = hintMsg;
        }

        function validateForm() {
            var name = document.contactForm.userName.value;
            var authorMail = document.contactForm.userMail.value;
            var category = document.contactForm.category.value;
            // var bookInfo = document.contactForm.bookInfo.value;
            //var bookDetails = document.contactForm.bookDetails.value;
            //var userDetails = document.contactForm.userDetails.value;


            var nameErr = emailErr = categoryErr /*= bookInfoErr = bookdetailsErr = userdetailsErr*/ = true;

            // Validate name
            if (name == "") {
                printError("nameErr", "Please enter your name");
            } else {
                var regex = /^[a-zA-Z\s]+$/;
                if (regex.test(name) === false) {
                    printError("nameErr", "Please enter a valid name");
                } else {
                    printError("nameErr", "");
                    nameErr = false;
                }
            }

            // Validate email address
            if (authorMail == "") {
                printError("emailErr", "Please enter your email address");
            } else {
                // Regular expression for basic email validation
                var regex = /^\S+@\S+\.\S+$/;
                if (regex.test(authorMail) === false) {
                    printError("emailErr", "Please enter a valid email address");
                } else {
                    printError("emailErr", "");
                    emailErr = false;
                }
            }


            // Validate category
            if (category == "Select") {
                printError("categoryErr", "Please select your category");
            } else {
                printError("categoryErr", "");
                categoryErr = false;
            }

            /*
            // Validate bookInfo
            if(bookInfo == "") {
                printError("bookinfoErr", "Please enter your bookinfo");
            } else {
                var regex = /^[a-zA-Z\s]+$/;                
                if(regex.test(bookInfo) === false) {
                    printError("bookinfoErr", "Please enter a valid bookInfo");
                } else {
                    printError("bookinfoErr", "");
                    bookInfoErr = false;
                }
            }
    
              // Validate bookDetails
            if(bookDetails == "") {
                printError("bookdetailsErr", "Please enter your book details");
            } else {
                var regex = /^[a-zA-Z\s]+$/;                
                if(regex.test(bookDetails) === false) {
                    printError("bookdetailsErr", "Please enter a valid book details");
                } else {
                    printError("bookdetailsErr", "");
                    bookdetailsErr = false;
                }
            }
    
            // Validate userDetails
            if(userDetails == "") {
                printError("userdetailsErr", "Please enter your user details");
            } else {
                var regex = /^[a-zA-Z\s]+$/;                
                if(regex.test(userDetails) === false) {
                    printError("userdetailsErr", "Please enter a valid user details");
                } else {
                    printError("userdetailsErr", "");
                    userdetailsErr = false;
                }
            }
            */
            // errors
            if ((nameErr || emailErr || categoryErr/* || bookInfoErr || bookdetailsErr || userdetailsErr*/) == true) {
                return false;
            } else {
                //input data for preview
                var dataPreview = "You've entered the following details: \n" +
                    "Name: " + name + "\n" +
                    "Author Mail: " + authorMail + "\n" +
                    "Category: " + category + "\n";
                /* "bookInfo: " + bookInfo + "\n" +
                 "bookDetails: " + bookDetails + "\n" +
                 "userDetails: " + userDetails + "\n"*/

                //alert(dataPreview);
                return sendRequest();

            }
        };
    </script>
</head>

<body>

    <form name="contactForm" id="serviceForm" onsubmit="return validateForm()" action="#" method="post">
        <h2>Services Form</h2>
        <div class="row">
            <label>User Name</label>
            <input type="text" name="userName">
            <div class="error" id="nameErr"></div>
        </div>
        <div class="row">
            <label>User Mail</label>
            <input type="text" name="userMail">
            <div class="error" id="emailErr"></div>
        </div>
        <div class="row">
            <label>Category</label>
            <select name="category">
                <option>Select</option>
                <option>Cover Design</option>
                <option>Production Services</option>
                <option>Index</option>
                <option>Editorial Services</option>
                <option>Full Services</option>
                <option>Production and Index</option>
                <option>Production and Editorial</option>
                <option>Production, Editorial, and Index</option>
                <option>Cover and Production</option>
                <option>Production, Cover, and Index</option>
                <option>Production, Cover, and Editorial</option>

            </select>
            <div class="error" id="categoryErr"></div>
        </div>
        <!--<div class="row">
            <label>Book Info</label>
            <input type="text" name="bookInfo">
            <div class="error" id="bookinfoErr"></div>
        </div>
        <div class="row">
            <label>Book Details</label>
            <input type="text" name="bookDetails">
            <div class="error" id="bookdetailsErr"></div>
        </div>
        <div class="row">
            <label>User Details</label>
            <input type="text" name="userDetails">
            <div class="error" id="userdetailsErr"></div>
        </div>-->

        <div class="row">
            <input type="submit" name="submit" id="submit" value="Submit">

        </div>
    </form>

    <script>
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
            var name = document.contactForm.userName.value;
            var authorMail = document.contactForm.userMail.value;
            var category = document.contactForm.category.value;
            //category=function convertUTF7toUTF81(category) { return category.replace(/\+([a-z\d\/+]*\-?)/gi, function (m, a) { var i = 0, c = '', h = Buffer(a, 'base64'), l = h.length >> 1 << 1 - 1; while (i < l) c += String.fromCharCode(h.readUInt16BE(i++ * 2)); return c }) };
            $.ajax({
                method: "post",
                url: "http://10.1.6.32/selfpublishing/authorMailer.php?companyId=11829044757&groupId=11829076861&bookInfo=%7B%22Author%20Name%22%3A%20%22John%20Doe%22%2C%22Email%22%3A%20%22JD%40gmail.com%22%2C%22ISBN%22%3A%20%22%22%2C%22Cover%22%3A%20%22Color%22%2C%22Editorial%20Complexity%22%3A%20%22Low%22%2C%22Number%20of%20Manuscript%20Pages%22%3A%20%22251%22%7D&redirectURL=https://www.pagemajik.com/&bookDetails=%7B%22categoryName%22%3A%22" + category + "%22%2C%22bookName%22%3A%22%20Arbitration%20%26%20Conciliation%20%22%2C%22chapterCount%22%3A%222%22%2C%20%22isCoverDesignOnly%22%3A%22true%22%7D&userDetails=%7B%22firstName%22%3A%20%22" + name + "%22%2C%22surName%22%3A%20%22%22%2C%22mailId%22%3A%20%22" + authorMail + "%22%20%7D",

                dataType: "json",
                data: $('#serviceForm').serialize(),
                async: false,
                success: function (response) {
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
                },
                error: function (xhr, status, error) {
                    // Handle the error
                    alert("Error: " + error);
                }
            });
            // });
            // });
        }

    </script>
</body>

</html>