
<a class="ddd" href=""  data-target="#myModal" data-toggle="modal" data-view="0" >

</a>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
   <div class="modal-header text-center" style="display: block">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <div class=" box-coupon-image">
           <a href="#">
               <img src="<?= $coupon['image']?>" alt="">
           </a>
       </div>
       <h4><?= $coupon['name']?></h4>
       <p> Скопируйте промокод и перейдите на сайт для активации </p>
       <a href="<?=$coupon['goto_link']?>"><?=preg_replace('#https?://([a-z0-9-]+\.[a-z]{2,3})/?.+#','$1',$coupon['campaign']['site_url']);?></a>

   </div>
   <!-- Modal body -->

     <div class="modal-body ">
         <div class="input-group " style="width: 15em; margin: 0 auto">
             <input id="foo" type="text"  class="form-control text-center" readonly style="border: none" value="<?= $coupon['promocode']?>">
             <span class="input-group-btn">
                     <button class="btn btn-info" data-clipboard-action="copy" data-clipboard-target="#foo" >Copy</button>
                 </span>
         </div>
     </div>
     <!-- Modal footer -->
     <div class="modal-footer">
         <p><b>Условия:</b>
             <?= $coupon['description']?>"
   </p>
     </div>
     <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     </div>
 </div>
</div>
</div>

<?php
//начало многосточной строки, можно использовать любые кавычки
$script = <<< JS

$(function () {
            $('a.ddd').trigger('click');
    });

    var clipboard = new Clipboard('.btn');

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });

JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_END);
$this->registerJsFile('depend/js/dist/clipboard.min.js',  ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
