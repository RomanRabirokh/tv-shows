<?php

namespace app\models;

use yii\db\ActiveRecord;

class users_subscriptions extends ActiveRecord
{

	 public function getUser()
	 {
	 	return $this->hasOne(users::className(),['id' => 'user']);
	 }
	 public function getDubbing_studios()
	 {
	 	return $this->hasMany(dubbing_studios::className(),['id' => 'dubbing_studio']);
	 }
	 public function getShows()
	 {
	 	return $this->hasMany(tv_shows::className(),['id' => 'tv_show']);
	 }
	 public function getSubscription_logs()
	 {
	 	return $this->hasMany(tv_users_subscriptions_logs::className(),['subscription' => 'id']);
	 }
}
?>