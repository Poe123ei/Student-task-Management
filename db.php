<?php

$pdo = new PDO(
    "mysql:unix_socket=/tmp/mysql-reset.sock;dbname=student_tasks;charset=utf8mb4",
    "root",
    ""
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);