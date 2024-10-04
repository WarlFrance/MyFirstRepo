<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Task Manager</title>
</head>

<body>
    
<?php
// Include this at the top of your HTML/PHP file
if (isset($_GET['message'])) {
    echo "<script>document.addEventListener('DOMContentLoaded', function() {
        showModal('" . htmlspecialchars($_GET['message']) . "');
    });</script>";
}
?>

<!-- Modal HTML -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p id="modalMessage">Task marked as complete</p>
    </div>
</div>


<!-- Success Modal -->
<div id="successModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p id="modalMessage">Task updated successfully!</p>
    </div>
</div>


<h1>ToDo List</h1>

<div class="button-container">
    <a href="create_task.php" class="add-task-btn">Add Task</a>
</div>


<?php include 'view_tasks.php'; ?>

<script src="scripts.js"></script> <!-- Link to the external JavaScript file -->


</body>
</html>




