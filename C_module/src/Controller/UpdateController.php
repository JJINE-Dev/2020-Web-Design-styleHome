<?php

namespace Controller;

use App\DB;

class UpdateController 
{
    // 견적 요청 선택
    public function quote($idx = 0)
    {
        $resp_quote = DB::fetch("SELECT * FROM resp_quotes WHERE idx = ?", array($idx));
        DB::execute("UPDATE resp_quotes SET status = 1 WHERE req_idx = ?", array($resp_quote->req_idx));
        DB::execute("UPDATE resp_quotes SET status = 2 WHERE idx = ?", array($resp_quote->idx));
        DB::execute("UPDATE req_quotes SET status = 1 WHERE idx = ?", array($resp_quote->req_idx));
        redirect("/quote", "해당 견적이 선택되었습니다.");
    }
}