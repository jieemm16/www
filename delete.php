<?php
include('connection.php');

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    // Display a confirmation prompt using JavaScript
    echo "
        <script>
            var confirmDelete = confirm('Are you sure you want to delete this record?');
            if (confirmDelete) {
                window.location.href = 'delete.php?confirmedDeleteid={$id}';
            } else {
                window.location.href = 'display.php'; // Redirect to the display page or any other page
            }
        </script>
    ";
}

if (isset($_GET['confirmedDeleteid'])) {
    $id = $_GET['confirmedDeleteid'];

    // Use prepared statements to prevent SQL injection
    $sql = "DELETE FROM `admintable` WHERE id=?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        echo "Deleted Successfully";
        header('Location: display.php'); // Redirect to display.php after successful deletion
        exit(); // Make sure to exit after the header redirect
    } else {
        die(mysqli_error($con));
    }
}

// Fetch data for display
$sql_select = "SELECT * FROM `usertable`";
$result_select = mysqli_query($con, $sql_select);
$rows = mysqli_fetch_all($result_select, MYSQLI_ASSOC);

?>
