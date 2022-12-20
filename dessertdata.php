<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods:POST,GET,PUT,DELETE');
header('Access-Control-Allow-Headers: content-type or other');
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fooddata";

$conn = new mysqli ($servername, $username, $password ,$dbname);

if ($conn-> connect_errno){
    die("connection failed:" . $conn->connect_errno);
}



   
   
    //Get dessert data
    $getDessert = "SELECT * from dessertdetail";
    $trp = mysqli_query($conn, $getDessert);
    $dessert = array();
    while($z = mysqli_fetch_assoc($trp)) {
        $dessert[] = $z;
       
    }
    print json_encode($dessert);

    //Add dessert
    if (isset($_POST['newFoodName'])) {
        $sql = "INSERT INTO dessertdetail (foodname, fooddescpirtion,pdate,edate,foodquantity,price,seller)
        VALUES ('".$_POST['newFoodName']."','".$_POST['newFoodDescr']."','".$_POST['newFoodPDate']."','".$_POST['newFoodEDate']."','".$_POST['newFoodPrice']."','".$_POST['newFoodPrice']."','".$_POST['newFoodSeller']."')";
    
        if(mysqli_query($conn,$sql)) {
            $data = array("data" => "Data added succeessfully");
            echo json_encode($data);
        } else {
            $data = array("data" => "Error: " . $sql. "<br>" . $conn->error);
            echo json_encode($data);
        }
    } 

    //Del Dessert
    if (isset($_POST['foodID'])) {
        $sql = "DELETE from dessertdetail where id =".$_POST['foodID'];
    
        if(mysqli_query($conn,$sql)) {
            $data = array("data" => "Data deleted succeessfully");
            echo json_encode($data);
        } else {
            $data = array("data" => "Error: " . $sql. "<br>" . $conn->error);
            echo json_encode($data);
        }
    } 

    //===========Change Dish Data=====================================================
    if (isset($_POST['updateFoodName'])) {
        $sql = "UPDATE dessertdetail SET 
                                        foodname = '".$_POST["updateFoodName"]."',
                                        fooddescpirtion = '".$_POST["updateFoodDescr"]."',
                                        pdate = '".$_POST["updateFoodPDate"]."',
                                        edate = '".$_POST["updateFoodEDate"]."',
                                        foodquantity = '".$_POST["updateFoodQty"]."',
                                        price = '".$_POST["updateFoodPrice"]."'
                                       
                                WHERE ID = ".$_POST['updateFoodID']."; ";

        if(mysqli_query($conn,$sql)) {
            $data = array("data" => "Data Update succeessfully");
            echo json_encode($data);
        } else {
            $data = array("data" => "Error: " . $sql. "<br>" . $conn->error);
            echo json_encode($data);
        }
    } 

   
   

die();
?>