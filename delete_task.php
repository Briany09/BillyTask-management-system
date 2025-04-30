<?php
include 'db.php';
$id = $_GET['id'];
$sql = "DELETE FROM tasks WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    echo "Error deleting task: " . $conn->error;
}
?>
