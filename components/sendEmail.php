<?php
namespace app\components;
 
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class sendEmail extends Component
{
	private $css="";
	public $text="";
	public $header="";
	public $subject="";
	public $to="";
	public $from="noreply@tv.romanra.xyz";
	

	public function index($action,$params)
	{
		$this->to=$params['to'];
		if($params['dubbing_studio']=='original')
			$params['dubbing_studio']='оригинальной озвучке';
		else
			$params['dubbing_studio']='озвучке'.$params['dubbing_studio'];
		if($action=='send_activation')
		{
			$this->activation($params);
		}
		else if($action=='send_new_seria')
		{
			$this->new_seria($params);
		}
	}
	private function activation($params)
	{
		$this->header = "MIME-Version: 1.0;\r\n
			Content-Type: text/html; charset=utf-8\n;
			From:" .$this->from.  "<".$this->from.">\r\n
			Reply-To:".$this->to."\r\n";
		$this->subject="Активация подписки на сериал";
		$this->text="

		

			<div class='all_wrapper' style='background-image: url(http://tv.romanra.xyz/images/site/warm-amber-patterns-2.jpg);background-repeat:repeat;height: 100%;width: 100%; dispaly:inline-block;'>
			<div style='width:500px;height:178px;margin-left: auto;margin-right: auto; margin-bottom:10px;'><img src='http://tv.romanra.xyz/images/site/mini_logo.jpg' class='logo' style='margin-bottom: 10px;'> </img></div>
			<div class='wrapper' style='height:400px;width: 400px;margin-left: auto;margin-right: auto;display:block;'>
			<div class='tv_item_active' style='border: 10px solid orange;border-radius: 10px; margin-left: auto;margin-right: auto;float:left;'>
			<div class='tv_item' style='background-color: white;font-size: 20px;text-align: center;'>
					 	<img src='http://tv.romanra.xyz/images/tv-shows/".$params['image'].".png'>
					 	<div class='tv_item_text' style=' background-color: white;font-size: 20px;text-align: center;'>
					Вы пытаетесь оформить подписку на сериал <span class='name' style='font-weight:bold;color:orange;'>" .$params['name']."</span> В <span style='font-weight:bold;color:orange';> ".$params['dubbing_studio']. "</span>
					 		<a href='http://tv.romanra.xyz".$params['url']."'> <br/>Подтвердить подписку</a><br/>
					 				</div>
					 				</img>
			</div>
			</div>
			</div>
			</div>
		";
	}
	private function new_seria()
	{
		
	}
	
}
?>