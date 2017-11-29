<?php
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


<!--Cupon -->

<h3 class="my-4 text-center">
    АКЦИИ & ПРОМОКОДЫ
</h3>
<?php
$clps = 0;
?>
<?php if($coupon): ?>
    <div class="row box-coupon">
        <div class="col-lg-2  box-coupon-image ">
            <?php
                echo  '<a data-pjax="0" href=' . Url::to(['/admitad/kupon/company/', 'company' => StringHelper::companyName($coupon['campaign']['name']) ]) . '>';
                echo '<img src=' . $coupon['image'] . '>';
                echo   '</a>';
            ?>
        </div>
        <div class="col-lg-7  box-coupon-text ">
            <h4><?= $coupon['name'] ?> </h4>
        </div>
        <div class="col-lg-3 box-coupon-button">
            <a href="" class="btn btn-primary"
                <?= 'data-id=' . $coupon['id'] ?>
                <?= 'data-type=' .$coupon['species'] ?>>
               Перейти к акции
            </a>
        </div>
        <div class="box-collapse">
            <div class="text-left my-text-left">
                <a class="buttonDetails" data-toggle="collapse" href="<?= '#collapse' . ++$clps ?>" >
                    Подробнее <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>
            </div>
            <div id="<?= 'collapse' . $clps ?>" class="collapse-block collapse text-left ">
                <p><b>Дата окончания: </b> <?= StringHelper::dateFormmat($coupon['date_end']) ?> </p>
                <p class="text-justify"><b>Условия: </b>
                    <?= $coupon['description'] ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
if(!empty($couponId)){
    echo Modal::widget(['coupon'=>$coupon]);
}
?>




