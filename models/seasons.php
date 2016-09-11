<?php

namespace app\models;

use yii\db\ActiveRecord;

class seasons extends ActiveRecord
{
public function getShow()
	{
		
		 return $this->hasOne(tv_shows::className(), ['id' => 'tv_show']);
	}
	public function getSeries()
	{
		return $this->hasMany(series::className(), ['season' => 'id']);
	}
}
	
?>