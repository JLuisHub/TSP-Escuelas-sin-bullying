<?php
include('db.php');

$UserMatricula = $decodedData['Matricula'];
$UserPW = ($decodedData['contrasena']); //password is hashed

$SQL = "SELECT * FROM docentes WHERE matricula = '$UserMatricula'";
$exeSQL = mysqli_query($conn, $SQL);
$checkMatricula =  mysqli_num_rows($exeSQL);

if ($checkMatricula != 0) {
    $arrayu = mysqli_fetch_array($exeSQL);
    if ($arrayu['contrasena'] != $UserPW) {
        $Message = "pw WRONG";
    } else {
        $Message = "Success";
    }
} else {
    $Message = "No account yet";
}

$response[] = array("Message" => $Message);
echo json_encode($response);