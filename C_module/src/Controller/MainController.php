<?php

namespace Controller;

use App\DB;

class MainController {
    public function index() {
        view("index");
    }

    public function login()
    {
        view("user/login");
    }

    public function register()
    {
        view("user/register");
    }

    public function houses()
    {
        $datas['houses'] = DB::fetchAll("SELECT *, ifnull((SELECT truncate(sum(g.grade) / count(*), 0) FROM grades g WHERE g.house_idx = h.idx), 0) grade, h.idx hidx FROM houses h JOIN users u ON h.user_idx = u.idx");
        foreach ($datas['houses'] as $key => $house) {
            $house->check = DB::fetch("SELECT * FROM grades WHERE house_idx = ? AND user_idx = ?", array($house->hidx, user()->idx));
        }
        view("houses", $datas);
    }

    public function store()
    {
        view("store");
    }

    public function specia()
    {
        $datas['users'] = DB::fetchAll("SELECT *, ifnull((SELECT truncate(sum(r.grade) / count(*), 0) FROM reviews r WHERE r.specia_idx = u.idx), 0) grade FROM users u WHERE u.specia = true");
        $datas['constList'] = DB::fetchAll("SELECT r.*, u.id user_id, u.name user_name, s.id specia_id, s.name specia_name FROM reviews r JOIN users u JOIN users s  ON r.user_idx = u.idx AND r.specia_idx = s.idx");
        view("specia", $datas);
    }

    public function quote()
    {
        $datas['req_quotes'] = DB::fetchAll("SELECT *, (SELECT count(*) FROM resp_quotes rp WHERE rp.req_idx = rq.idx) cnt, rq.idx rqidx FROM req_quotes rq JOIN users u ON rq.user_idx = u.idx");
        foreach ($datas['req_quotes'] as $key => $quote) {
            $quote->check = DB::fetch("SELECT * FROM resp_quotes WHERE req_idx = ? AND user_idx = ?", array($quote->rqidx, user()->idx));
        }
        $datas['resp_quotes'] = DB::fetchAll("SELECT *, rq.idx rqidx, rp.status rpstatus FROM resp_quotes rp JOIN req_quotes rq JOIN users u ON rp.req_idx = rq.idx AND rq.user_idx = u.idx");
        view("quote", $datas);
    }

    public function resp_quote($idx = 0)
    {
        $datas['quotes'] = DB::fetchAll("SELECT *, rq.status rqstatus, rp.idx resp_idx FROM req_quotes rq JOIN resp_quotes rp JOIN users u ON rq.idx = rp.req_idx AND u.idx = rp.user_idx WHERE rq.idx = ?", array($idx));
        view('resp_quote', $datas);
    }

    public static function init()
    {
        //미리 데이터 넣어두기
        if(DB::fetch("show table status like 'users'")->Auto_increment == 1){
            DB::execute("INSERT INTO users (id, password, name, img) VALUES (?, ?, ?, ?)", array("specialist1", "1234", "전문가1", "specialist1.jpg"));
            DB::execute("INSERT INTO users (id, password, name, img) VALUES (?, ?, ?, ?)", array("specialist2", "1234", "전문가2", "specialist2.jpg"));
            DB::execute("INSERT INTO users (id, password, name, img) VALUES (?, ?, ?, ?)", array("specialist3", "1234", "전문가3", "specialist3.jpg"));
            DB::execute("INSERT INTO users (id, password, name, img) VALUES (?, ?, ?, ?)", array("specialist4", "1234", "전문가4", "specialist4.jpg"));
        }
    }

    public function captcha()
    {
        $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHJIKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < 5; $i++) {
            $code .= $str[rand(0, strlen($str) - 1)];
        }
        session()->set("captcha", $code);

        $im = imagecreatetruecolor(100, 80);
        $bg = imagecolorallocate($im, 22, 86, 165); 
        $fg = imagecolorallocate($im, 255, 255, 255); 
        imagefill($im, 0, 0, $bg);
        imagestring($im, 5, 28, 30, $code, $fg);
        header('Content-type: image/png');
        imagepng($im);
        imagedestroy($im);
    }
}
