function markComplete(id, status) {
    var taskRow = document.getElementById("task-" + id);

    if (!taskRow) {
        showModal("This task has been deleted.");
        return; // Exit the function if the task does not exist
    }

    if (status === 'completed') {
        // Task is already completed, show the modal with a message
        showModal("This task is already marked as complete.");
    } else {
        // Confirm marking as complete
        if (confirm("Are you sure you want to mark this task as complete?")) {
            // Redirect to mark the task as complete in the database
            window.location.href = 'mark_complete.php?id=' + id + '&message=Task+marked+as+complete';
        }
    }
}

// Confirm before deleting a task
function confirmDelete(taskId) {
    if (confirm("Are you sure you want to delete this task?")) {
        // Redirect to the delete_task.php page with the task ID if confirmed
        window.location.href = 'delete_task.php?id=' + taskId;
    }
}

function showModal(message) {
    var modal = document.getElementById("myModal");
    var modalContent = document.getElementById("modalMessage");
    modalContent.textContent = message; // Set the message
    modal.style.display = "block"; // Show the modal

    setTimeout(function() {
        closeModal();
    }, 3000); // Hide the modal after 3 seconds
}

function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none"; // Hide the modal
}

// Update the task UI after marking as complete
function updateTaskUI(id) {
    var taskRow = document.getElementById("task-" + id);
    taskRow.classList.add('completed-row'); // Change row style to completed

    // Hide the edit icon but keep the delete and done icons visible
    var editIcon = taskRow.querySelector('.icon-edit');
    if (editIcon) editIcon.style.display = 'none';

    // Change the color of the mark as done icon to green
    var doneIcon = taskRow.querySelector('.icon-done i');
    if (doneIcon) doneIcon.style.color = "green";
}

// Close modal when clicking anywhere outside of it
window.onclick = function(event) {
    var modal = document.getElementById("myModal");
    if (event.target === modal) {
        closeModal(); // Close when clicking outside the modal content
    }
}

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const successModal = document.getElementById('successModal');

    if (urlParams.get('success') === 'added') {
        showModal("Task added successfully!"); // Show success message for task addition
    } else if (urlParams.get('success') === 'updated') {
        showModal("Updating task success!"); // Show success message for task update
    }

    if (successModal) {
        // Hide the modal after 3 seconds
        setTimeout(function() {
            successModal.style.display = "none";
        }, 3000); // 3000 ms = 3 seconds
    }
}

// Function to delete a task with confirmation
function deleteTask(id) {
    if (confirm("Are you sure you want to delete this task?")) {
        window.location.href = 'delete_task.php?id=' + id; // Redirect to the delete handler
    }
}
