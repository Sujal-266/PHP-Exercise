<?php
// Handle POST before any HTML output so we can redirect on success
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $errors = [];

    // Validate input
    if ($name === '') {
        $errors[] = 'Name is required.';
    } elseif (strlen($name) > 191) {
        $errors[] = 'Name is too long (max 191 characters).';
    }

    // If no errors, insert into the database
    if (empty($errors)) {
        include 'connection.php';
        $stmt = $conn->prepare("INSERT INTO categories (`Name`) VALUES (?)");
        if ($stmt) {
            $stmt->bind_param("s", $name);
            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();
                header('Location: ViewCategory.php');
                exit;
            } else {
                $errors[] = 'Database error: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $errors[] = 'Prepare failed: ' . $conn->error;
        }
        $conn->close();
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body {
            padding: 18px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="h4 mb-3">Add New Category</h1>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    <?php foreach ($errors as $err) : ?>
                        <li><?php echo htmlspecialchars($err); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="post" novalidate>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Add Category</button>
                <a href="ViewCategory.php" class="btn btn-outline-secondary">Back to list</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>