<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php
        include 'connections.php';

        $create='./form.html';
        echo "<p><a href=".$create." class='btn btn-primary'>Create new user</a></p>";

        $sql="SELECT id, fname, lname, email, gender FROM users"; 
        $result= $conn->query($sql);
        $update='./update.php';
        $delete='./delete.php'; 

        if ($result->num_rows > 0) {
            echo "<table class='table'>";
            echo "<thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Gender</th><th>Delete</th><th>Update</th></tr></thead><tbody>";
            while($row = $result->fetch_assoc()) { 
                echo "<tr><td>". $row["id"] . "</td><td>" . $row["fname"] . "</td><td>". $row["lname"] . "</td><td>" . $row["email"] . "</td><td>" . $row["gender"] . "</td><td><a href=".$delete."?id=". $row["id"] ." class='btn btn-danger'>Delete</a>". "</td><td><a href=".$update."?id=". $row["id"] ." class='btn btn-primary'>Update</a>"."</td></tr>"; 
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No users</p>";
        }
        $conn->close();
        ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
