<?php
include 'db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM tasks WHERE id=$id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $sql = "UPDATE tasks SET title='$title', description='$description', status='$status' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Edit Task</h2>
    <form method="post">
        <input type="text" name="title" value="<?= $row['title']; ?>" required>
        <textarea name="description" rows="4"><?= $row['description']; ?></textarea>
        <select name="status">
            <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="Completed" <?= $row['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
        </select>
        <input type="submit" value="Update Task">
    </form>
    <div style="margin-top: 20px;"><a href="index.php">← Back to Task List</a></div>
</div>
</body>
</html>
