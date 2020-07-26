<?php

use lo\widgets\modal\ModalAjax;
use yii\helpers\Url;

$this->title = 'My Yii Application';
$style = <<<CSS

.flex-container {
  /* We first create a flex layout context */
  display: flex;
  
  /* Then we define the flow direction 
     and if we allow the items to wrap 
   * Remember this is the same as:
   * flex-direction: row;
   * flex-wrap: wrap;
   */
  flex-flow: nowrap ;
  
  /* Then we define how is distributed the remaining space */
  justify-content: space-around;
  
  padding: 0;
  margin: 0;
  list-style: none;
}

.item-status-empty {
  background: tomato;
}

.item-status-occupied {
  background: grey;
}

.flex-item {
  padding: 5px;
  width: 8%;
  height: 40px;
  margin-top: 8px;
  line-height: 40px;
  color: white;
  font-weight: bold;
  font-size: 1em;
  text-align: center;
}

CSS;

$js = <<<JS
JS;
$this->registerJs($js);


$this->registerCss($style);
?>

<div class="container">

    <?php for ($i = 1; $i < 11; $i++): ?>
        <div class="flex-container">
            <?php for ($j = 1; $j < 11; $j++): ?>
                <?php
                echo ModalAjax::widget([
                    'id' => 'seat-' . $i . '-' . $j,
                    'header' => 'Action with seat (view/create)',
                    'toggleButton' => [
                        'label' => $i . ' ' . $j,
                        'id' => 'btn-' . $i . '-' . $j,
                        'class' => 'flex-item item-status-empty'
                    ],
                    'url' => Url::base() . '/seat/' . $i . '/' . $j, // Ajax view with form to load
                    'ajaxSubmit' => true, // Submit the contained form as ajax, true by default
                    // ... any other yii2 bootstrap modal option you need
                    'events' =>[
                        ModalAjax::EVENT_MODAL_SUBMIT => new \yii\web\JsExpression("
                                            function(event, data, status, xhr, selector) {
                                                console.log(data);
                                                if (data.success == true && data.action == 'create') {
                                                    $(\"#btn-\" + data.row + \"-\" + data.col).removeClass('item-status-empty');
                                                    $(\"#btn-\" + data.row + \"-\" + data.col).addClass('item-status-occupied');
                                                } else if (data.success == true && data.action == 'delete') {
                                                    $(\"#btn-\" + data.row + \"-\" + data.col).removeClass('item-status-occupied');
                                                    $(\"#btn-\" + data . row + \"-\" + data . col).addClass('item-status-empty');
                                                } else {
                                                    alert('something goes wrong (500 response)');
                                                }
                                                
                                                $(this).modal('toggle');
                                             }
                            "),
                    ]
                    ]);
                ?>

            <?php endfor; ?>
        </div>
    <?php endfor; ?>
</div>

