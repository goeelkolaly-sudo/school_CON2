<?php
include "config.php";
$id= $_GET['id'];

if (!isset($id) || !is_numeric($id))
{
die("invalid student id");
}

$stmt = $connection->prepare("DELETE FROM students WHERE id = '$id'");
$stmt->execute();

header("location:index.php");
exit;
?>

.bu