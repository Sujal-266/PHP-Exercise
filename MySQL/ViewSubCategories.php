<?php
include 'connection.php';

$category_id = $_GET['category_id'] ?? 0;

// Fetch category name
$category_sql = "SELECT name FROM categories WHERE id = ?";
$stmt = $conn->prepare($category_sql);
$stmt->bind_param("i", $category_id);
$stmt->execute();
$category_result = $stmt->get_result();
$category = $category_result->fetch_assoc();

if (!$category) {
    die("<div class='container mt-4'><h1 class='text-danger'>Category not found.</h1><a href='ViewCategory.php' class='btn btn-secondary'>Back to Categories</a></div>");
}

// Fetch sub-categories
$sub_categories_sql = "SELECT * FROM sub_categories WHERE parent_category_id = ?";
$stmt = $conn->prepare($sub_categories_sql);
$stmt->bind_param("i", $category_id);
$stmt->execute();
$sub_categories_result = $stmt->get_result();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sub-Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Sub-Categories of "<?php echo htmlspecialchars($category['name']); ?>"</h1>
        <a href="addNewSubCategory.php?category_id=<?php echo $category_id; ?>" class="btn btn-primary mb-3">Add New Sub-Category</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $sub_categories_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['sub_category_name']); ?></td>
                        <td>
                            <a href="editSubCategory.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="deleteSubCategory.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>