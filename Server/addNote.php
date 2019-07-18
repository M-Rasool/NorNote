<?php
header("Content-Type : application/json; charset=UTF-8");

// Get data from client
$request = file_get_contents("php://input");
$json = json_decode($request);
$username = $json->username;
$title = $json->title;
$content = $json->content;

// Work in Database
$connection = new mysqli("localhost", "root", "", "NorNote");
if ($connection->connect_error) {
    die("Connection Error : " . $connection->connect_error);
}
$query = "insert into Notes (user, title, content) values ('$username', '$title', '$content')";
$result = $connection->query($query);
if ($result == true) {
    $response = array("added" => true);
    echo json_encode($response);
} else {
    $response = array("added" => false);
    echo json_encode($response);
}

$connection->close();
?>