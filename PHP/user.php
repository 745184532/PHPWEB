<?php
$servername ="localhost";
$username ="root";
$password="admin123";
try{
    $conn = new mysqli($servername,$username,$password);

}catch(PDOException $e){
    echo $e->getMessage();
}
if ($conn->connect_error){
    die("连接失败". $conn->connect_error);
}
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "select * from user where username = '" . $username . "' and password = '" . $password . "'";
echo $sql;

$result = $conn -> query($sql);

$conn ->close();