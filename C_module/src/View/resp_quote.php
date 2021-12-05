<table border="1px">
    <thead>
        <tr>
            <td>회원정보</td>
            <td>시공일</td>
            <td>내용</td>
            <td>비용</td>
            <td>선택버튼</td>
        </tr>
    </thead>
    <tbody>
        
    <?php foreach ($quotes as $key => $quote) { ?>
        <tr>
            <td><?= $quote->name ?>(<?= $quote->id ?>)</td>
            <td><?= $quote->date ?></td>
            <td><?= $quote->content ?></td>
            <td><?= $quote->price ?></td>
            <td>
                <?php if($quote->rqstatus == 0) { ?>
                <button onClick="location.href='/quote/update/<?= $quote->resp_idx ?>'" class="btn btn-primary">선택</button>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>