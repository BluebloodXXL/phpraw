<?php
try {
    require_once '../../includes/pdo_connect.php';
    $sql = 'INSERT INTO names (name, meaning, gender)
            VALUES ("Shanto", "Bliss", "boy")';
    $result = $db->query($sql);
    echo $result->queryString;
    //var_dump($result);
} catch (Exception $e) {
    $error = $e->getMessage();
}
if (isset($error)) {
    echo $error;
}