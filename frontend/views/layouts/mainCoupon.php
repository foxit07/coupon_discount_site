<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\СouponAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use frontend\modules\admitad\models\forms\CategoryProduct;

СouponAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top menuLink">
        <div class="container">
            <a class="navbar-brand" href="#">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link menu-link-color" href="<?php echo Url::to(['/admitad/kupon/index']) ?>">Главная</a>
                    </li>

                   <div class="dropdown" id="drop">
                        <li class="nav-item" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <a class="nav-link menu-link-color" href="#">Категории
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                        </li>
                       <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                           <?php
                                $menu = new CategoryProduct();

                                foreach ($menu->getMenu() as $item){
                                   echo Html::a($item['name'],['/admitad/kupon/category',
                                        'category' => $item['route_name']],['class' => 'dropdown-item']);
                                }
                           ?>
                        </div>
                    </div>

                    <li class="nav-item">
                        <a class="nav-link menu-link-color" href="<?php echo Url::to(['/admitad/kupon/list-company']) ?>">Магазины</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link-color" href="<?php echo Url::to(['/subscribe']) ?>">Подписка</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

</div>
<div class="push">
</div>
<!-- Footer -->
<footer class="py-5 bg-dark footer">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Abens 2017</p>
    </div>
</footer>
</body>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
