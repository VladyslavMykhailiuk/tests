<?php
require 'cors.php';
require 'Database.php';
$obj = new Database();
$post = $obj->query("SELECT * FROM posts WHERE id=1");
echo json_encode($post);
