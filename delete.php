<?php
include 'connections.php';

$create='./form.html';
echo "<p><a href=".$create.">Create new user</a></p>";

$id = $_GET['id'];

$sql="DELETE FROM users WHERE id = $id"; 
$result= $conn->query($sql);

if ($result === true) {
    echo "User deleted successfully";
    header('Location: read.php');
} else {
    echo "Error deleting user: " . mysqli_error($conn);
}
$conn->close();

?>