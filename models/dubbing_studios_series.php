<?php

namespace app\models;

use yii\db\ActiveRecord;

class dubbing_studios_series extends ActiveRecord
{
	public function getSerie()
	 {
	 	 return $this->hasOne(series::className(), ['id' => 'serie']);
	 }
	 public function getStudio()
	 {
	 	return $this->hasOne(dubbing_studios::className(), ['id' => 'dubbing_studio']);
	 }
	 
}
?>