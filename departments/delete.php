<?php
include "../auth.php";
include "../config.php";

$id = $_GET['id'] ?? null;

if (!isset($id) || !is_numeric($id)){
die ("invalid department id");
}



$stmt = $connection->prepare("SELECT ID FROM departments WHERE id =:id ");
$stmt->execute(['id' => $id]);

$department = $stmt->fetch(PDO::FETCH_ASSOC);
if (empty($department))
{
    die("enter Valid department id");
}

$stmt = $connection->prepare("DELETE FROM departments WHERE id = '$id'");
$stmt->execute();

header("location:index.php");
exit;

?>
