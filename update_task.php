<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $due_date = trim($_POST['due_date']);
    $status = $_POST['status'];

    if ($stmt = $conn->prepare("UPDATE tasks SET title=?, description=?, due_date=?, status=? WHERE id=?")) {
        $stmt->bind_param("ssssi", $title, $description, $due_date, $status, $id);

        if ($stmt->execute()) {
            header("Location: index.php?success=updated");
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
<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $due_date = trim($_POST['due_date']);
    $status = $_POST['status'];

    if ($stmt = $conn->prepare("UPDATE tasks SET title=?, description=?, due_date=?, status=? WHERE id=?")) {
        $stmt->bind_param("ssssi", $title, $description, $due_date, $status, $id);

        if ($stmt->execute()) {
            header("Location: index.php?success=updated");
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
