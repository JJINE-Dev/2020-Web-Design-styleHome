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
                        <button type="button" class="btn btn-light" id="buyConfirm">구매확정</button>
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
    <div class="drop-zone">
        <p>
            <i class="fa fa-shopping-cart mb-3"></i>
            <br>이곳에 상품을 넣어주세요.
        </p>
    </div>
<div class="container mt-5">
            <div class="store-heading-text">
                <h3 class="mb-5"><b>내집꾸미기 장바구니</b></h3>
            </div>
            <div class=".cart-table">
            </div>
            <table class="cart-table">
                <caption>장바구니 목록</caption>
                <div class="cart-list"></div>
                <!-- <colgroup>
                    <col width="50px">
                    <col width="100px">
                    <col>
                    <col width="160px">
                    <col width="80px"> 
                    <col width="200px">
                    <col width="200px">
                </colgroup> -->
                <!-- <thead>
                    <tr class="blue">
                        <th>
                            <input type="checkbox" name="chk" onclick="">
                        </th>
                        <th colspan="2">상품정보</th>
                        <th>판매가격</th>
                        <th>수량</th>
                        <th>쿠폰</th>
                        <th>배송비</th>
                        <th></th>
                    </tr>
                </thead> -->
                <!-- <tbody>
                    <tr id="item">
                        <td><input type="checkbox" name="chk" onclick=""></td>
                        <td>
                            <img src="/B_Module/resources/store/상품사진/product_1.jpg" alt="" title="">
                        </td>
                        <td><span class="brand mr-2">[마틸다]</span>마틸다</td>
                        <td>17,100원</td>
                        <td>
                            <div class="sell-info">
                                <input type="number" class="cnt w-75" value="1" min="1">
                                <p class=".sum">17,100원</p> 
                            </div>
                        </td>
                        <td>
                            <div class="coupon">
                                <span>20% 할인</span>
                                <br>
                                <span>쿠폰다운 <i class="fa fa-download"></i></span>
                            </div>
                        </td>
                        <td>
                            <span>주문하기</span>
                            <br>
                            <span id="del-btn">삭제</span>
                        </td>
                    </tr>
                </tbody> -->
                <tfoot>
                    <tr>
                        <td colspan="8" id="pr-box" value=""> 
                            <span id="sum-Pr">1</span>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="button-box">
                <div class="field-box">
                    <div class="box-left">
                        <input type="checkbox" id="allSe" name="allSe" onclick="">
                        <label for="allSel"><b>전체선택</b></label>
                        <span><a href="#" class="btn btn-secondary">전체삭제</a></span>
                        <span><a href="#" class="btn btn-secondary">품질 상품 삭제</a></span>
                    </div>
                    <div class="box-right">
                        <p>
                            <a href="#" class="btn btn-secondary">계속 쇼핑하기</a>
                            <a href="#" class="btn btn-secondary" id="open-buy">구매하기</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="banner">
                <div class="img">
                    <img src="" alt="">
                </div>
                <div class="banner-text">
                    <p><span>2020</span>INTERIOR</p>
                </div>
            </div>
            <div class="list-nav">
                <p>오름차순</p>
                <p>내림차순</p>
                <div id="search-box">
                    <div class="search-group">
                        <input type="text" class="form-control" id="keyword" placeholder="검색어를 입력하세요">
                    </div>
                    <button type="button" id="search-btn" class="btn btn-primary" ><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div id="list">
                <div class="list-lt">
                    <div class="category">
                        <h3><b><span class="orange">C</span>ategory</b></h3>
                        <p class="mt-5">ALL</p>
                        <hr>
                        <p>가구</p>
                        <hr>
                        <p>휴대폰</p>
                        <hr>
                        <p></p>
                        <h3><b><span class="orange">C</span>olor</b></h3>
                    </div>
                    <div class="color">
                        <div class="1"></div>
                        <div class="2"></div>
                    </div>
                </div>
                <div class="list-rg">
                    <div class="list-container">
                        <div class="list-box">

                            <!-- <div class="img">
                                <img src="" alt="" title="">
                            </div>
                            <div class="text-box">
                                <p class="brand">마틸다</p>
                                <p class="brand-title">마틸라</p>
                                <p class="brand-pr"><b>17,100원</b></p>
                            </div> -->
                        </div>
                        <div class="list-box">
                            <div class="img">
                                <img src="" alt="" title="">
                            </div>
                            <div class="text-box">
                                <p class="brand">마틸다</p>
                                <p class="brand-title">마틸라</p>
                                <p class="brand-pr"><b>17,100원</b></p>
                            </div>
                        </div>
                        <div class="list-box">
                            <div class="img">
                                <img src="" alt="" title="">
                            </div>
                            <div class="text-box">
                                <p class="brand">마틸다</p>
                                <p class="brand-title">마틸라</p>
                                <p class="brand-pr"><b>17,100원</b></p>
                            </div>
                        </div>
                        <div class="list-box">
                            <div class="img">
                                <img src="" alt="" title="">
                            </div>
                            <div class="text-box">
                                <p class="brand">마틸다</p>
                                <p class="brand-title">마틸라</p>
                                <p class="brand-pr"><b>17,100원</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
</div>