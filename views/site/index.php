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

.flex-item {
  background: tomato;
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

$this->registerCss($style);
?>

<div class="container">
    <?php for ($i = 0; $i < 10; $i++): ?>
        <div class="flex-container">
            <?php for ($j = 0; $j < 10; $j++): ?>
                <?php
                    echo ModalAjax::widget([
                    'id' => 'createCompany' . $i . '-' . $j,
                    'header' => 'Create Company',
                    'toggleButton' => [
                    'label' => 'New Company',
                    'class' => 'flex-item'
                    ],
                    'url' => Url::current(), // Ajax view with form to load
                    'ajaxSubmit' => true, // Submit the contained form as ajax, true by default
                    // ... any other yii2 bootstrap modal option you need
                    ]);
               ?>

            <?php endfor; ?>
        </div>
    <?php endfor; ?>
</div>

