<?php

/* @var $this \yii\web\View */
/* @var $coupon array */
/* @var $timeOutPjax integer */
/* @var $countCouponOnPage integer */
/* @var $linkPagerMaxButtonCount */
/* @var $typeDiscount */
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\data\Pagination;
use yii\helpers\Html;
use frontend\components\StringHelper;
use yii\helpers\Url;
?>

<?php
$pages = new Pagination(['totalCount' => count($coupon), 'pageSize' => $countCouponOnPage ]);
// приводим параметры в ссылке к ЧПУ
$pages->pageSizeParam = false;
$coupon=array_slice($coupon,$pages->offset, $pages->limit);
$typeDiscount=array_slice($typeDiscount,$pages->offset, $pages->limit);
?>

<div class="pjax">
<?php Pjax::begin(['timeout'=>$timeOutPjax, 'enablePushState' => false, 'enableReplaceState'=>true, 'scrollTo'=>2]); ?>
<?php
$clps = 0;
?>
<?php if($coupon): ?>
    <?php foreach ($coupon as $value=>$key): ?>
        <div class="row box-coupon">
            <div class="col-md-4 col-lg-2   box-coupon-image">
                    <?php
                    if ($blockcollg2left=='image') {
                        echo  '<a data-pjax="0" href=' . Url::to(['/admitad/kupon/company/', 'company' => StringHelper::companyName($key['campaign']['name']) ]) . '>';
                        echo '<img src=' . $key['image'] . '>';
                        echo   '</a>';
                    }elseif ($blockcollg2left=='discount'){
                      echo Html::tag('div',$key['discount'] ,['class'=>'discount']);
                    }
                    ?>
            </div>
            <div class="col-md-4 col-lg-7   box-coupon-text">
                <h4><?= $key['name'] ?> </h4>
            </div>
            <div class="col-md-4 col-lg-3 box-coupon-button">
                <a href="" class="btn btn-primary"
                    <?= 'data-id=' . $key['id'] ?>
                    <?= 'data-type=' . $typeDiscount[$value]['type'] ?>>
                    <?=$typeDiscount[$value]['name'] ?>
                </a>
            </div>
            <div class="box-collapse">
                <div class="text-left my-text-left">
                    <a class="buttonDetails" data-toggle="collapse" href="<?= '#collapse' . ++$clps ?>" >
                        Подробнее <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </a>
                </div>
                <div id="<?= 'collapse' . $clps ?>" class="collapse-block collapse text-left ">
                    <p><b>Дата окончания: </b> <?= StringHelper::dateFormmat($key['date_end']) ?> </p>
                    <p class="text-justify"><b>Условия: </b>
                        <?= $key['description'] ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php
    $this->registerJsFile(
        'depend/js/script2.js',
        ['depends'=>['yii\web\YiiAsset']]
    )
?>
<?php
echo LinkPager::widget([
    'pagination' => $pages,
    'maxButtonCount' => $linkPagerMaxButtonCount,
    'options' => [
        'tag'=>'ul',
        'class' => 'pagination justify-content-center'
    ],
    'linkOptions' => ['class' => 'page-link'], //<a>
    'activePageCssClass' => 'active',
    'disabledPageCssClass' => 'page-link no-hover',
    'pageCssClass'=>'page-item', //<li>
]);


?>
<?php Pjax::end(); ?>

</div>

