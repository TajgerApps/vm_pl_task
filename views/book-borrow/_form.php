<?php

use app\models\Book;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BookBorrow */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-borrow-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'book_id')->dropDownList(
        ArrayHelper::map(Book::find()->all(),'id','name')
    ) ?>

    <?php echo $form->field($model, 'user_id')->dropDownList(
        ArrayHelper::map(User::find()->select(['id', 'CONCAT(COALESCE(first_name, ""), " ", COALESCE(last_name, "")) as `full_name`'])->asArray()->all(),'id','full_name')
    ) ?>

    <?php echo $form->field($model, 'borrow_date')->textInput(['readonly' => true]) ?>

    <?php echo $form->field($model, 'return_date')->widget(
        DatePicker::class,
        [
            'dateFormat' => 'yyyy-MM-dd',
        ]
    ) ?>

    <?php echo $form->field($model, 'is_returned')->checkbox() ?>

    <div class="form-group">
        <?php echo Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
