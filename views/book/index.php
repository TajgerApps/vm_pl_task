<?php

use app\models\Book;
use app\models\BookBorrow;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'ISBN',
            'author',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {borrow} {delete}',
                'buttons' => [
                    'borrow' => function (string $url, Book $book) {
                        if (!BookBorrow::isBorrowed($book)) {
                            return Html::a(
                                Html::tag(
                                    'span',
                                    '',
                                    [
                                        'class' => 'glyphicon glyphicon-share',
                                        'title' => 'Borrow this book',
                                        'aria-label' => 'Borrow this book',
                                        'data-confirm' => 'Are you sure you want to borrow this book?',
                                    ]
                                ),
                                $url
                            );
                        }
                   }
                ]
            ],
        ],
    ]); ?>


</div>
