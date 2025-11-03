<?php
include 'connection.php';

$category_id = $_GET['category_id'] ?? 0;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name'] ?? '');

    if ($name === '') {
        $errors[] = 'Name is required.';
    } elseif (strlen($name) > 191) {
        $errors[] = 'Name is too long (max 191 characters).';
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO sub_categories (sub_category_name, parent_category_id) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $category_id);
        if ($stmt->execute()) {
            header("Location: ViewSubCategories.php?category_id=$category_id");
            exit;
        } else {
            $errors[] = 'Database error: ' . $stmt->error;
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Sub-Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Add New Sub-Category</h1>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Sub-Category</button>
            <a href="ViewSubCategories.php?category_id=<?php echo $category_id; ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>