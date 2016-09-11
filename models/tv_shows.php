<?php

namespace app\models;

use yii\db\ActiveRecord;

class tv_shows extends ActiveRecord
{
	public $img;
	public function afterFind()
	{
		parent::afterFind();
		if(isset($this->image)&&$this->image!='')
			$this->img='/images/tv-shows/'.$this->image.'.png';
		else
			$this->img='/images/tv-shows/default.png';
	}

	 public function getSeasons()
    {
        return $this->hasMany(seasons::className(), ['tv_show' => 'id']);
    }
    public function getSubscription()
    {
		return $this->hasOne(users_subscriptions::className(),['tv_show' => 'id']);
	}
	public function getPre_Subscription()
    {
		return $this->hasOne(pre_users_subscriptions::className(),['tv_show' => 'id']);
	}
}
?>