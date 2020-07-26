<?php

use lo\widgets\modal\ModalAjax;
use yii\helpers\Url;

$this->title = 'Theatre hall';
$style = <<<CSS

.flex-container {
  display: flex;
  flex-flow: nowrap;
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


// Mark seated
$js = "";
foreach ($localSeats as $k => $ls) {
    $js .= new \yii\web\JsExpression("$(\"#btn-\" + {$ls['row']} + \"-\" + {$ls['col']}).removeClass('item-status-empty'); $(\"#btn-\" + {$ls['row']} + \"-\" + {$ls['col']}).addClass('item-status-occupied');");
}
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
                    'url' => Url::base() . '/seat/' . $i . '/' . $j,
                    'ajaxSubmit' => true,
                    ]);
                ?>

            <?php endfor; ?>
        </div>
    <?php endfor; ?>
</div>

