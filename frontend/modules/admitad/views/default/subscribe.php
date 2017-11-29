<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<div class="row ">
    <div class="col-xs-12 col-md-12">
    <h2 class="text-center">Подпишитесь на нашу рассылку и будьте в курсе <br> актульных акций и промокодов</h2>
    </div>
        <div class="col-xs-6 col-md-4">
    </div>
    <div class="col-xs-6 col-md-4 box-shadow-coupon">
        <?php $form=ActiveForm::begin(); ?>
        <?php echo $form->field($subscribe, 'name'); ?>
        <?php echo $form->field($subscribe, 'email'); ?>
        <?php echo $form->field($subscribe, 'status')->hiddenInput()->label(false); ?>
        <?php echo Html::submitButton('Подписаться',[
            'class'=>'btn btn-primary',
        ]) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-xs-6 col-md-4"></div>


</div>