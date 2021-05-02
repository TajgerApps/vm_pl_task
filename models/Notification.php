<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $notification_date
 */
class Notification extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['notification_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'notification_date' => 'Notification Date',
        ];
    }

    /**
     * @param int[] $userIds
     * @return array
     */
    public static function findUsersNotifiedLastWeek(array $userIds): array
    {
        $usersList = static::find()
            ->select('user_id')
            ->distinct()
            ->where(
                ['in', 'user_id', $userIds],
            )
            ->andWhere('`notification_date` > NOW() - INTERVAL 7 DAY')
            ->all();

        return array_map(
            function (Notification $user): int {
                return $user->user_id;
            },
            $usersList
        );
    }

    public static function confirmSendNotification(int $userId)
    {
        $notification = new Notification();
        $notification->user_id = $userId;
        $notification->save();
    }
}
