<?php

use yii\helpers\Html;
?>

<?php foreach($pageReviews as $review): ?>
    <div class="review_item">
        <div class="media">
            <div class="d-flex">
            <?=Html::img('@web/uploads/images/users/for_profile/' . $review->user->data->image, [
                'alt' => $review->user->data->image,
                'style' => 'border-radius:50%;',
            ])?>
            </div>
            <div class="media-body">
            <h3><?=ucfirst($review->user->data->first_name) . ' ' . 
            ucfirst($review->user->data->last_name)?></h3>
            </div>
        </div>
        <p><?=ucfirst($review->reviews)?></p>
    </div>
    <hr/>
<?php endforeach; ?>
<div class="nav-reviews">
    <?php 
        if($pagination != null) {
        echo $pagination->getNavPageList('review');
        }
    ?>
</div> 