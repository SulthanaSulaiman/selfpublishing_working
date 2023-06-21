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

$(document).ready(() => {
    var name = document.serviceForm.firstName.value;
    var authorMail = document.serviceForm.authorMail.value;
    var category = document.serviceForm.category.value;
    $("#submit").on("submit", (e) => {
        e.preventDefault();
        var spinner = '<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>';
        console.log("Submit button clicked");
        //var formData=new FormData(document.getElementById("servicesForm"));
        $("#submit").html(spinner);
        $.ajax({
            method: "POST",
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
    });
});