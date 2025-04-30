<?php
$conn = new mysqli("localhost", "root", "", "task_db");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $status = $_POST['status'];

    if (!empty($title)) {
        $stmt = $conn->prepare("INSERT INTO tasks (title, description, status) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $description, $status);
        $stmt->execute();
        header("Location: index.php");
        exit();
    } else {
        $error = "Task Title is required!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Task</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
  <h1>➕ Add New Task</h1>

  <?php if (!empty($error)): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" class="form-box">
    <label for="title">Task Title:</label>
    <input type="text" name="title" id="title" placeholder="Enter task title..." required>

    <label for="description">Description:</label>
    <textarea name="description" id="description" rows="4" placeholder="Enter task description..."></textarea>

    <label for="status">Status:</label>
    <select name="status" id="status">
        <option value="Pending">Pending</option>
        <option value="Completed">Completed</option>
    </select>

    <button type="submit" class="btn submit">Add Task</button>
  </form>

  <div class="nav">
    <a href="index.php">🔙 Back to Task List</a>
  </div>
</div>

<div class="footer">
  <p>&copy; <?= date('Y') ?> Task Management System. All Rights Reserved.</p>
</div>
</body>
</html>
