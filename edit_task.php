<?php
include 'config.php';

$successMessage = ''; // Initialize success message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $sql = "UPDATE tasks SET title='$title', description='$description', due_date='$due_date', status='$status' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Redirect with success message
        header("Location: update_task.php?id=$id&success=true");
        exit(); // Always exit after a redirect
    }
}

// Fetch the task details to populate the form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM tasks WHERE id=$id");

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Task not found.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="index.css"> <!-- Link to the CSS file -->
    
</head>
<body>
    <h1>Edit Task</h1>



<form action="update_task.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <label for="title">Title:</label>
    <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($row['title']); ?>" required><br><br>

    <label for="description">Description:</label>
    <textarea name="description" id="description" required><?php echo htmlspecialchars($row['description']); ?></textarea><br><br>

    <label for="due_date">Due Date:</label>
    <input type="date" name="due_date" id="due_date" value="<?php echo htmlspecialchars($row['due_date']); ?>" required><br><br>

    <label for="status">Status:</label>
    <select name="status">
        <option value="pending" <?php echo $row['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
        <option value="completed" <?php echo $row['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
    </select><br><br>

    <input type="submit" value="Update Task">
</form>




    <script src="scripts.js"></script> <!-- Link to the external JavaScript file -->
    
</body>
</html>
