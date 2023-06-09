<?php
extract($_POST);
include_once('connection.php');
$dao = new DAO();
echo json_encode($dao->GetResultByPage($num));

?>


