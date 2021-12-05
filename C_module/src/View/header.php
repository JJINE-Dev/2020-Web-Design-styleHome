<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>내집꾸미기</title>
    <script src="./resources/jquery-3.4.1.min.js"></script>
    <script src="./resources/bootstrap-4.3.1-dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="./resources/css/style.css">
    <link rel="stylesheet" href="./resources/css/store.css">
    <link rel="stylesheet" href="./resources/css/app.css">
    <link rel="stylesheet" href="./resources/fontawesome/css/font-awesome.css">
    <link rel="stylesheet" href="./resources/bootstrap-4.3.1-dist/css/bootstrap.css">
    <script src="./resources/js/App.js"></script>
    
</head>
<body>
    <?php if(session()->has("msg")) { ?>
        <script>
            alert('<?= session()->get("msg") ?>');
        </script>
    <?php } else if(session()->has("error")) { ?>
        <script>
            alert('<?= session()->get("error") ?>');
        </script>
    <?php } ?>

    <div class="popup register">
            <div class="write">
                <form enctype="multipart/form-data" id="registerForm">

                    <div class="form-group">
                        <input type="text" name="id" id="id" placeholder="아이디를 입력해주세요." class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" placeholder="비밀번호를 입력해주세요." class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" id="name" placeholder="이름을 입력해주세요." class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="file" name="img" class="form-control">
                    </div>


                    <div class="form-group">
                        <img src="/captcha" alt="captcha" title="captcha">
                        <input type="text" name="captcha" id="captcha" class="form-control" placeholder="캡차입력">
                    </div>

                    <input type="button" value="회원가입" class="btn btn-primary registerBtn" onclick="register();">
                </form>
            </div>
        </div>

        <div class="popup login">
            <div class="write">
                <form id="loginForm">
                    <div class="form-group">
                        <input type="text" name="id" id="id" placeholder="아이디를 입력해주세요." class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" placeholder="비밀번호를 입력해주세요." class="form-control">
                    </div>
                    <input type="button" value="로그인" class="btn btn-primary" onclick="login();">
                </form>
            </div>
        </div>
    <div class="con">
        <!--header-->   
          <!--서브 헤더-->
    <div class="etc-header">
        <div class="container d-flex justify-content-end user-menu">
        <?php if (user()) { ?>
                <span><?= "&lt;" . user()->name . "&gt;" ?>(<?= "&lt;" . user()->id . "&gt;" ?>)</span>
                <a href="/user/logout" class=" btn-sm">로그아웃</a>
            <?php } else { ?>
                <a href="#" class="btn-sm user_button" data-type="login">로그인</a>
                <a href="#" class="btn-sm user_button" data-type="register">회원가입</a>
            <?php } ?>
        </div>
    </div>
    <!--메인 헤더-->

    <header>
        <div class="main_480 main_480_menu" id="main_480_menu">
            <i class="fa fa-bars main_480_menu"></i>
        </div>
        <div id="logo" class="mt-4">
            <img src="./resources/image/logo.png" title="logo" alt="logo">
        </div>
        
        <!-- 네비게이션 -->
        <nav >
            <ul>
                <li><a class="py-2 " href="/">홈</a></li>
                <li><a class="py-2 " href="/houses">온라인 집들이</a></li>
                <li><a class="py-2 " href="/store">스토어</a></li>
                <li><a class="py-2 " href="/specia">전문가</a></li>
                <li><a class="py-2 " href="/quote">시공 견적</a></li>
                <li><i class="fa fa-shopping-cart"></i></li>
                <li><i class="fa fa-search"></i></li> 
                <li><i class="fa fa-user"></i></li>
            </ul>
        </nav>
    </header>

    <div id="visual-c">
        <input type="radio" name="slide" id="slide-1" hidden checked>
        <input type="radio" name="slide" id="slide-2" hidden>
        <input type="radio" name="slide" id="slide-3" hidden>
        <input type="radio" name="slide" id="slide-4" hidden>
        <div id="visual">
            <div class="container">
                <div class="visual-text">
                    <img src="./resources/image/visual2.png" alt="메인" title="메인">
                    <br>
                    <button class="lt-btn">&lt;</button>
                    <button class="rt-btn ml-5">&gt;</button>      
                </div>
            </div>
            <div class="img">
                <img src="./resources/image/slide1.jpg" alt="슬라이드 이미지" title="슬라이드 이미지">
                <img src="./resources/image/slide2.jpg" alt="슬라이드 이미지" title="슬라이드 이미지">
                <img src="./resources/image/slide3.jpg" alt="슬라이드 이미지" title="슬라이드 이미지">
            </div>
            <div class="link">
                더 자세히 알아보기
            </div>
           
        </div>
    </div>
    </div>

    <script>
        document.querySelectorAll('.user_button').forEach(el => {
            el.addEventListener('click', openUserPopup);
        });

        function openUserPopup() {
            document.querySelector(`.popup.${event.target.dataset.type}`).classList.add('active');
        }

        function login() {
            let form = document.querySelector('#loginForm');
            let data = new FormData(form);
            $.ajax({
                url:'/user/login',
                type:'post',
                data: data,
                contentType:false,
                processData:false,
                success: data => {
                    console.log(data);
                    data = JSON.parse(data);
                    alert(data.msg);
                    if(data.result){
                        location.reload();
                    }
                }
            });
        }
        function register() {
            let form = document.querySelector('#registerForm');
            let data = new FormData(form);
            console.log(data.get("id"));
            $.ajax({
                enctype: 'multipart/form-data',
                url:'/user/register',
                type:'post',
                data: data,
                contentType:false,
                processData:false,
                success: data => {
                    console.log(data);
                    data = JSON.parse(data);
                    alert(data.msg);
                    if(data.result){
                        location.reload();
                    }
                }
            });
        }
    </script>