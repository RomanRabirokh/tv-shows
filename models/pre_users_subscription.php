<?php

namespace app\models;

use yii\db\ActiveRecord;

class pre_users_subscription extends ActiveRecord
{

	 public function getDubbing_studios()
	 {
	 	return $this->hasMany(dubbing_studios::className(),['id' => 'dubbing_studio']);
	 }
	 public function getShows()
	 {
	 	return $this->hasMany(tv_shows::className(),['id' => 'tv_show']);
	 }
}
?>