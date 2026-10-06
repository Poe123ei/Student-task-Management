# Student Task Management System

## Student Information

**Name:** Poe Ei Khaing
**Student ID: 202300205

---

## Project Descriptionx

This project is a simple **Student Task Management System** built using:

* PHP
* MySQL
* HTML
* CSS

The system allows students to create, view, update, and delete tasks.

---

## Features

### 1. Create Task

Users can add a new task with:

* Title
* Description
* Category
* Priority
* Due Date
* Completed status

### 2. Read Tasks

The system displays all tasks in a table.

### 3. Update Task

Users can edit an existing task and update its information.

### 4. Delete Task

Users can delete a task from the system.

### 5. Completed Task Counter

The system counts and displays the number of completed tasks.

---

## Database

Database name:

`student_tasks`

Table name:

`tasks`

The `tasks` table contains:

* `id`
* `title`
* `description`
* `category`
* `priority`
* `due_date`
* `completed`
* `created_at`

---

## Project Files

```text
Student task management/
│
├── index.php
├── create.php
├── edit.php
├── delete.php
├── db.php
├── functions.php
├── style.css
└── README.md
```

### File Description

**index.php**
Displays all tasks and the completed task count.

**create.php**
Contains the form for creating a new task.

**edit.php**
Allows users to update an existing task.

**delete.php**
Deletes a selected task.

**db.php**
Connects PHP to the MySQL database using PDO.

**functions.php**
Contains reusable functions such as data cleaning and session flash messages.

**style.css**
Provides the design and layout of the application.

---

## Validation and Security

The project uses server-side validation to check required fields.

Prepared statements are used for database operations to help prevent SQL injection.

`htmlspecialchars()` is used when displaying user input to help prevent XSS attacks.

Task IDs are also validated before editing or deleting tasks.

---

## How to Run

1. Start the MySQL server.

2. Make sure the database `student_tasks` and table `tasks` exist.

3. Open Terminal and go to the project folder:

```bash
cd "Student task management"
```

4. Start the PHP development server:

```bash
php -S localhost:8001
```

5. Open the application in a browser:

```text
http://localhost:8001
```

---

## CRUD Flow

```text
HTML Form
    ↓
PHP
    ↓
PDO Prepared Statement
    ↓
MySQL Database
    ↓
PHP
    ↓
HTML Table
```

For example, when creating a task:

```text
User fills form
       ↓
POST request
       ↓
create.php
       ↓
Validation
       ↓
PDO INSERT
       ↓
MySQL tasks table
       ↓
Redirect to index.php
```

---

## AI Reflection

I used AI to help me understand the structure of a PHP CRUD application and to explain PHP concepts such as PDO, prepared statements, GET and POST, validation, sessions, and CRUD operations.

AI also helped me identify errors and improve the organization of my PHP files.

I reviewed and tested the code myself and made sure I understood how the application works. The main concepts I learned from this project are how a PHP form sends data to the server, how PHP communicates with MySQL using PDO, and how CRUD operations work.

---

## Assigned Challenge

**Challenge: Count Completed Tasks**

The application counts how many tasks have `completed = 1`.

The count is displayed on the main task page.

Example:

```text
Completed Tasks: 2
```

This challenge uses a PHP `foreach` loop and an `if` condition to count completed tasks.
