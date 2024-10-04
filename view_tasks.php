<?php
    include 'config.php';

    $sql = "SELECT * FROM tasks";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php if (isset($_GET['message'])): ?>
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p id="modalMessage"><?php echo htmlspecialchars($_GET['message']); ?></p>
        </div>
    </div>
<?php endif; ?>

<table border="1">
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Due Date</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $completedClass = ($row['status'] === 'completed') ? 'completed-row' : '';
            $doneIconColor = ($row['status'] === 'completed') ? 'style="color: green;"' : ''; // Green if done
        
            echo "<tr id='task-{$row['id']}' class='{$completedClass}'>
                    <td class='{$completedClass}'>{$row['title']}</td>
                    <td class='{$completedClass}'>{$row['description']}</td>
                    <td class='{$completedClass}'>{$row['due_date']}</td>
                    <td class='{$completedClass}'>{$row['status']}</td>
                    <td class='actions'>";
        
            // If the task is pending, show all icons (Edit, Delete, Mark as Done)
            if ($row['status'] === 'pending') {
                echo "<a class='icon icon-edit' href='edit_task.php?id={$row['id']}' title='Edit'>
                        <i class='fas fa-edit'></i>
                      </a>
                      <a class='icon icon-delete' href='javascript:void(0);' onclick='confirmDelete({$row['id']});' title='Delete'>
                        <i class='fas fa-trash'></i>
                      </a>
                      <a class='icon icon-done' href='javascript:void(0);' onclick='markComplete({$row['id']}, \"{$row['status']}\");' title='Mark Complete'>
                        <i class='fas fa-check-circle'></i>
                      </a>";
            }
        
            // Show "Already Done" icon if the task is completed
            if ($row['status'] === 'completed') {
                echo "<a class='icon icon-done' href='javascript:void(0);' onclick='showModal(\"This task is already marked as complete.\");' title='Already Done' {$doneIconColor}>
                        <i class='fas fa-check-circle'></i>
                      </a>
                      <a class='icon icon-delete' href='javascript:void(0);' onclick='confirmDelete({$row['id']});' title='Delete'>
                        <i class='fas fa-trash'></i>
                      </a>";
            }
        
            echo "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No tasks found</td></tr>";
    }
    ?>
</table>

<script src="scripts.js"></script> <!-- Link to the external JavaScript file -->
</body>
</html>

<?php $conn->close(); ?>