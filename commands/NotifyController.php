<?php
namespace app\commands;

use app\models\BookBorrow;
use app\models\Notification;
use app\models\User;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class NotifyController extends Controller
{
    public function actionIndex()
    {
        $overdueBorrows = BookBorrow::findOverdueBorrows();
        $userAndBookAmountList = $this->getUserAndBookAmountList($overdueBorrows);
        $usersToNotNotify = Notification::findUsersNotifiedLastWeek(array_keys($userAndBookAmountList));
        $usersToNotify = $this->filterUsersToNotify($userAndBookAmountList, $usersToNotNotify);

        $this->sendNotifications($usersToNotify);

        return ExitCode::OK;
    }

    private function getUserAndBookAmountList(array $overdueBorrows): array
    {
        return array_reduce(
            $overdueBorrows,
            function ($carry, BookBorrow $bookBorrow): array {
                if (empty($carry[$bookBorrow->user_id])) {
                    $carry[$bookBorrow->user_id] = 0;
                }
                $carry[$bookBorrow->user_id]++;
                return $carry;
            },
            []
        );
    }

    private function filterUsersToNotify(array $userAndBookAmountList, array $usersToNotNotify): array
    {
        return array_filter(
            $userAndBookAmountList,
            function (int $userId) use ($usersToNotNotify): bool {
                return !in_array($userId, $usersToNotNotify, false);
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    private function sendNotifications(array $usersToNotify)
    {
        foreach ($usersToNotify as $userId => $overdueBooksAmount) {
            $this->sendNotification($userId, $overdueBooksAmount);
            Notification::confirmSendNotification($userId);
        }

    }

    private function sendNotification(int $userId, int $overdueBooksAmount)
    {
        $user = User::findOne($userId);

        Yii::$app->mailer
            ->compose()
            ->setFrom('fornal.mariusz@gmail.com')
            ->setTo($user->email)
            ->setSubject('Overdue Books!')
            ->setTextBody(sprintf("Hi %s!\n\n\nyou have %s overdue books", $user, $overdueBooksAmount))
            ->setHtmlBody(sprintf('Hi %s!<br><br><br>You have %s <span style="color:red">overdue</span> books', $user, $overdueBooksAmount))
            ->send();
    }
}
