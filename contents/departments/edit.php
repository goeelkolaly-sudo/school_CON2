<?php
include "../config.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $connection->prepare("SELECT * FROM departments WHERE id = :id");
$stmt->execute(['id' => $id]);
$department = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$department) {
    header("Location: index.php");
    exit;
}

$errors = [];
$name = $department['name'];

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);

    if ($name == "") {
        $errors[] = "Department name is required";
    }

    if (empty($errors)) {
        $stmt = $connection->prepare("UPDATE departments SET name = :name WHERE id = :id");
        $stmt->execute(['name' => $name, 'id' => $id]);

        header("Location: index.php");
        exit;
    }
}
?>

<h3>Edit Department</h3>

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

    <button name="submit" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
</form>