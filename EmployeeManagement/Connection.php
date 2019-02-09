<!DOCTYPE>

<html>

<head>
    <title>Connection</title>
</head>

<body>
<?php

//$Connection = mysql_connect('localhost','root', '');
//$select = mysql_select_db('record', $Connection);

$conn = new mysqli('localhost', 'root', '', 'record');

if ($conn) {
    //echo "Connection successful";
} else {
    error . mysqli_connect_error();
    //error.mysql_connect();
}

?>
</body>

</html>