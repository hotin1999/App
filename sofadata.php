<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods:POST,GET,PUT,DELETE');
header('Access-Control-Allow-Headers: content-type or other');
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "FARBEmallData";

$conn = new mysqli ($servername, $username, $password ,$dbname);

if ($conn-> connect_errno){
    die("connection failed:" . $conn->connect_errno);
}


    //Get sofa data
    $getSofa = "SELECT * from SofadDtails  ";
    $SofaResult = mysqli_query($conn, $getSofa);
    $Sofa = array();
    while($row = mysqli_fetch_assoc($SofaResult)) {
        $Sofa[] = $row;
       
    }
    print json_encode($Sofa);

    //Add Sofa Data
    if (isset($_POST['newSofaName'])) {
        $sql = "INSERT INTO Sofadetails (SofaName, SofaDescription, Size, ClassicSeriesPrice, PremiumSeriesPrice, Notice)
        VALUES ('".$_POST['newSofaName']."','".$_POST['newSofaDescription']."','".$_POST['newSofaSize']."','".$_POST['newSofaClassicSeriesPrice']."','".$_POST['newSofaPremiumSeriesPrice']."','".$_POST['newSofaNotice']."')";
    
        if(mysqli_query($conn,$sql)) {
            $data = array("data" => "Data added succeessfully");
            echo json_encode($data);
        } else {
            $data = array("data" => "Error: " . $sql. "<br>" . $conn->error);
            echo json_encode($data);
        }
    } 

    //Delete Sofa Data
    if (isset($_POST['SofaID'])) {
        $sql = "DELETE from SofaDetails where ID =".$_POST['SofaID'];
    
        if(mysqli_query($conn,$sql)) {
            $data = array("data" => "Data deleted succeessfully");
            echo json_encode($data);
        } else {
            $data = array("data" => "Error: " . $sql. "<br>" . $conn->error);
            echo json_encode($data);
        }
    } 
   
     //Update Sofa Data
     if (isset($_POST['updateSofaName'])) {
        $sql = "UPDATE SofaDetails SET 
            SofaName = '".$_POST["updateSofaName"]."',
            SofaDescription = '".$_POST["updateSofaDescription"]."',
            Size = '".$_POST["updateSofaSize"]."',
            ClassicSeriesPrice = '".$_POST["updateSofaClassicSeriesPrice"]."',
            PremiumSeriesPrice = '".$_POST["updateSofaPremiumSeriesPrice"]."',
            Notice = '".$_POST["updateSofaNotice"]."'
            
            WHERE ID = ".$_POST['updateSofaID']."; ";

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