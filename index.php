<?php

require 'db.php';
require 'functions.php';

$stmt = $pdo->prepare(
    "SELECT * FROM tasks ORDER BY due_date ASC"
);

$stmt->execute();

$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Assigned challenge: Count completed tasks

$completedCount = 0;

foreach ($tasks as $task) {

    if ($task['completed'] == 1) {

        $completedCount++;

    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Student Task Manager</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h1>Student Task Manager</h1>

    <?php showFlash(); ?>


    <div class="counter">

        Completed Tasks:
        <strong><?= $completedCount ?></strong>

    </div>


    <br>


    <a href="create.php" class="button">
        + Add Task
    </a>


    <table>

        <tr>

            <th>ID</th>

            <th>Title</th>

            <th>Description</th>

            <th>Category</th>

            <th>Priority</th>

            <th>Due Date</th>

            <th>Completed</th>

            <th>Actions</th>

        </tr>


        <?php foreach ($tasks as $task): ?>

        <tr>

            <td>
                <?= clean($task['id']) ?>
            </td>


            <td>
                <?= clean($task['title']) ?>
            </td>


            <td>
                <?= clean($task['description']) ?>
            </td>


            <td>
                <?= clean($task['category']) ?>
            </td>


            <td>
                <?= clean($task['priority']) ?>
            </td>


            <td>
                <?= clean($task['due_date']) ?>
            </td>


            <td>

                <?php if ($task['completed'] == 1): ?>

                    Yes

                <?php else: ?>

                    No

                <?php endif; ?>

            </td>


            <td>

                <a href="edit.php?id=<?= $task['id'] ?>">
                    Edit
                </a>

                |

                <a
                    href="delete.php?id=<?= $task['id'] ?>"
                    onclick="return confirm('Are you sure you want to delete this task?');"
                >
                    Delete
                </a>

            </td>

        </tr>

        <?php endforeach; ?>

    </table>

</div>

</body>

</html>