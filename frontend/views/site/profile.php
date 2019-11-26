<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Редактирование профиля</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.html">Главная<span class="lnr lnr-arrow-right"></span></a>
                    <a href="single-product.html">Страница редактирования профиля</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3 style="font-size:32px !important;">Данные вашего профиля</h3>
                    <form class="row contact_form" action="<?=Url::to(['/site/profile'])?>" method="post" 
                        novalidate="novalidate" id="profile-form" enctype="multipart/form-data">

                        <div class="col-md-6 form-group p_star">
                            <label for="first">Ваше имя</label>
                            <input type="text" class="form-control" id="first" name="f_name"
                            <?php echo ($user_data->first_name) ? 'value="'. $user_data->first_name .'"' : ''?>>
                            <!--<span class="placeholder" data-placeholder="Имя"></span>-->
                        </div>

                        <div class="col-md-6 form-group p_star">
                            <label for="last">Ваша фамилия</label>
                            <input type="text" class="form-control" id="last" name="l_name"
                            <?php echo ($user_data->first_name) ? 'value="'. $user_data->last_name .'"' : ''?>>  
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="company">Название компании в которой вы работаете</label>
                            <input type="text" class="form-control" id="company" name="company" 
                            placeholder="Название компании"
                            <?php echo ($user_data->company) ? 'value="'. $user_data->company .'"' : ''?>>
                        </div>

                        <div class="col-md-6 form-group p_star">
                            <label for="number">Ваш номер телефона</label>
                            <input type="text" class="form-control" id="number" name="number" 
                            <?php echo ($user_data->number_phone) ? 'value="'. $user_data->number_phone .'"' : ''?>>
                        </div>

                        <div class="col-md-6 form-group p_star">
                            <label for="email">Ваш Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                            <?php echo ($email) ? 'value="'.$email.'"' : ''?>>
                            <span class="placeholder" 
                            <?php echo ($email) ? 'value="'.$email.'" data-placeholder=""' : 'data-placeholder="Email"'?>>
                            </span>
                        </div>

                        <div class="col-md-12 form-group p_star country-star">
                        <label for="country_label">Страна</label>
                            <?php if($user_data->country != null): ?>
                                <input type="text" class="form-control" id="country_label" name="country"
                                value="<?=$user_data->country?>" data-country="">
                            <?php else: ?>
                                <input type="text" class="form-control" id="country_label" name="country"
                                value="" placeholder="Укажите свою страну" data-country="">
                            <?php endif; ?>

                            <div class="country_help helpers_list non-visible">
                                <ul class="country_list">

                                </ul>
                            </div>
                            
                        </div>

                        <div class="col-md-12 form-group p_star region-star">
                        <label for="region_label">Регион</label>
                            <?php if($user_data->region != null): ?>
                                <input type="text" class="form-control" id="region_label" name="region"
                                value="<?=$user_data->region?>" data-region="">
                            <?php else: ?>
                                <input type="text" class="form-control" id="region_label" name="region"
                                value="" placeholder="Укажите регион" data-region="">
                            <?php endif; ?>

                            <div class="region_help helpers_list non-visible">              
                                <ul class="region_list">

                                </ul>
                            </div>

                        </div>  

                        <div class="col-md-12 form-group p_star city-star">
                        <label for="city_label">Город</label>
                            <?php if($user_data->city != null): ?>
                                <input type="text" class="form-control" id="city_label" name="city"
                                value="<?=$user_data->city?>" data-city="">
                            <?php else: ?>
                                <input type="text" class="form-control" id="city_label" name="city"
                                value="" placeholder="Укажите город" data-city="">
                            <?php endif; ?>

                            <div class="city_help helpers_list non-visible">
                                <ul class="city_list">

                                </ul>
                            </div>

                        </div>

                        <div class="col-md-12 form-group p_star">
                            <label for="add1">Первый адресс доставки</label>
                            <input type="text" class="form-control" id="add1" name="add1"
                            <?php echo ($user_data->first_address) ? 'value="'. $user_data->first_address .'"' : ''?>>    
                        </div>

                        <div class="col-md-12 form-group p_star">
                            <label for="add2">Второй адресс доставки</label>
                            <input type="text" class="form-control" id="add2" name="add2"
                            <?php echo ($user_data->second_address) ? 'value="'. $user_data->second_address .'"' : ''?>>
                        </div>
                        
                        <div class="col-md-6 form-group p_star">
                            <input type="submit" name="submit" id="submit" value="Изменить" 
                                class="primary-btn" style="color:white;"/>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="profile-images">
                        <div class="current_user_img">
                            <p style="font-size:24px;">Ваше текущее фото</p>
                            <?php if (($user_data->image != null)):?>
                                <?=Html::img('@web/uploads/images/users/' . $user_data->image, [
                                    'alt' => 'Ваше изображение',
                                    'style' => 'max-width:280px !important;',
                                ])?>
                            <?php else: ?>
                                <?=Html::img("/frontend/web/img/no-image.svg", [
                                    'alt' => 'Ваше изображение',
                                    'style' => 'width:300px;',
                                ])?>
                            <?php endif; ?>
                        </div>
                        <div class="load_new_user_img">
                            <label for="user_image" class="load_img_label">Загрузить новое фото</label>
                            <input type="file" name="user_image" id="user_image"
                                form="profile-form" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>