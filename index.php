<?php
$conn = new mysqli("localhost", "root", "", "task_db");
$result = $conn->query("SELECT * FROM tasks");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Task Manager</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
  <h1>📋 Task Management System</h1>
  <div class="nav">
    <a href="add_task.php">➕ Add Task</a>
  </div>
  <div class="table-wrapper">
    <table>
      <tr>
        <th>S/N</th>
        <th>Task</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
      <?php 
      $sn = 1;
      while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $sn++ ?></td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['status']) ?></td>
        <td class="actions">
          <a class="btn edit" href="edit_task.php?id=<?= $row['id'] ?>">✏️ Edit</a>
          <button class="btn delete" onclick="confirmDelete(<?= $row['id'] ?>)">🗑️ Delete</button>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>
</div>

<div class="footer">
  <p>&copy; <?= date('Y') ?> Task Management System. All Rights Reserved.</p>
</div>

<script>
  function confirmDelete(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "This task will be permanently deleted!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#e74c3c",
      cancelButtonColor: "#3498db",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "delete_task.php?id=" + id;
      }
    });
  }
</script>
</body>
</html>
