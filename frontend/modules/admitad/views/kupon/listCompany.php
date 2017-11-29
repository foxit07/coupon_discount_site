<?php
use yii\helpers\Html;
?>
<div class="container text-center">
    <h2 class="my-4 ">Список интернет магазинов с акциями и промокодами</h2>
    <div class="row text-center">
        <div class="box-shadow-coupon">
            <?php foreach ($letterCompany as $letter): ?>
            <h1><?=$letter?></h1>
            <div class="row">
                <?php foreach($companyName as $name ): ?>
                    <?php if($letter==$name{0}): ?>
                        <div class="col-lg-4 col-md-4 shop-text">
                            <?php echo Html::a($name, ['/admitad/kupon/company', 'company' => $name]) ?>
                        </div>
                <?php endif; ?>
                <?php endforeach; ?>
                <div class="push"></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
