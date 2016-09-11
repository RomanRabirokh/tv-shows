<?php

namespace app\models;

use yii\db\ActiveRecord;

class dubbing_studios extends ActiveRecord
{
	 public function getSubscriptions()
	 {
	 	return $this->hasOne(users_subscriptions::className(),['dubbing_studio'=>'id']);
	 }
	 public function getPre_Subscriptions()
	 {
	 	return $this->hasOne(pre_users_subscriptions::className(),['dubbing_studio'=>'id']);
	 }
	 public function getStudios_Series()
	 {
	 	return $this->hasMany(dubbing_studios_series::className(), ['dubbing_studio' => 'id']);
	 }
	 public function getSeries()
	 {
	 	return $this->hasMany(series::className(), ['id	' => 'serie'])
	 	 ->via('dubbing_studios_series');;
	 }
}
?>