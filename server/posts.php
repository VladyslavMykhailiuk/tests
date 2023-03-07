<?php
//header("Content-Type: application/json; charset=UTF-8");
require 'cors.php';
require 'Database.php';
$obj = new Database();
$posts = $obj->query("SELECT * FROM posts");
echo json_encode($posts);



