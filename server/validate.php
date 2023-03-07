<?php
require 'cors.php';
require 'Database.php';
$obj = new Database();
$out = array('title'=>false,'annotation'=>false,'content'=>false,'email'=>false,'views'=>false,'date'=>false,'publish'=>false,'category'=>false,'checkedTitle'=>false,'success'=>false);
if($_SERVER['REQUEST_METHOD']== 'POST'){
    if(isset($_POST['title']) && (mb_strlen($_POST['title'])<3 || mb_strlen($_POST['title'])>255)) {
        $out['title'] = true;
        $out['message'] = 'Заголовок повинен бути не менше трьох та не більше 255 символів.';
    }
    elseif ( mb_strlen($_POST['annotation'])<30 ||mb_strlen($_POST['annotation'])>500){
        $out['annotation'] = true;
        $out['message'] = 'Анотація не повинна перевищувати 500 символів та мати менше ніж 30 символів.';
    }
    elseif (mb_strlen($_POST['content'])<100 || mb_strlen($_POST['content'])>30000){
        $out['content'] = true;
        $out['message'] = 'Контент не повинен перевищувати 30000 символів та мати не менше ніж 100 символів.';
    }
    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $out['email'] = true;
        $out['message'] = 'Вказано невірний формат e-mail.';
    }
    elseif (!filter_var($_POST['views'], FILTER_VALIDATE_INT) || $_POST['views']<0){
        $out['views'] = true;
        $out['message'] = 'Ви невірно вказали перегляди.';
    }
    elseif ($_POST['date'] !== date('Y-m-d')){
        $out['date']= true;
        $out['message'] = 'Ви вказали не поточну дату.';
    }

    elseif (empty($_POST['category'])){
        $out['category'] = true;
        $out['message'] = 'Оберіть один із параметрів.';
    }
    else {
        $title = $_POST['title'];
        $annotation = $_POST['annotation'];
        $content = $_POST['content'];
        $email = $_POST['email'];
        $views = $_POST['views'];
        $date = $_POST['date'];
        $publish_in_index = $_POST['publish_in_index'];
        $category = $_POST['category'];
        $checkTitle = $obj->query("SELECT * FROM posts WHERE title = '$title'");
        if($checkTitle){
            $out['checkedTitle'] = true;
            $out['message'] = 'Пост з такою назвою вже існує. Спробуйте іншу';
        }
        else {
            $out['success'] = true;
            $obj->execute("INSERT INTO posts (title,annotation,content,email,views,date,publish_in_index,category_id) VALUES ('$title','$annotation','$content','$email',$views,'$date',$publish_in_index,'$category')");
        }
    }
}

header("Content-type: application/json");
echo json_encode($out);
die();




