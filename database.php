<?php

// create the database class  and maintane the connection
class database{

     private $host;
     private $dbusername;
     private $dbpassword;
     private $dbname;

     protected function connect() {

         $this->host="localhost";
         $this->dbusername="root";
         $this->dbpassword ="";
         $this->dbname="crud";

         $con = new mysqli($this->host,$this->dbusername,$this->dbpassword,$this->dbname);
     return $con;
     }
    }


    // create the query class and inherit the database class
    class query extends database{

        //this function create the select query
   public function getData($table, $field='*' , $condition_arr='', $order_by_field='', $order_by_type='desc',$limit='') {

         $sql = "select $field from $table";
    
    //  this is for where condition 
         if($condition_arr != ''){
            $sql.=' where ';
            $c = count($condition_arr);
            $i=1;

        foreach($condition_arr as $key=>$val){
        if($i == $c){
           $sql .= " $key = '$val'";
        }
         else{
            $sql .= " $key = '$val' and ";
        }
      $i++;
         }

        }

    //    this is for order by
         if($order_by_field != ''){

            $sql .= " order by $order_by_field $order_by_type";
         }

     // this is for limit function

         if($limit != ''){

            $sql .= " limit $limit ";
         }

        //  now query is ready
         $result = $this->connect()->query($sql);
     
         if($result->num_rows > 0){

          $arr = array();
        while($row = $result->fetch_assoc()){
           $arr[] = $row;
        }
   return $arr;

         }else{
            return 0;
         }
        
   }


// this function for insert query
   public function insertData($table,$condition_arr='') {

    if($condition_arr != ''){

   foreach($condition_arr as $key=>$val){

    $fieldArr[] = $key;
    $valueArr[] = $val;
    
    }

    $field = implode(",",$fieldArr);
    $value = implode("','",$valueArr);
    $value = "'".$value."'";
   
    $sql = "insert into $table($field) values($value) ";
//   die($sql);
    $result = $this->connect()->query($sql);

   }
  
   
}

// this funcion for delete data
public function deleteData($table,$condition_arr='') {

    if($condition_arr != ''){
        $sql = "delete from $table where ";
        $c = count($condition_arr);
        $i=1;

    foreach($condition_arr as $key=>$val){
    if($i == $c){
       $sql .= " $key = '$val'";
    }
     else{
        $sql .= " $key = '$val' and ";
    }
  $i++;
}
//   die($sql);
    $result = $this->connect()->query($sql);

   } 
}


// this function for update data

public function updateData($table,$condition_arr='',$where_field,$where_value) {

   

    if($condition_arr != ''){
        $sql = "update $table set ";
        $c = count($condition_arr);
        $i=1;

    foreach($condition_arr as $key=>$val){
    if($i == $c){
       $sql .= " $key = '$val'";
    }
     else{
        $sql .= " $key = '$val' , ";
    }
  $i++;
}
$sql .= " where $where_field = '$where_value' ";

//   die($sql);
    $result = $this->connect()->query($sql);

   }
  
   
}


public function get_safe_str($str){

   if($str != ''){

    return mysqli_real_escape_string($this->connect(),$str);
}
}

}


// select $filed from $table where $condition 

// delete from table where 



?>