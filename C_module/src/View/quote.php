<div class="container mt-5">
    <button class="popupBtn btn-primary btn" data-type="write">견적 요청</button>
    <div class="popup write">
        <div class="write">
            <form action="/req_quote/insert" method="post">
                <div class="form-group">
                    <input type="date" name="date" class="form-control">
                </div>
                <div class="form-group">
                    <textarea name="content" id="content" cols="30" rows="10" placeholder="내용을 입력해주세요." class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="작성 완료" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <div class="popup update">
        <div class="write">
            <form action="/resp_quote/insert" method="post">
                <div class="form-group">
                    <input type="number" name="price" placeholder="비용을 입력해주세요." class="form-control">
                </div>
                <div class="form-group">
                    <input type="hidden" name="req_idx" id="req_idx" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="입력 완료" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <h1 style="margin-top: 3rem"><b>시공 견적 요청 리스트</b></h1>
    <div class="constList" style="margin-top: 3rem">
    <table class="table table-striped">
        <thead>
            <tr>
                <td>회원정보</td>
                <td>시공일</td>
                <td>내용</td>
                <td>상태</td>
                <td>견적개수</td>
                <td>버튼</td>
            </tr>
        </thead>
        <tbody>
        
        <?php foreach ($req_quotes as $key => $quote) { ?>
            <tr>
            <?php var_dump(4353)?>
                <td><?= $quote->name ?>(<?= $quote->id ?>)</td>
                <td><?= $quote->date ?></td>
                <td><?= $quote->content ?></td>
                <td><?= $quote->status == 0 ? '진행 중' : '완료' ?></td>
                <td><?= $quote->cnt ?></td>
                <td>
                    <?php if($quote->status == 0 && user()->specia && !$quote->check) :?>
                        <button class="popupBtn btn btn-primary" data-type="update" data-idx="<?= $quote->rqidx ?>">견적 보내기</button>
                    <?php endif ; ?>
                    <?php if($quote->id == user()->id) { ?>
                        <button onClick="location.href='/quote/<?= $quote->rqidx ?>'" class="btn btn-primary">견적 보기</button>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    
    <?php if(user()->specia == 1):?>
    <h1 style="margin-top: 3rem"><b>보낸 견적 리스트</b></h1>
    <div class="constList" style="margin-top: 3rem">
        <table class="table table-striped">
        <thead>
            <tr>
                <th>회원정보</th>
                <th>시공일</th>
                <th>내용</th>
                <th>입력한 비용</th>
                <th>상태</th>
            </tr>
        </thead>
        <tbody>
            
        <?php foreach ($resp_quotes as $key => $quote) { ?>
            <tr>
                <td><?= $quote->name ?>(<?= $quote->id ?>)</td>
                <td><?= $quote->date ?></td>
                <td><?= $quote->content ?></td>
                <td><?= $quote->price ?></td>
                <?php if($quote->rpstatus == 0) { ?>
                    <td>진행 중</td>
                <?php } else if($quote->rpstatus == 1) { ?>
                    <td>미선택</td>
                <?php } else if($quote->rpstatus == 2) { ?>
                    <td>선택</td>
                <?php } ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
                <?php endif;?>
                </div>


<script>

    document.querySelectorAll('.popupBtn').forEach(el => {
        el.addEventListener('click', openPopup);
    });

    function openPopup() {
        document.querySelector(`.popup.${event.target.dataset.type}`).classList.add('active');
        req_idx.value = event.target.dataset.idx;
    }
    

</script>