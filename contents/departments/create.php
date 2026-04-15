<?php
include "../config.php";

$errors = [];
$name = "";

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);

    if ($name == "") {
        $errors[] = "Department name is required";
    }

    if (empty($errors)) {
        $stmt = $connection->prepare("INSERT INTO departments (name) VALUES (:name)");
        $stmt->execute(['name' => $name]);

        header("Location: index.php");
        exit;
    }
}
?>

<h3>Add Department</h3>

<?php
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
    }
}
?>

<form method="POST">
    <div class="form-group">
        <label>Department Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name" placeholder="Enter department name" value="<?= htmlspecialchars($name) ?>">
    </div>

    <button name="submit" class="btn btn-primary">Add</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>