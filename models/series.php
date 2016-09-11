<?php

namespace app\models;

use yii\db\ActiveRecord;

class series extends ActiveRecord
{

	 public function getSeason()
	 {
	 	 return $this->hasOne(seasons::className(), ['id' => 'season']);
	 }
	 public function getStudios_Series()
	 {
	 	return $this->hasMany(dubbing_studios_series::className(), ['serie' => 'id']);
	 }
	 public function getStudios()
	 {
	 	return $this->hasMany(dubbing_studios::className(), ['id	' => 'dubbing_studio'])
	 	 ->via('dubbing_studios_series');;
	 }
}
?>