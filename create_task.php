<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">

    <title>Task Manager</title>
</head>
<body>

     <!--set the min date-->
     <script>
            window.onload = function() {
                // Get today's date in YYYY-MM-DD format
                let today = new Date().toISOString().split('T')[0];
                // Set the min attribute of the input field to today's date
                document.getElementById('due_date').setAttribute('min', today);
            }
    </script>


    <h1>Create a New Task</h1>
    <form action="create_task.php" method="POST">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" placeholder = "Task Title" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" placeholder = "Description" ></textarea><br><br>

        <label for="due_date">Due Date:</label>
        <input type="date" name="due_date" id="due_date" min= current required><br><br>

        <input type="submit" value="Create Task">

    </form>

</body>
</html>

<?php
    include 'config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $due_date = trim($_POST['due_date']);

        if ($stmt = $conn->prepare("INSERT INTO tasks (title, description, due_date, status) VALUES (?, ?, ?, 'pending')")) {
            $stmt->bind_param("sss", $title, $description, $due_date);

            if ($stmt->execute()) {
                header("Location: index.php?success=added");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }

$conn->close();
?>
