<?php
include 'connection.php';

$id = $_GET['id'] ?? 0;
$errors = [];

// Fetch sub-category details
$stmt = $conn->prepare("SELECT * FROM sub_categories WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$sub_category = $result->fetch_assoc();

if (!$sub_category) {
    die("Sub-Category not found.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name'] ?? '');
    $category_id = $_POST['category_id'] ?? 0;

    if ($name === '') {
        $errors[] = 'Name is required.';
    } elseif (strlen($name) > 191) {
        $errors[] = 'Name is too long (max 191 characters).';
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("UPDATE sub_categories SET sub_category_name = ?, parent_category_id = ? WHERE id = ?");
        $stmt->bind_param("sii", $name, $category_id, $id);
        if ($stmt->execute()) {
            header("Location: ViewSubCategories.php?category_id=$category_id");
            exit;
        } else {
            $errors[] = 'Database error: ' . $stmt->error;
        }
    }
}

// Fetch all categories for the dropdown
$categories_result = $conn->query("SELECT * FROM categories");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Sub-Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Edit Sub-Category</h1>
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
                <input type="text" class="form-control" id="name" name="name" required value="<?php echo htmlspecialchars($sub_category['sub_category_name']); ?>">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <?php while ($category = $categories_result->fetch_assoc()): ?>
                        <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $sub_category['parent_category_id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['Name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Sub-Category</button>
            <a href="ViewSubCategories.php?category_id=<?php echo $sub_category['parent_category_id']; ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>