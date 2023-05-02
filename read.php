<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Users</h1>
            <div>
                <a href="form.html" class="btn btn-primary">New Student</a>
                <a href="csv.php" class="btn btn-warning">Import CSV</a>
                <a href="pdf.php" name="view" class="btn btn-info">Get PDF Document</a>
                <a href="export.php" class="btn btn-success"><i class="fas fa-download"></i> Download CSV</a>
            </div>
        </header>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "connections.php";
                $sql="SELECT * FROM users";
                $res=$conn->query($sql);
                while($row=mysqli_fetch_array($res)){
                ?>
                    <tr>
                        <td><?php echo $row["id"];?></td>
                        <td><?php echo $row["fname"];?></td>
                        <td><?php echo $row["lname"];?></td>
                        <td><?php echo $row["email"];?></td>
                        <td><?php echo $row["gender"];?></td>
                        <td>
                            <a href="update.php?id=<?php echo $row["id"];?>" class="btn btn-warning">Update</a>
                            <a href="delete.php?id=<?php echo $row["id"];?>" name="delete" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php
                };
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
