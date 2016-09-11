<?php
namespace app\models;

use yii\db\ActiveRecord;

class users_subscriptions_logs extends ActiveRecord
{
	 public function getSubscription()
	 {
	 	return $this->hasOne(users_subscriptions::className(),['id' => 'subscription']);
	 }
}
?>