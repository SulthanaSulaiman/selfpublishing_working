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

        <form class="wrapper" name="serviceForm" id="serviceForm"  action="#"
            method="post">
            <h2>Services form</h2>
            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>First name</label>
                    <input type="text" name="firstName" id="firstName">
                </div>
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Sur name</label>
                    <input type="text" name="surName" id="surName">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Mail</label>
                    <input type="text" name="mailId" id="mailId">
                </div>
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Book name</label>
                    <input type="text" name="bookName" id="bookName">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>ISBN</label>
                    <input type="text" name="isbn" id="isbn">

                </div>
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Category</label>
                    <select name="category" id="category">
                        <option value="Select">Select</option>
                        <option value="Cover Design">Cover Design</option>
                        <option value="Production Services">Production Services</option>
                        <option value="Index">Index</option>
                        <option value="Editorial Services">Editorial Services</option>
                        <option value="Full Services">Full Services</option>
                        <option value="Production and Index">Production and Index</option>
                        <option value="Production and Editorial">Production and Editorial</option>
                        <option value="Production, Editorial, and Index">Production, Editorial, and Index</option>
                        <option value="Cover and Production">Cover and Production</option>
                        <option value="Production, Cover, and Index">Production, Cover, and Index</option>
                        <option value="Production, Cover, and Editorial">Production, Cover, and Editorial</option>

                    </select>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Cover</label>
                    <select name="Cover" id="Cover">
                        <option value="Select">Select</option>
                        <option value="Color">Color</option>
                        <option value="Black & White">Black & White</option>
                    </select>

                </div>
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Editorial complexity</label>
                    <select name="Editorial Complexity" id="Editorial Complexity">
                        <option value="Select">Select</option>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <label>Number of manuscript pages</label>
                    <input type="text" name="Number of Manuscript Pages" id="Number of Manuscript Pages">
                </div>

                <div class="col-md-6 mt-md-0 mt-3">
                    <label> </label>
                    <input type="submit" name="submitBtn" id="submitBtn" value="Submit">

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
            var name = document.contactForm.firstName.value;
            var authorMail = document.contactForm.mailId.value;
            var category = document.contactForm.category.value;
            //category=function convertUTF7toUTF81(category) { return category.replace(/\+([a-z\d\/+]*\-?)/gi, function (m, a) { var i = 0, c = '', h = Buffer(a, 'base64'), l = h.length >> 1 << 1 - 1; while (i < l) c += String.fromCharCode(h.readUInt16BE(i++ * 2)); return c }) };
            $.ajax({
                method: "post",
                url: "http://10.1.6.32/selfpublising/authorMailer.php?companyId=11829044757&groupId=11829076861&bookInfo=%7B%22Author%20Name%22%3A%20%22John%20Doe%22%2C%22Email%22%3A%20%22JD%40gmail.com%22%2C%22ISBN%22%3A%20%22%22%2C%22Cover%22%3A%20%22Color%22%2C%22Editorial%20Complexity%22%3A%20%22Low%22%2C%22Number%20of%20Manuscript%20Pages%22%3A%20%22251%22%7D&redirectURL=https://www.pagemajik.com/&bookDetails=%7B%22categoryName%22%3A%22" + category + "%22%2C%22bookName%22%3A%22%20Arbitration%20%26%20Conciliation%20%22%2C%22chapterCount%22%3A%222%22%2C%20%22isCoverDesignOnly%22%3A%22true%22%7D&userDetails=%7B%22firstName%22%3A%20%22" + name + "%22%2C%22surName%22%3A%20%22%22%2C%22mailId%22%3A%20%22" + authorMail + "%22%20%7D",

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