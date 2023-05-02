<?php
include "connections.php";
if(isset($_POST['btnImport'])){
    $fileName=$_FILES['file']['name'];
    if($_FILES['file']['size']>0){
        $filehandle=fopen($fileName, 'r');
        $sql="LOAD DATA LOCAL INFILE '".$fileName."'INTO TABLE users FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 LINES(fname, lname, email, gender);";
        $upload_csv=$conn->query($sql);
        if($upload_csv){
            $message="CSV data imported successfully";
            
        }else{
            $message="Problem in importing CSV file";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link herf="assets/vendor/bootstrap4/css/bootstrap.min.css"rel="stylesheet">
    <link href="assets/vendor/DataTables/datatables.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
</head>
<body>
    <h2>Import csv into database</h2>
    <?php if(!empty($message)){?>
        <div class="alert alert-success" id="response">
            <?php
            echo $message;
            ?>
        </div>
        <?php
    }
        else{
            ?>
           <div class=""></div> 
        <?php
        }
        ?>
        <div class="row">
            <div class="col-md-12 head">
                <div class="float-right">
                </div>
            </div>
        </div>

    <div class="wrapper">
        <div id="body" class="active">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <form action="" class="form-horizontal" method="POST" id="frmCSVImport" name="frmCSVImport" enctype="multipart/form-data">
                  <div class="col-md-6"><input type="file" name="file" accept=".csv">
                  <button type="submit" id="submit" name="btnImport" class="btn btn-primary">Import</button>
                  <br><br>
                 
                </div>           
                    </div>
                    <div class="box box-primary">
                      
                        <div class="box-body">

                            <table width="100%" class="table table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sqlSelect="SELECT * FROM users";
                                    $result=mysqli_query($conn,$sqlSelect);
                                    if(mysqli_num_rows($result)>0){
                                        while($row=mysqli_fetch_array($result)){
                                       ?>
 <tr>
        <th><?php echo $row['id'];?></th>
        <th><?php echo $row['fname'];?></th>
        <th><?php echo $row['lname'];?></th>
        <th><?php echo $row['email'];?></th>
        <th><?php echo $row['gender'];?></th>
       
    </tr>
                                       <?php     
                                        }
                                    }

                                        ?>
                                        <?php

                    ?>
   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendor/jquery3/jquery-3.4.1.min.js"></script>
    <script src="assets/vendor/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/DataTables/datatables.min.js"></script>
    <script src="assets/js/initiate-tables.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>