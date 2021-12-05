
<style>

    .house {
        margin-bottom: 30px;
        display: flex;
    }

    .house .img {
        width: 320px;
        height: 250px;
        object-fit: cover;
        position: relative;
        overflow: hidden;
    }

    .house .img::after {
        content: '마우스를 올리면 after 사진이 보여집니다.';
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 12px;
        color: white;
        background-color: rgba(0, 0, 0, .7);
    }

    .house .img:hover::after {
        display: none;
    }

    .img img:nth-child(1) {
        left: 0;
    }

    .img img:nth-child(2) {
        left: 100%;
    }

    .img:hover img:nth-child(1) {
        left: -100%;
    }

    .img:hover img:nth-child(2) {
        left: 0;
    }

    .img img {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: left .5s;
    }

    .info {
        width: 58%;
        margin-left: 15px;
    }

    svg {
        width: 30px;
        height: 30px;
        user-select: none;
    }

    .start.active {
        color: #aaa;
    }

</style>

<div class="container mt-5">
    <button class="popupBtn mb-5 d-flex btn btn-primary" data-type="write">글쓰기</button>
<div class="houses">
    <?php foreach ($houses as $key => $house) { ?>
    <div class="house">
        <div class="img">
            <img src="/uploads/<?= $house->before ?>" alt="<?= explode('_', $house->before)[1] ?>" title="<?= explode('_', $house->before)[1] ?>">
            <img src="/uploads/<?= $house->after ?>" alt="<?= explode('_', $house->after)[1] ?>" title="<?= explode('_', $house->after)[1] ?>">
        </div>
        <div class="info">
            <div class="user"><?= $house->name ?>(<?= $house->id ?>)</div>
            <div class="knowhow"><?= $house->knowhow ?></div>
            <?php if ($house->grade != 0) { ?>
            <?php for ($i = 1; $i <= $house->grade; $i++) { ?>
                <i class="fa fa-star"></i>
        <?php } ?>
        <?php } else { ?>
        <div>
        평점 : 0
        </div>
            <?php } ?>
            <?php if(user()->idx != $house->user_idx && !$house->check) { ?>
            <div class="popupBtn btn btn-primary score_add_btn" data-target="#score_popup" data-toggle='modal' data-type="house_grade" data-idx="<?= $house->hidx ?>">평점주기</div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    </div>


    <div class="popup write">
        <div class="write">
            <form action="/house/insert" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="file" name="before" accept="image/*" class="form-control">
                </div>
                <div class="form-group">
                    <input type="file" name="after" accept="image/*" class="form-control">
                </div>
                <div class="form-group">
                    <textarea name="knowhow" id="knowhow" cols="30" rows="10" placeholder="노하우를 입력해주세요." class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="작성 완료" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <div class="popup house_grade">
        <div class="house_grade">
            <div class="grads d-flex">
                <div class="start" data-idx="1"><i class="fa fa-star"></i></div>
                <div class="start ml-2" data-idx="2"><i class="fa fa-star"></i></div>
                <div class="start ml-2" data-idx="3"><i class="fa fa-star"></i></div>
                <div class="start ml-2" data-idx="4"><i class="fa fa-star"></i></div>
                <div class="start ml-2" data-idx="5"><i class="fa fa-star"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="score_popup">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">스코어</h4>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <button class="score_send_btn" data-id="1">1</button>
                <button class="score_send_btn" data-id="2">2</button>
                <button class="score_send_btn" data-id="3">3</button>
                <button class="score_send_btn" data-id="4">4</button>
                <button class="score_send_btn" data-id="5">5</button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>


<script>

    document.querySelectorAll('.popupBtn').forEach(el => {
        el.addEventListener('click', openPopup);
    });

    function openPopup() {
        document.querySelector(`.popup.${event.target.dataset.type}`).classList.add('active');
        document.querySelector(`.popup.${event.target.dataset.type}`).dataset.idx = event.target.dataset.idx;
    }

    document.querySelectorAll('.grads i').forEach(el => {
        el.addEventListener('click', async (e) => {
            let popup = document.querySelector(`.popup.house_grade`);
            console.log(popup);
            await fetch("/house/grade/" + popup.dataset.idx + "/" + el.dataset.idx).then(r => r.json()).then((msg) => {
                alert(msg);
                popup.classList.remove('active');

                location.reload();
            });
        });
    });

    // // 지수 방식
    // let housing_id = null;

    // window.addEventListener("click",e=>{
    //     let id = e.target.id,target = e.target;
    //     if(target.classList.contains("score_add_btn")) housing_id = target.getAttribute("data-idx");
    //     if(target.classList.contains("score_send_btn")) score_send_proccess(target.getAttribute("data-id"));
    // });

    // function score_send_proccess(id){
    //     console.log(housing_id,id);
    // }

</script>