<?php
use yii\helpers\Url;
use yii\helpers\html;
?>
<div class="col-lg-8">
    <h3 style="font-size:32px !important;">Реквизиты заказа</h3>
    <form class="row contact_form" action="<?=Url::to(['/cart/profile'])?>" method="post" 
        novalidate="novalidate" id="cart-form" enctype="multipart/form-data">

        <div class="col-md-6 form-group p_star">
            <label for="first">Ваше имя</label>
            <input type="text" class="form-control" id="first" name="f_name" required>
            <!--<span class="placeholder" data-placeholder="Имя"></span>-->
            <div class="error-block" style="color: rgb(199, 5, 5) !important;"></div>
        </div>

        <div class="col-md-6 form-group p_star">
            <label for="last">Ваша фамилия</label>
            <input type="text" class="form-control" id="last" name="l_name" required>  
            <div class="error-block" style="color:border-color: rgb(199, 5, 5) !important;"></div>
        </div>

        <div class="col-md-12 form-group">
            <label for="company">Название компании в которой вы работаете</label>
            <input type="text" class="form-control" id="company" name="company" 
            placeholder="Название компании" required>
        </div>

        <div class="col-md-6 form-group p_star">
            <label for="number">Ваш номер телефона</label>
            <input type="text" class="form-control" id="number" name="number" required>
            <div class="error-block" style="color: rgb(199, 5, 5) !important;"></div>
        </div>

        <div class="col-md-6 form-group p_star">
            <label for="email">Ваш Email</label>
            <input type="text" class="form-control" id="email" name="email" required>
            <span class="placeholder" >
            </span>
            <div class="error-block" style="color: rgb(199, 5, 5) !important;"></div>
        </div>

        <div class="col-md-12 form-group p_star country-star">
        <label for="country_label">Страна</label>
           
            <input type="text" class="form-control" id="country_label" name="country"
                value="" placeholder="Укажите свою страну" data-country="" required>

            <div class="country_help helpers_list non-visible">
                <ul class="country_list">

                </ul>
            </div>
            <div class="error-block" style="color: rgb(199, 5, 5) !important;"></div>
        </div>

        <div class="col-md-12 form-group p_star region-star">
        <label for="region_label">Регион</label>
            
            <input type="text" class="form-control" id="region_label" name="region"
                value="" placeholder="Укажите регион" data-region="" required>

            <div class="region_help helpers_list non-visible">              
                <ul class="region_list">

                </ul>
            </div>
            <div class="error-block" style="color: rgb(199, 5, 5) !important;"></div>
        </div>  

        <div class="col-md-12 form-group p_star city-star">
        <label for="city_label">Город</label>
           
            <input type="text" class="form-control" id="city_label" name="city"
                value="" placeholder="Укажите город" data-city="" required>
        
            <div class="city_help helpers_list non-visible">
                <ul class="city_list">

                </ul>
            </div>
            <div class="error-block" style="color: rgb(199, 5, 5) !important;"></div>
        </div>

        <div class="col-md-12 form-group p_star">
            <label for="add1">Первый адресс доставки</label>
            <input type="text" class="form-control" id="add1" name="add1" required>   
            <div class="error-block" style="color: rgb(199, 5, 5) !important;"></div>
        </div>

        <div class="col-md-12 form-group p_star">
            <label for="add2">Второй адресс доставки</label>
            <input type="text" class="form-control" id="add2" name="add2">
            <div class="error-block" style="color: rgb(199, 5, 5) !important;"></div>
        </div>

    </form>
</div>