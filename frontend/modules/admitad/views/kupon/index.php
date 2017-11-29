<?php
use frontend\modules\admitad\widgets\coupon\Coupon;
use frontend\modules\admitad\widgets\modal\Modal;
use yii\helpers\Url;
use frontend\components\StringHelper;

?>


    <!-- Slick Slider -->
    <h2 class="my-4 text-center">
        ЭКОНОМЬТЕ НА ОНЛАЙН-ПОКУПКАХ С ПОМОЩЬЮ АКЦИЙ <br> И ПРОМОКОДОВ В ИНТЕРНЕТ МАГАЗИНАХ
    </h2>

<?php if( Yii::$app->session->getFlash('subscribe') ): ?>

    <div class="alert-success alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

       Вы успешно подписаны

    </div>

<?php endif; ?>

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

    <!--Cupon -->

<h3 class="my-4 text-center">
    АКЦИИ & ПРОМОКОДЫ
</h3>

<?= Coupon::widget(['coupon' => $coupon]) ?>
<?php
if(!empty($couponId)){
    echo Modal::widget(['coupon'=>$couponId]);
}
?>




