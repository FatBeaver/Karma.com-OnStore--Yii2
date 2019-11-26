<div class="container" style="margin-top:33vh; margin-bottom:20vh;">
    <h2>Через несколько секунд вы будете перенаправленны на сайт оплаты товара.<br/>
        Нажмите на кнопку ниже если не хотите ждать.
    </h2>
    <form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
        <input type="hidden" name="ik_co_id" value="5ddbca751ae1bd11048b4594" />
        <input type="hidden" name="ik_pm_no" value="<?=$order_id?>" />
        <input type="hidden" name="ik_am" value="<?=$_SESSION['cart_total']['total_all']?>" />
        <input type="hidden" name="ik_cur" value="RUB" />
        <input type="hidden" name="ik_desc" value="Покупка товара" />
        <input type="submit" value="Оплатить немендленно" class="pay-butt">
    </form>
</div>