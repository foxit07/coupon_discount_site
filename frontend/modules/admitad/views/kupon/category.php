<?php
use frontend\modules\admitad\widgets\coupon\Coupon;
use frontend\modules\admitad\widgets\modal\Modal;
use yii\helpers\Url;
use frontend\components\StringHelper;
?>

<!-- Slick Slider -->
<h2 class="my-4 text-center">
    ЭКОНОМЬТЕ НА ОНЛАЙН-ПОКУПКАХ С ПОМОЩЬЮ АКЦИЙ И ПРОМОКОДОВ В ИНТЕРНЕТ МАГАЗИНАХ
</h2>
<div class="row">
    <div class="container">
        <div class="autoplay">
            <?php for($i=0; $i<count($image); $i++): ?>
                <?php   echo  '<a  class="box-shadow-coupon"  href=' . Url::to(['/admitad/kupon/company/', 'company' => StringHelper::companyName($image[$i]['company_name']) ]) . '>';?>
                <img src=<?= $image[$i]['image'] ?> alt="" class="img-figure">
                <?php echo '</a>'; ?>
            <?php endfor; ?>
        </div>
    </div>
</div>

<?php


if (is_array($categoryCoupon)) {
    echo Coupon::widget(['coupon' => $categoryCoupon]);
}else{
echo "<h2 class=\"my-4 text-center\">К сожалению на данный момент в категории <$categoryCoupon> нет акций и промокодов</h2>";
}

?>

<?php
if(!empty($couponId)){
    echo Modal::widget(['coupon'=>$couponId]);
}
?>


