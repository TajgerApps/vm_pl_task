<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BookBorrowSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-borrow-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'book_id') ?>

    <?php echo $form->field($model, 'user_id') ?>

    <?php echo $form->field($model, 'borrow_date') ?>

    <?php echo $form->field($model, 'return_date') ?>

    <?php // echo $form->field($model, 'is_returned') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
