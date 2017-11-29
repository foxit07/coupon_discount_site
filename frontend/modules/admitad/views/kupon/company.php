<?php
use frontend\modules\admitad\widgets\coupon\Coupon;
use frontend\modules\admitad\widgets\modal\Modal;
?>

<div class="row ">
<div class="col-lg-3 " style="height: 100%" >
    <div class="box-coupon">
    <img src="<?php echo $couponCompany[0]['image'] ?>" alt="" style="padding: 2em 1em">
    </div>
    <?php if(!empty($companyAbout)):?>
        <div class="col-lg-12 box-coupon"  style="padding: 5px 15px; ">
            <h2><?=$companyAbout->name ?></h2>
                <p class="text-justify" style="text-indent: 15px;">
                    <?=$companyAbout->about ?>
                </p>
        </div>
    <?php endif; ?>
</div>

<div class="col-lg-9 ">

        <?= Coupon::widget([
                'coupon' => $couponCompany,
                'blockcollg2left'=>'discount',
            ]) ?>

</div>

</div>
    <?php
    if(!empty($couponId)){
        echo Modal::widget(['coupon'=>$couponId]);
    }
    ?>
