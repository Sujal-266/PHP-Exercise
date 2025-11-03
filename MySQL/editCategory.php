<?php
include 'connection.php';

$id = $_GET['id'] ?? 0;
$errors = [];

// Fetch category details
$stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$category = $result->fetch_assoc();

if (!$category) {
    die("Category not found.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name'] ?? '');

    if ($name === '') {
        $errors[] = 'Name is required.';
    } elseif (strlen($name) > 191) {
        $errors[] = 'Name is too long (max 191 characters).';
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $id);
        if ($stmt->execute()) {
            header("Location: ViewCategory.php");
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
    <title>Edit Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Edit Category</h1>
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
                <input type="text" class="form-control" id="name" name="name" required value="<?php echo htmlspecialchars($category['Name']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
            <a href="ViewCategory.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>