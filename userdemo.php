<?php
include('database.php');
$obj = new query();


$studentname = '';
$email = '';
$number = '';
$address = '';
$id='';

if(isset($_GET['id'])  && $_GET['id'] !=''){
    $id = $obj->get_safe_str($_GET['id']);

    $condition_arr = array('id'=> $id);
    $result = $obj->getData('student','*',$condition_arr);
    $studentname = $result['0']['studentname'];
    $email = $result['0']['email'];
    $number = $result['0']['number'];
    $address = $result['0']['address'];


}

if(isset($_POST['submit'])){

    $studentname = $obj->get_safe_str($_POST['studentname']);
    $email = $obj->get_safe_str($_POST['email']);
    $number = $obj->get_safe_str($_POST['number']);
    $address =$obj->get_safe_str($_POST['address']);
    $filename= $_FILES["inputfile"]["name"];
    $tempfile = $_FILES["inputfile"]["tmp_name"];
    $folder = "image/".$filename;
    // $imgContent = addslashes(file_get_contents($tempfile)); 

    $condition_arr = array('studentname' =>$studentname,'email' =>$email,'number' =>$number,'address'=>$address,'image'=>$filename);

    if($id != ''){
        $obj->updateData('student',$condition_arr,'id',$id);
        move_uploaded_file($tempfile,$folder);
    }else{
       
        $obj->insertData('student',$condition_arr);
        move_uploaded_file($tempfile,$folder);
    }



  header('location:listdemo.php');
}



?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student Create</title>

    <style>

.error{
color: red;
font-size: smaller;

}

    </style>


</head>
<body>
  
    <div class="container mt-5">

       

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Add 
                            <a href="listdemo.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="post"  id="register"  name="myform" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label>Student Name</label>
                                <input type="text" name="studentname" class="form-control" value="<?php echo $studentname ?>" >
                            </div>
                            <div class="mb-3">
                                <label>Student Email</label>
                                <input type="text" name="email" class="form-control" value="<?php echo $email ?>" >
                            </div>
                            <div class="mb-3">
                                <label>Student Phone</label>
                                <input type="text" name="number" class="form-control" value="<?php echo $number ?>" >
                            </div>
                            <div class="mb-3">
                                <label>Student Address</label>
                                <input type="text" name="address" class="form-control" value="<?php echo $address ?>" >
                            </div>
                           
                            <div class="mb-3">
                                <label>Student Image</label>
                                <input type="file" name="inputfile" class="form-control" id="inputfile" >
                                <label id="inputfile-error" class="error" for="inputfile" ></label>
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="submit" class="btn btn-primary">Save Student</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"> </script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
 <script src="jcrud.js"></script>


</body>
</html>