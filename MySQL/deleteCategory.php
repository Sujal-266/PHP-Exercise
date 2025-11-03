<?php
include 'connection.php';

$id = $_GET['id'] ?? 0;

// Delete category
$stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    header("Location: ViewCategory.php");
    exit;
} else {
    die("Error deleting category: " . $stmt->error);
}
?>