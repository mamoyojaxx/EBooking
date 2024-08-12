<?php
session_start();

if (isset($_SESSION["user"])) {
    if ($_SESSION["user"] == "" || $_SESSION['usertype'] != 'c') {
        header("Location: ../login.php");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Import database connection
    include("../connection.php");

    $title = $_POST["title"];
    $staffid = $_POST["staffid"];
    $nop = $_POST["nop"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    // Using prepared statements to prevent SQL injection
    $stmt = $database->prepare("INSERT INTO schedule (staffid, title, scheduledate, scheduletime, nop) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $staffid, $title, $date, $time, $nop);

    if ($stmt->execute()) {
        header("Location: appointment.php?action=session-added&title=$title");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
