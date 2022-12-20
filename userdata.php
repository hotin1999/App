<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods:POST,GET,PUT,DELETE');
header('Access-Control-Allow-Headers: content-type or other');
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "regdata";

$conn = new mysqli ($servername, $username, $password ,$dbname);

if ($conn-> connect_errno){
    die("connection failed:" . $conn->connect_errno);
}

//Add user
if (isset($_POST['username'])) {
    $sql = "INSERT INTO userdetail (username, pw,email,phone,addr)
    VALUES ('".$_POST['username']."','".$_POST['pw']."','".$_POST['email']."','".$_POST['phoneNo']."','".$_POST['address']."')";

    if(mysqli_query($conn,$sql)) {
        $data = array("data" => "Data added succeessfully");
        echo json_encode($data);
    } else {
        $data = array("data" => "Error: " . $sql. "<br>" . $conn->error);
        echo json_encode($data);
    }
} 

//Get user data
    $getLogin = "SELECT * from userdetail  ";

    $trp = mysqli_query($conn, $getLogin);
    $rows = array();
    while($r = mysqli_fetch_assoc($trp)) {
        $rows[] = $r;
    }

    print json_encode($rows);

die();
?>