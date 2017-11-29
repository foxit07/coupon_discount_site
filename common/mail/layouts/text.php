<?php

use yii\helpers\Html;

/** @var \yii\web\View $this views component instance */
/** @var \yii\mail\MessageInterface $message the message being composed */
/** @var string $content main views render result */
?>

<?php $this->beginPage() ?>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
<?php $this->endPage() ?>
