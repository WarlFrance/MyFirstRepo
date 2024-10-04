<?php
include 'config.php';

// Check if the 'id' parameter is set and is a valid integer
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $taskId = intval($_GET['id']); // Use intval to ensure it's an integer

    // Prepare the SQL statement to prevent SQL injection
    $sql = "UPDATE tasks SET status = 'completed' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    // Bind parameters and execute the statement
    $stmt->bind_param("i", $taskId);

    if ($stmt->execute()) {
        // Redirect back to the task list with a success message
        header("Location: index.php?message=Task+marked+as+complete");
        exit();
    } else {
        // Handle the error gracefully
        echo "Error updating record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // If no ID is provided or is invalid, redirect back to the index page
    header("Location: index.php");
    exit();
}

// Close the database connection
$conn->close();
?>
