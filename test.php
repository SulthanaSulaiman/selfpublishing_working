

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script>
function Show_cbackText(value) {
    if (value == 1) { document.getElementById('cbackText').style.display = 'block'; }
    else { document.getElementById('cbackText').style.display = 'none'; }
    return;
}
</script>
<body>
    <form action="productionMailer.php" method="post">
    <label>Book Cover-Back Content?
                            
                            <label class="option">
                                <input type="radio" name="cbackOption" value="Yes"  onclick="Show_cbackText(1)">Yes
                                <span class="checkmark"></span>
                            </label>
                            <label class="option ms-4">
                                <input type="radio" name="cbackOption" value="No" onclick="Show_cbackText(0)">No
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <textarea class="form-control" name="cbackText" id="cbackText" rows="1"  hidden
                            data-toggle="tooltip" data-placement="top"
                            title="Complete this information as you wish to have it appear on Book cover-back."></textarea>

                        <br>
    <button type="submit">Submit</button>
    </form>
</body>
</html>