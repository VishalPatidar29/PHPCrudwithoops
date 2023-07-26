<?php
include('database.php');

$obj = new query();

if(isset($_GET['type']) && $_GET['type'] == 'delete'){
    $id = $obj->get_safe_str($_GET['id']);
    $condition_arr = array('id' =>$id);
     $obj->deleteData('student',$condition_arr);
    
}

// this code for get data
$result = $obj->getData('student');

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>demo CRUD</title>
</head>
<body>
  
    <div class="container mt-4">


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Details
                            <a href="userdemo.php" class="btn btn-primary float-end">Add Students</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped  text-center">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">File</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php  
                            if(isset($result['0'])){
                            foreach($result as $list){
                            
                            ?>
                            
                                            <tr>
                                                <td><?php echo $list['id'] ?></td>
                                                <td><?php echo $list['studentname'] ?></td>
                                                <td><?php echo $list['email'] ?></td>
                                                <td><?php echo $list['number'] ?></td>
                                                <td><?php echo $list['address'] ?></td>
            
                                                <td><a href="./image/<?php echo $list['image'] ?>"><?php echo $list['image'] ?></a></td>

                                                <td>
                                            
                                                    <td><a href="userdemo.php?id=<?php echo $list['id'] ?>"  class="btn btn-success btn-sm">Edit</a>
                                                    <a href="?type=delete&id=<?php echo $list['id'] ?>" class="btn btn-danger btn-sm">Delete</a></td>
                                                       
                                                </td>
                                            </tr>
                                        
                                   <?php
                            }     
                            }else{ ?>

                                            <tr>
                                                <td colspan="6" align ="center">NO Records Found!</td>
                                       </tr>
                           <?php } ?>
                        
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>