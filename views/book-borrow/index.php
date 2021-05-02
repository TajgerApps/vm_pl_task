<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookBorrowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Book Borrows';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-borrow-index">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a('Create Book Borrow', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'book',
            'user',
            'borrow_date',
            'return_date',
            'is_returned:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
