<?php

use app\models\BookBorrow;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $book app\models\Book */
/* @var $message string */

$this->title = $book->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="book-view">
    <h1><?php echo Html::encode($this->title) ?></h1>
    <p>
        <?php echo $message; ?>
    </p>
</div>
