<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>AmazingFun</title>
    <link href="/resources/assets/images/favicon.ico" rel="icon" type="image/x-icon"/>
    <link rel="stylesheet" href="/resources/assets/css/home/bootstrap.min.css"/>
    <link rel="stylesheet" href="/resources/assets/css/home/swiper-3.4.0.min.css"/>
    <link rel="stylesheet" href="/resources/assets/css/home/normalize.css"/>
    <link rel="stylesheet" href="/resources/assets/css/home/main.css"/>
</head>
<body>
<!--<div class="header navbar-fixed-top">-->
<div class="nav-header navbar-fixed-top">
    <div class="container">
        <h2 class="logo">
            <a class="logo-link" href="/" id="header-logo-lnk">
                <img src="/resources/assets/images/logo2.png"
                     alt="AmazingFun" class="hidden_mobile logo-image">
                <img src="/resources/assets/images/logo3.png"
                     alt="AmazingFun" class="hidden_desktop logo-image">
            </a>
        </h2>

        <nav class="main-nav" role="navigation">
            <div class="nav-mobile">
                <button class="navbar-toggle">
                    <span class="sr-only"></span>
                    <span class="icon-bar-wrapper">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </span>
                </button>
                <div class="country-selector dropdown country-selector-mobile" data-countryflag=""></div>
            </div>
            <ul id="navbar-collapse" class="nav collapse">
                <li class="nav-item nav-account">
                    <button class="nav-link my-account-lnk hidden" data-toggle="collapse" id="header-my-account-link"
                            data-target="#dropdown-account" data-parent="#navbar-collapse"
                            aria-controls="dropdown-account" role="button" aria-expanded="true">我的账户
                        <i class="glyphicon glyphicon-triangle-bottom"></i>
                        <i class="glyphicon glyphicon-triangle-top"></i>
                        <i class="glyphicon glyphicon-triangle-right"></i>
                    </button>
                    <ul class="dropdown-account collapse" id="dropdown-account" aria-expanded="false">
                        <li class="dropdown-item">
                            <a href="＃" id="header-manage-account-link" class="dropdown-link">帐户管理</a>
                        </li>
                        <li class="dropdown-item">
                            <a href="javascript:;" id="logout" class="dropdown-link">退出登录</a>
                        </li>
                    </ul>
                    <a class="nav-link login-lnk loginbtn" id="header-log-in-modal-link" data-toggle="modal"
                       data-target="#loginmodal" href="#">登录／注册</a>
                </li>
                <li class="nav-item">
                    <button class="nav-link collapsed" data-toggle="collapse" id="header-pick-a-crate-link"
                            data-target="#dropdown-pick-crate" data-parent="#navbar-collapse"
                            aria-controls="dropdown-pick-crate" role="button" aria-expanded="false">订阅妹子
                        <i class="glyphicon glyphicon-triangle-bottom"></i>
                        <i class="glyphicon glyphicon-triangle-top"></i>
                        <i class="glyphicon glyphicon-triangle-right"></i>
                    </button>
                    <div class="pick-crate collapse" id="dropdown-pick-crate" aria-expanded="false">
                        <!--<div class="container">-->

                        <section class="dropdown-section dropdown-collapsed">
                            <h3 class="dropdown-hdr ">
                                <a href="/product?product=AmazingFun&price=188">AmazingFun</a><i class="fa fa-caret-down fa-lg"></i><i
                                        class="fa fa-caret-right fa-lg"></i>
                            </h3>

                        </section>
                        <section class="dropdown-section dropdown-collapsed">
                            <h3 class="dropdown-hdr "><a href="/product?product=AmazingFunDX&price=499">AmazingFunDX</a><i
                                        class="fa fa-caret-down fa-lg"></i><i
                                        class="fa fa-caret-right fa-lg"></i>
                            </h3>

                        </section>
                        <section class="dropdown-section dropdown-collapsed">
                            <h3 class="dropdown-hdr "><a href="/product?product=AmazingFun&price=109">AmazingFunMIN</a><i
                                        class="fa fa-caret-down fa-lg"></i><i
                                        class="fa fa-caret-right fa-lg"></i>
                            </h3>

                        </section>

                        <!--</div>-->
                    </div>
                </li>
                <li class="nav-item  ">
                    <a href="/past" class="nav-link">往期回顾</a>
                </li>
                <li class="nav-item ">
                    <a href="/gift" id="header-gift-link" class="nav-link">订购礼物</a>
                </li>
                <li class="nav-item ">
                    <a href="/Personal" id="header-loot-vault-link" class="nav-link" target="_blank">私人定制</a>
                </li>
                <li class="nav-item login" id="login">
                    <button type="button" class="loginbtn " data-toggle="modal" data-target="#loginmodal">登录/注册</button>
                    <div class="dropdown hidden" id="loginaccount">
                        <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">我的帐户<span class="caret"></span></button>
                        <ul class="dropdown-menu pull-left" aria-labelledby="dLabel">
                            <li class=""><a href="">管理帐户</a></li>
                            <li class=""><a href="javascript:;" id="loginout">退出登录</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>

</div>