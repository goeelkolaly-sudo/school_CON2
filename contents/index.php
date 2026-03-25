<?php
include "config.php";

$stmt = $connection->prepare("SELECT * from students");
$stmt->execute();

//>> array
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<a href="create.php">ADD STUDENT</a>

<table border="1">
    <tr>
        <th>student id</th>
        <th>student name</th>
        <th>student email</th>
        <th>student phone</th>
        <th>action</th>
    </tr>

<?php foreach($students as $student):?>
    <tr>
        
        <th> <?= $student ['id'] ?> </th>
        <th> <?= $student ['name'] ?> </th>
        <th> <?= $student ['email'] ?></th>
        <th> <?= $student ['phone'] ?></th>
        <th>

    <a href="edit.php?id=<?=$student['id']?>"> edit </a>
    <a href="delete.php?id=<?=$student['id']?>" onclick="return confirm('Are You Want TO Delete ?')"> delete </a>

    </tr>
<?php endforeach;?>    
</table>