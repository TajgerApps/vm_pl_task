<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name
 * @property string|null $ISBN
 * @property int|null $author_id
 *
 * @property Author $author
 * @property BookBorrow[] $bookBorrows
 */
class Book extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['author_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['ISBN'], 'string', 'max' => 13],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'ISBN' => 'Isbn',
            'author_id' => 'Author ID',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return ActiveQuery
     */
    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for [[BookBorrows]].
     *
     * @return ActiveQuery
     */
    public function getBookBorrows(): ActiveQuery
    {
        return $this->hasMany(BookBorrow::class, ['book_id' => 'id']);
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
