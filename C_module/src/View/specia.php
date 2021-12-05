<div class="container">
    <h1 class="mt-5"><b>전문가 리스트</b></h1>
    <div class="specialist mt-5 d-flex justify-content-between" style="display:flex;">
        <?php foreach ($users as $key => $user) { ?>
            <div class="specia card mr-2 ml-2" style="width: 18rem;">
                <div class="img">
                    <img src="/uploads/<?= $user->img ?>" alt="<?= $user->name ?>" title="<?= $user->name ?>" class="img-thumbnail">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $user->name ?><br><?= $user->id ?></h5>
                    <p class="card-text">
                        <?php if ($user->grade != 0) { ?>
                            평점 :
                            <?php for ($i = 0; $i < $user->grade; $i++) { ?>
                                <i class="fa fa-star"></i>
                            <?php } ?>
                        <?php } else { ?>
                            평점 : 없음
                        <?php } ?>
                    </p>
                    <div class="popupBtn btn btn-primary " data-type="write" data-idx="<?= $user->idx ?>">시공 후기 작성</div>
                </div>
            </div>
        <?php } ?>
    </div>

    <h1 class="mt-5"><b>시공 후기 리스트</b></h1>
    <div class="constList" style="margin-top: 3rem">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">전문가</th>
                    <th scope="col">작성자</th>
                    <th scope="col">비용</th>
                    <th scope="col">내용</th>
                    <th scope="col">평점</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($constList as $key => $const) { ?>
                    <tr>
                        <th scope="row"><?= $const->specia_name ?>(<?= $const->specia_id ?>)</th>
                        <td><?= $const->user_name ?>(<?= $const->user_id ?>)</td>
                        <td><?= $const->price ?></td>
                        <td><?= $const->content ?></td>
                        <td>
                            <?php for ($i = 0; $i < $const->grade; $i++) { ?>
                                <i class="fa fa-star"></i>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    svg {
        width: 30px;
        height: 30px;
        user-select: none;
    }

    svg.active {
        color: red;
    }
</style>

<div class="popup write">
    <div class="write">
        <form action="/review/insert" method="post">
            <div class="form-group">
                <input type="number" name="price" placeholder="비용을 입력해주세요." class="form-control">
            </div>
            <div class="form-group">
                <textarea name="content" id="content" cols="30" rows="10" placeholder="내용을 입력해주세요." class="form-control"></textarea>
            </div>
            <input type="hidden" name="specia_idx" id="specia_idx">
            <div class="form-group">
                <input type="number" name="grade" id="grade" min="1" max="5" placeholder="평점을 입력해주세요." class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="작성 완료" onclick="return checkForm();" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('.popupBtn').forEach(el => {
        el.addEventListener('click', openPopup);
    });

    function openPopup() {
        document.querySelector(`.popup.${event.target.dataset.type}`).classList.add('active');
        specia_idx.value = event.target.dataset.idx;
    }

    function checkForm() {
        if (grade.value < 1) {
            alert('평점은 1부터5 까지만 입력가능합니다.');
            return false;
        }
    }
</script>