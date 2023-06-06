<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <?php function encodeValue ($s) {
        return htmlentities($s, ENT_COMPAT|ENT_QUOTES,'ISO-8859-1', true); 
    }?>
    <form action="">
        userName <input type="text" value="<?php echo encodeValue('Sulthana "sulai"');?>">
    </form>
</body>
</html>