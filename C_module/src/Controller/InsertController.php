<?php

namespace Controller;

use App\DB;

class InsertController 
{

    public function house()
    {
        $_POST = validation($_POST);
        extract($_POST);
        $before = upload($_FILES['before']);
        $after = upload($_FILES['after']);
        DB::execute("INSERT INTO houses (`before`, `after`, `knowhow`, user_idx, create_at) VALUES (?, ?, ?, ?, now())", array($before, $after, $knowhow, user()->idx));
        redirect("/houses", "글을 작성하셨습니다.");
    }

    public function grade($idx = 0, $value = 0)
    {
        $grade = DB::fetch("SELECT * FROM grades WHERE house_idx = ? AND user_idx = ?", array($idx, user()->idx));
        if($grade){
            returnJSON("해당 글의 평점은 이미 등록 하셨습니다.");
        }

        DB::execute("INSERT INTO grades (grade, house_idx, user_idx) VALUES (?, ?, ?)", array($value, $idx, user()->idx));
        returnJSON("해당 글의 평점을 등록 했습니다.");
    }

    public function review()
    {
        $_POST = validation($_POST);
        extract($_POST);
        DB::execute("INSERT INTO `reviews`(`price`, `content`, `grade`, `user_idx`, `specia_idx`) VALUES (?, ?, ?, ?, ?)", array($price, $content, $grade, user()->idx, $specia_idx));
        redirect("/specia", "시공 후기를 작성하셨습니다.");
    }

    public function req_quote()
    {
        $_POST = validation($_POST);
        extract($_POST);
        DB::execute("INSERT INTO req_quotes (content, date, user_idx) VALUES (?, now(), ?)", array($content, user()->idx));
        redirect("/quote", "시공 견적을 작성하셨습니다.");
    }

    public function resp_quote()
    {
        $_POST = validation($_POST);
        extract($_POST);
        DB::execute("INSERT INTO resp_quotes (price, req_idx, user_idx) VALUES (?, ?, ?)", array($price, $req_idx, user()->idx));
        redirect("/quote", "보낸 견적을 작성하셨습니다.");
    }
}