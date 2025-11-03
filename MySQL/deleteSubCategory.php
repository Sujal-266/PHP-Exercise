<?php
include 'connection.php';

$id = $_GET['id'] ?? 0;

// Fetch sub-category details to get category_id
$stmt = $conn->prepare("SELECT parent_category_id FROM sub_categories WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$sub_category = $result->fetch_assoc();

if (!$sub_category) {
    die("Sub-Category not found.");
}

$category_id = $sub_category['parent_category_id'];

// Delete sub-category
$stmt = $conn->prepare("DELETE FROM sub_categories WHERE id = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    // Check if there are remaining sub-categories
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM sub_categories WHERE parent_category_id = ?");
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->fetch_assoc()['count'];

    if ($count == 0) {
        // Redirect to categories page if no sub-categories remain
        header("Location: ViewCategory.php");
    } else {
        // Redirect back to sub-categories page
        header("Location: ViewSubCategories.php?category_id=$category_id");
    }
    exit;
} else {
    die("Error deleting sub-category: " . $stmt->error);
}
?>