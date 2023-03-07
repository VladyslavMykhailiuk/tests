<?php
require 'cors.php';
require 'Database.php';
$obj = new Database();

$out = array('email'=>false,'login'=>false,'city'=>false,'email'=>false,'sex'=>false,'phone'=>false,'password'=>false,'confirmPassword'=>false,'success'=>false,'checkedEmail'=>false,'checkedLogin'=>false);
if($_SERVER['REQUEST_METHOD']== 'POST'){
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $out['email'] = true;
        $out['message'] = 'Вказано невірний формат e-mail.';
    }

    elseif(isset($_POST['login']) && (mb_strlen($_POST['login'])<5 || mb_strlen($_POST['login'])>15)) {
        $out['login'] = true;
        $out['message'] = 'Логін повинен бути не менше 3 та не більше 15 символів.';
    }

    elseif (isset($_POST['city']) && (mb_strlen($_POST['city'])<3 || is_numeric($_POST['city']))){
        $out['city'] = true;
        $out['message'] = 'Ви невірно вказали місто.';
    }
    elseif (empty($_POST['sex'])){
        $out['sex'] = true;
        $out['message'] = 'Оберіть один із параметрів.';
    }

    elseif (isset($_POST['phone']) && !preg_match("/^\+380\d{3}\d{2}\d{2}\d{2}$/", $_POST['phone'])){
        $out['phone'] = true;
        $out['message'] = 'Неправильно ввели номер телефону.';
    }
    elseif (isset($_POST['password']) &&  mb_strlen($_POST['password'])<5 || mb_strlen($_POST['password'])>25){
        $out['password'] = true;
        $out['message'] = 'Пароль не повинен перевищувати 25 символів та мати не менше ніж 5 символів.';
    }
    elseif (isset($_POST['confirmPassword']) && $_POST['confirmPassword'] !== $_POST['password']){
        $out['confirmPassword'] = true;
        $out['message'] = 'Пароль не співпадають.';
    }
    else {
        $email = $_POST['email'];
        $login = $_POST['login'];
        $city = $_POST['city'];
        $sex = $_POST['sex'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $checkEmail = $obj->query("SELECT * FROM users WHERE email = '$email'");
        $checkLogin = $obj->query("SELECT * FROM users WHERE login = '$login'");
        if($checkEmail){
            $out['checkedEmail'] = true;
            $out['message'] = 'Користувач з таким email вже існує. Спробуйте інший';
        }
        elseif ($checkLogin){
            $out['checkedLogin'] = true;
            $out['message'] = 'Користувач з таким логіном вже існує. Спробуйте інший';
        }
        else {
            $out['success'] = true;
            $obj->execute("INSERT INTO users (email,login,city,sex_id,phone,password) VALUES ('$email','$login','$city',$sex,'$phone','$password')");
//            $_SESSION['authenticated'] = true;
        }
    }
}

header("Content-type: application/json");
echo json_encode($out);
die();

