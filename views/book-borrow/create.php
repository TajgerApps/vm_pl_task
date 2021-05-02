<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BookBorrow */

$this->title = 'Create Book Borrow';
$this->params['breadcrumbs'][] = ['label' => 'Book Borrows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-borrow-create">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
