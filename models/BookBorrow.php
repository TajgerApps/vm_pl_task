<?php

namespace app\models;

use DateInterval;
use DateTimeImmutable;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\User as WebUser;

/**
 * This is the model class for table "book_borrow".
 *
 * @property int $id
 * @property int|null $book_id
 * @property int|null $user_id
 * @property string|null $borrow_date
 * @property string|null $return_date
 * @property int|null $is_returned
 *
 * @property Book $book
 * @property User $user
 */
class BookBorrow extends ActiveRecord
{
    public const borrowPeriodInDays = '30';

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'book_borrow';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'user_id', 'is_returned'], 'integer'],
            [['borrow_date', 'return_date'], 'safe'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'user_id' => 'User ID',
            'borrow_date' => 'Borrow Date',
            'return_date' => 'Return Date',
            'is_returned' => 'Is Returned',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return ActiveQuery
     */
    public function getBook(): ActiveQuery
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function isBorrowed(Book $book): bool
    {
        return static::find()->where(['book_id' => $book->id, 'is_returned' => false])->count() > 0;
    }

    public static function borrow(Book $book, WebUser $user)
    {
         $bookBorrow = new static();
         $bookBorrow->user_id = $user->id;
         $bookBorrow->book_id = $book->id;
         $bookBorrow->return_date = (new DateTimeImmutable())
             ->add(new DateInterval('P' . static::borrowPeriodInDays . 'D'))
             ->format('Y-m-d');

         $bookBorrow->save();
    }

    public static function findOverdueBorrows(): array
    {
        return static::find()->where('`is_returned` = 0 and return_date < NOW()')->all();
    }
}
