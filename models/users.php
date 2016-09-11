<?php

namespace app\models;

use yii\db\ActiveRecord;

class users extends ActiveRecord
{

	 public function getSubscriptions()
	 {
	 	return $this->hasMany(users_subscriptions::className(), ['user' => 'id']);
	 }
}
?>