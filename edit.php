<?php

require 'db.php';
require 'functions.php';


$id = $_GET['id'] ?? '';


if (!filter_var($id, FILTER_VALIDATE_INT)) {

    die("Invalid task ID.");

}


$stmt = $pdo->prepare(
    "SELECT * FROM tasks WHERE id = :id"
);


$stmt->execute([

    ':id' => $id

]);


$task = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$task) {

    die("Task not found.");

}


$errors = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title'] ?? '');

    $description = trim($_POST['description'] ?? '');

    $category = $_POST['category'] ?? '';

    $priority = $_POST['priority'] ?? '';

    $due_date = $_POST['due_date'] ?? '';

    $completed = isset($_POST['completed']) ? 1 : 0;


    // Validation

    if ($title === '') {

        $errors[] = "Title is required.";

    }


    if ($category === '') {

        $errors[] = "Category is required.";

    }


    if ($priority === '') {

        $errors[] = "Priority is required.";

    }


    if ($due_date === '') {

        $errors[] = "Due date is required.";

    }


    // Update

    if (empty($errors)) {

        $sql = "UPDATE tasks SET

                title = :title,

                description = :description,

                category = :category,

                priority = :priority,

                due_date = :due_date,

                completed = :completed

                WHERE id = :id";


        $stmt = $pdo->prepare($sql);


        $stmt->execute([

            ':title' => $title,

            ':description' => $description,

            ':category' => $category,

            ':priority' => $priority,

            ':due_date' => $due_date,

            ':completed' => $completed,

            ':id' => $id

        ]);


        setFlash("Task updated successfully.");


        header("Location: index.php");

        exit;

    }


    $task['title'] = $title;

    $task['description'] = $description;

    $task['category'] = $category;

    $task['priority'] = $priority;

    $task['due_date'] = $due_date;

    $task['completed'] = $completed;

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Task</title>

    <link rel="stylesheet" href="style.css">

</head>


<body>

<div class="container">

    <h1>Edit Task</h1>


    <?php if (!empty($errors)): ?>

        <div class="error">

            <?php foreach ($errors as $error): ?>

                <p><?= clean($error) ?></p>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>


    <form method="POST">


        <label>Title</label>

        <input
            type="text"
            name="title"
            value="<?= clean($task['title']) ?>"
        >


        <label>Description</label>

        <textarea name="description"><?= clean($task['description']) ?></textarea>


        <label>Category</label>

        <select name="category">

            <option value="">
                Select Category
            </option>

            <option value="Assignment"
                <?= $task['category'] === 'Assignment' ? 'selected' : '' ?>>
                Assignment
            </option>

            <option value="Exam"
                <?= $task['category'] === 'Exam' ? 'selected' : '' ?>>
                Exam
            </option>

            <option value="Project"
                <?= $task['category'] === 'Project' ? 'selected' : '' ?>>
                Project
            </option>

            <option value="Homework"
                <?= $task['category'] === 'Homework' ? 'selected' : '' ?>>
                Homework
            </option>

            <option value="Other"
                <?= $task['category'] === 'Other' ? 'selected' : '' ?>>
                Other
            </option>

        </select>


        <label>Priority</label>

        <select name="priority">

            <option value="Low"
                <?= $task['priority'] === 'Low' ? 'selected' : '' ?>>
                Low
            </option>

            <option value="Medium"
                <?= $task['priority'] === 'Medium' ? 'selected' : '' ?>>
                Medium
            </option>

            <option value="High"
                <?= $task['priority'] === 'High' ? 'selected' : '' ?>>
                High
            </option>

        </select>


        <label>Due Date</label>

        <input
            type="date"
            name="due_date"
            value="<?= clean($task['due_date']) ?>"
        >


        <label>

            <input
                type="checkbox"
                name="completed"
                <?= $task['completed'] ? 'checked' : '' ?>
            >

            Completed

        </label>


        <br><br>


        <button type="submit">
            Update Task
        </button>

    </form>


    <br>


    <a href="index.php">
        ← Back to Tasks
    </a>

</div>

</body>

</html>