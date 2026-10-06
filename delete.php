<?php

require 'db.php';
require 'functions.php';


$id = $_GET['id'] ?? '';


if (!filter_var($id, FILTER_VALIDATE_INT)) {

    die("Invalid task ID.");

}


$stmt = $pdo->prepare(
    "DELETE FROM tasks WHERE id = :id"
);


$stmt->execute([

    ':id' => $id

]);


setFlash("Task deleted successfully.");


header("Location: index.php");

exit;