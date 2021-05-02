<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BookBorrow */

$this->title = 'Update Book Borrow: ' . $model->book . ' by ' .$model->user;;
$this->params['breadcrumbs'][] = ['label' => 'Book Borrows', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="book-borrow-update">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
