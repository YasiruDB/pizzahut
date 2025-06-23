<?php
// Connect to the DB
$conn = mysqli_connect('localhost', 'yasiru', 'test123456789', 'pizza', 3313);
if (!$conn) {
    echo 'Connection failed';
    exit;
}

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $sql = "DELETE FROM addpizza WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo 'success';
    } else {
        echo 'Delete error: ' . mysqli_error($conn);
    }
} else {
    echo 'Invalid request';
}

mysqli_close($conn);
