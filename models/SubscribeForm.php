<?php
namespace app\models;

use Yii;
use yii\base\Model;

class SubscribeForm extends Model
{
    public $email;
    public $name_studio;
    public $name_tv_shows;
    /**
     * @return array the validation rules.
     */
     
    public function rules()
    {
        return [
        [['name_studio', 'name_tv_shows'], 'required'],
            ['email', 'email'],
        ];
    }
	public function attributeLabels()
    {
		 return [
		'email' => ' Ваш Email',
       		 ];
    }

    /**
     * @return array customized attribute labels
     */
   /* public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }*/

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function subscribe($email)
    {
        if ($this->validate()) {
            /*Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();*/

            return true;
        }
        return false;
    }
}