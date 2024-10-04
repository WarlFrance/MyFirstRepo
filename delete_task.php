<?php
include 'config.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $taskId = intval($_GET['id']);

    // Prepare the SQL statement
    $sql = "DELETE FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $taskId);

    if ($stmt->execute()) {
        // Ensure no output before this header call
        header("Location: index.php?message=Task+deleted+successfully");
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
} else {
    header("Location: index.php");
    exit();
}

$conn->close();
?>