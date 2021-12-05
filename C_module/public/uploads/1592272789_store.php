        <section id="searchField">
            <form class="form-inline" onsubmit="return false">
                <div class="form-group mb-2 mr-2">
                    <input type="text" class="form-control ml-2" id="keyword" placeholder="검색어를 입력하세요">
                </div>
                <button type="button" id="searchBtn" class="btn btn-primary mb-2">검색</button>
            </form>
        </section>
        <section id="store">

            <div id="storelist">
                <div class="item">
                    <div class="item-img">
                        <div class="close">&times;</div>
                        <img src="/images/product/product_1.jpg" alt="img" title="img">
                    </div>
                    <div class="item-text">
                        <p>상품명 : </p>
                        <p>브랜드명 :</p>
                        <p>가격 : </p>
                        <div class="sell-info">
                            <label>수량</label>
                            <input type="number" class="cnt">
                            <p class="sum">222222</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropzone">
                <p>이곳에 상품을 넣어주세요</p>
            </div>
        </section>


        <section>
            <h2>장바구니</h2>
            <div id="basket">

            </div>
            <div class="info">
                <p>총합계 <span id="totalSum">0원</span></p>
                <button id="openBuy" class="btn btn-info">구매하기</button>
            </div>
        </section>
    </div>

    <div id="popup">
        <div class="inner">
            <div class="row">
                <div class="col-8 offset-2">
                    <form>
                        <div class="form-group">
                            <label for="name">구매자 이름</label>
                            <input type="text" class="form-control" id="name" placeholder="구매자 이름을 입력하세요">
                        </div>
                        <div class="form-group">
                            <label for="address">구매자 주소</label>
                            <input type="text" class="form-control" id="address" placeholder="주소를 입력하세요">
                        </div>
                        <button type="button" class="btn btn-primary" id="buyConfirm">구매확정</button>
                        <button type="button" class="btn btn-danger" id="buyCancel">취소</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div id="result">
        <div class="inner">
            <h2>구매내역</h2>
            <canvas id="resultCanvas"></canvas>
            <button id="closeResult" class="btn btn-warning">닫기</button>
        </div>
    </div>

    <script src="/js/App.js"></script>