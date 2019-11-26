<?php
use yii\helpers\Html;
?>
<div class="review_item">
    <div class="media">
        <div class="d-flex">
            <?=Html::img('@web/uploads/images/users/for_profile/' . $user_data->image, [
                'alt' => $user_data->image,
                'style' => 'border-radius:50%;',
            ])?>
        </div>
        <div class="media-body">
            <h3><?=ucfirst($user_data->first_name) . ' ' . ucfirst($user_data->last_name) ?></h3>
        </div>
    </div>
    <p><?=$viewReview->reviews?></p>
</div>
<hr/>