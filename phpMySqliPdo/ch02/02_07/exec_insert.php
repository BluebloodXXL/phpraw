<?php
try {
    require_once '../../includes/pdo_connect.php';
    $sql = 'INSERT INTO names (name, meaning, gender)
            VALUES ("Shanto", "Bliss", "boy")';
    $affected = $db->exec($sql);
    var_dump($affected);
} catch (Exception $e) {
    $error = $e->getMessage();
}
if (isset($error)) {
    echo $error;
}