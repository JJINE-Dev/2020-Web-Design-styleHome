<?php

namespace Controller;

use App\DB;

class UserController 
{
    // 회원가입
    public function register()
    {
        $_POST = ajaxValidation($_POST);
        extract($_POST);
        
        if(session()->get("captcha", true) != $captcha){
            returnJSON(["msg" => "자동입력방지 문자를 잘못 입력하였습니다.", "result" => false]);
        }

        $user = DB::fetch("SELECT * FROM users WHERE id = ?", array($id));
        if($user){
            returnJSON(["msg" => "중복되는 아이디입니다. 다른 아이디를 사용해주세요.", "result" => false]);
        }

        $img = upload($_FILES['img']);
        DB::execute("INSERT INTO users (id, password, name, img) VALUE (?, ?, ?, ?)", array($id, $password, $name, $img));
        returnJSON(["msg" => "회원가입 하셨습니다.", "result" => true]);
    }

    // 로그인
    public function login()
    {
        $_POST = ajaxValidation($_POST);
        extract($_POST);
        $user = DB::fetch("SELECT * FROM users WHERE id = ? AND password = ?", array($id, $password));
        if(!$user){
            returnJSON(["msg" => "아이디 또는 비밀번호가 일치하지 않습니다.", "result" => false]);
        }

        session()->set("user", $user);
        returnJSON(["msg" => "로그인 하셨습니다.", "result" => true]);
    }

    // 로그아웃
    public function logout()
    {
        session()->remove("user");
        redirect("/", "로그아웃 하셨습니다.");
    }
}