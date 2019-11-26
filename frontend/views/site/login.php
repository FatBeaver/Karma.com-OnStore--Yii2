<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Вход  /  Регистрация</h1>
                <nav class="d-flex align-items-center">
                    <a href="<?=Url::to(['home/index'])?>">Главная<span class="lnr lnr-arrow-right"></span></a>
                    <a href="<?=Url::to(['site/login'])?>">Вход/Регистрация</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Login Box Area =================-->
<section class="login_box_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <img class="img-fluid" src="/img/login.jpg" alt="login">
                    <div class="hover sign-up-hover">
                        <h4>Впервые на данном сайте?</h4>
                        <p>Если вы впервые на данном сайте или же у вас
                            еще нет своего аккаунта, то вы можете создать его пройдя простейшую процедуру регистрации.</p>
                        <a class="primary-btn sign-up-button" href="#" >Регистрация</a>
                    </div>
                    <div class="login_form_inner sign-up-form">
                        <h3 style="color:#ddd;">Форма для регистрации</h3>
                        <form class="row login_form" action="<?=Url::to(['/site/sign-up'])?>" method="POST" id="SignUpForm" >
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control sign-up-name" id="SignUpUsername" 
                                    name="username" placeholder="Ваш логин" onfocus="this.placeholder = ''" 
                                    onblur="this.placeholder = 'Ваш логин'" >
                                    <div class="div-name"></div>
                            </div>

                            <div class="col-md-12 form-group ">
                                <input type="text" class="form-control sign-up-email" id="SignUpEmail" 
                                    name="email" placeholder="Ваш Email" onfocus="this.placeholder = ''" 
                                    onblur="this.placeholder = 'Email'" >
                                    <div class="div-email"></div>
                            </div>

                            <div class="col-md-12 form-group ">
                                <input type="password" class="form-control sign-up-password" id="SignUpPassword" 
                                    name="password" placeholder="Ваш пароль" onfocus="this.placeholder = ''" 
                                    onblur="this.placeholder = 'Ваш пароль'" style="border-radius" >
                                    <div class="div-password"></div>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="submit" value="Войти" name="submit" class="primary-btn sign-up-submit"></button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>Форма для входа на сайт</h3>
                    <form class="row login_form" action="<?=Url::to(['/site/login'])?>" method="POST" id="contactForm" >

                        <div class="col-md-12 form-group login-email">
                            <input type="text" class="form-control login-email-input" id="email" name="email" placeholder="Ваш Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                            <div class="div-email-login"></div>
                        </div>

                        <div class="col-md-12 form-group login-password">
                            <input type="password" class="form-control login-password-input" id="password" name="password" placeholder="Ваш пароль" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                            <div class="div-password-login"></div>
                        </div>

                        <div class="col-md-12 form-group login-remember">
                            <div class="creat_account">
                                <input type="checkbox" id="f-option2" name="rememberMe" value="1">
                                <label for="f-option2">Запомнить меня</label>
                            </div>
                        </div>

                        <div class="col-md-12 form-group div-login-submit">
                            <input type="submit" value="Войти" name="loginSubmit" class="primary-btn login-submit">
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<!--================End Login Box Area =================-->
