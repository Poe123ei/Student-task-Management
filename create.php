<?php

require 'db.php';
require 'functions.php';


$errors = [];

$title = '';
$description = '';
$category = '';
$priority = '';
$due_date = '';
$completed = 0;


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


    // Insert

    if (empty($errors)) {

        $sql = "INSERT INTO tasks
                (title, description, category, priority, due_date, completed)
                VALUES
                (:title, :description, :category, :priority, :due_date, :completed)";


        $stmt = $pdo->prepare($sql);


        $stmt->execute([

            ':title' => $title,

            ':description' => $description,

            ':category' => $category,

            ':priority' => $priority,

            ':due_date' => $due_date,

            ':completed' => $completed

        ]);


        setFlash("Task created successfully.");


        header("Location: index.php");

        exit;

    }

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Add Task</title>

    <link rel="stylesheet" href="style.css">

</head>


<body>

<div class="container">

    <h1>Add Task</h1>


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
            value="<?= clean($title) ?>"
        >


        <label>Description</label>

        <textarea name="description"><?= clean($description) ?></textarea>


        <label>Category</label>

        <select name="category">

            <option value="">
                Select Category
            </option>

            <option value="Assignment"
                <?= $category === 'Assignment' ? 'selected' : '' ?>>
                Assignment
            </option>

            <option value="Exam"
                <?= $category === 'Exam' ? 'selected' : '' ?>>
                Exam
            </option>

            <option value="Project"
                <?= $category === 'Project' ? 'selected' : '' ?>>
                Project
            </option>

            <option value="Homework"
                <?= $category === 'Homework' ? 'selected' : '' ?>>
                Homework
            </option>

            <option value="Other"
                <?= $category === 'Other' ? 'selected' : '' ?>>
                Other
            </option>

        </select>


        <label>Priority</label>

        <select name="priority">

            <option value="">
                Select Priority
            </option>

            <option value="Low"
                <?= $priority === 'Low' ? 'selected' : '' ?>>
                Low
            </option>

            <option value="Medium"
                <?= $priority === 'Medium' ? 'selected' : '' ?>>
                Medium
            </option>

            <option value="High"
                <?= $priority === 'High' ? 'selected' : '' ?>>
                High
            </option>

        </select>


        <label>Due Date</label>

        <input
            type="date"
            name="due_date"
            value="<?= clean($due_date) ?>"
        >


        <label>

            <input
                type="checkbox"
                name="completed"
            >

            Completed

        </label>


        <br><br>


        <button type="submit">
            Create Task
        </button>

    </form>


    <br>


    <a href="index.php">
        ← Back to Tasks
    </a>

</div>

</body>

</html>