<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

use yii\helpers\Url; 
use yii\helpers\Json;

use app\models\users_subscriptions;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\dubbing_studios;
use app\models\series;
use app\models\dubbing_studios_series;
use app\models\seasons;
use app\models\pre_users_subscription;
use app\models\tv_shows;
use app\models\users_subscriptions_logs;
use app\models\SubscribeForm;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout','index','submitsubscribe','subscribe','enter','ajaxcontent'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
    	$model = new SubscribeForm();
    	
        $tv_shows=tv_shows::find()
        ->select(['*'])
        ->with([
        'seasons' => function ($query) {
        	$query
        	->select(['id','tv_show','number','date_end'])
        	->where('date_end>NOW()');
   			 },
        'seasons.series' => function ($query) {
        	$query
        	->select(['season','release_date','number','id',])
        	->where('release_date>NOW()');
   			 },
   		'seasons.series.studios_Series' => function ($query) {
        	$query
        	->select(['id','serie','dubbing_studio'])
        	->where('dubbing_studio != 1');
   			 },
   		'seasons.series.studios_Series.studio' => function ($query) {
        	$query
        	->select(['id','name']);
   			 },	 		 
        ])
        ->groupBy(['id'])
      	->limit(9)
        ->all();
 
        // print_r($tv_shows);
        return $this->render('index',
        ['list_of_tv_shows' => $tv_shows,
         'model' => $model,
         ]
        );
        
    }
   public function actionSubmitsubscribe()
    {
        $model = new SubscribeForm();
      	$model->load(Yii::$app->request->post());
        if($model->load(Yii::$app->request->post())) 
        {
            $email=trim($model->email);
            $name_studio=trim($model->name_studio);
            $name_tv_shows=trim($model->name_tv_shows);
            $str_code='';
            for($i=0;$i<10;$i++)
            {
				$rand=rand(65,122);
				$str_code.=chr($rand); 
			}

			$base64_str= base64_encode($str_code);
            $success=true;
            $tv_show=tv_shows::find()
            ->select(['id','image'])
            ->where(['russian_name' => $name_tv_shows])
            ->all();
            
            $dubbing_studio=dubbing_studios::find()
            ->select(['id'])
            ->where(['name' => $name_studio])
            ->all();
      		
      		$pre_sub= new pre_users_subscription();
            $pre_sub->email = $email;
            $pre_sub->dubbing_studio = $dubbing_studio[0]->id;
            $pre_sub->tv_show = $tv_show[0]->id;
            $pre_sub->code = $str_code;
			$pre_sub->save();
			$str_url='?id='.base64_encode($pre_sub->getPrimaryKey()).'&c='.$base64_str;
			$url=Yii::$app->urlManager->createUrl(['site/subscribe', 'id'=> base64_encode($pre_sub->getPrimaryKey()),'c'=> $base64_str]);
            $params=[
            'url'=> $url,
            'image' => $tv_show[0]->image,
            'name' =>$name_tv_shows,
            'dubbing_studio' => $name_studio,
            'to' => $email,
            ];
            
            Yii::$app->sendmail->index('send_activation',$params);
            Yii::$app->mailer->compose()
			    ->setFrom( Yii::$app->sendmail->from)
			    ->setTo( Yii::$app->sendmail->to)
			   // ->setHeader(Yii::$app->sendmail->header)
			    ->setSubject(Yii::$app->sendmail->subject)
			    ->setHtmlBody(Yii::$app->sendmail->text)
			    ->send();
            return json_encode($success);
        }
        else
        {
            return $this->renderPartial('index', [
            'model' => $model,
            ]);
        }
    }
	public function actionSubscribe()
	{
		$id = Yii::$app->request->get('id', '');
		$code =Yii::$app->request->get('c', 0);
		$id=(int)base64_decode($id);
		$code=base64_decode($code);
		$pre_sub=pre_users_subscription::find()
        ->where(['id' => $id])
        ->all();
        
        if($pre_sub==null)
		{
			
			$answer=['status'=>'error', 'message'=>'Нет записи в тб пре'];
			return $this->render('subscribe', [
            'answer' => $answer,
            'email' =>'',
            'tv_show' =>'',
            'dubbing_studio' =>'',
            ]);
		}
        
        if($code!=$pre_sub[0]->code)
        {
			$answer=['status'=>'error', 'message'=>'Код не совпадает'];
			return $this->render('subscribe', [
            'answer' => $answer,
            'email' =>'',
            'tv_show' =>'',
            'dubbing_studio' =>'',
            ]);
		}     
		$tv_show=tv_shows::find()
        ->select(['russian_name'])
        ->where(['id' => $pre_sub[0]->tv_show])
        ->all();
        $dubbing_studio=dubbing_studios::find()
        ->select(['name'])
        ->where(['id' => $pre_sub[0]->dubbing_studio])
        ->all();
        
		$users_sub = new users_subscriptions();
        $users_sub->email = $pre_sub[0]->email;
        $users_sub->dubbing_studio = $pre_sub[0]->dubbing_studio;
        $users_sub->tv_show = $pre_sub[0]->tv_show;
        $users_sub->user = null;
	    $users_sub->save();
		
		
		
        
		$answer=['status'=>'success'];
		return $this->render('subscribe', [
            'answer' => $answer,
            'email' =>$pre_sub[0]->email,
            'tv_show' =>$tv_show[0]->russian_name,
            'dubbing_studio' =>$dubbing_studio[0]->name,
            ]);
	}
	public function actionEnter()
	{
		 return $this->render('enter'
        );
	}
	
	public function actionAjaxcontent()
	{
		$first=Yii::$app->request->post('count', 1);  
		$second=6;
		$tv_shows=tv_shows::find()
        ->select(['*'])
        ->with([
        'seasons' => function ($query) {
        	$query
        	->select(['id','tv_show','number','date_end'])
        	->where('date_end>NOW()');
   			 },
        'seasons.series' => function ($query) {
        	$query
        	->select(['season','release_date','number','id',])
        	->where('release_date>NOW()');
   			 },
   		'seasons.series.studios_Series' => function ($query) {
        	$query
        	->select(['id','serie','dubbing_studio'])
        	->where('dubbing_studio != 1');
   			 },
   		'seasons.series.studios_Series.studio' => function ($query) {
        	$query
        	->select(['id','name']);
   			 },	 		 
        ])
        ->groupBy(['id'])
        ->offset($first)
        ->limit($second)
        
        ->all();
         /*return Json::encode($this->renderAjax('ajaxcontent', [
            'list_of_tv_shows' => $tv_shows,
            ]));*/
         return $this->renderPartial('ajaxcontent', [
            'list_of_tv_shows_ajax' => $tv_shows,
            ]);   
     }
	public function actionSerch()
	{
		$serch_str=Yii::$app->request->post('serch_str', ' ');  		
		//$serch_str="%$serch_str%";
		/*->where(['or',
          ['like', 'russian_name', 'сотня'],
          ['like', 'original_name', 'cотня']])*/
		$tv_shows=tv_shows::find()
        ->select(['*'])
        ->where('LOWER(russian_name)')
        ->where('LOWER(original_name)')
        ->where(
        ['or',
          ['like', 'russian_name', $serch_str],
          ['like', 'original_name', $serch_str]
        ])
        ->with([
        'seasons' => function ($query) {
        	$query
        	->select(['id','tv_show','number','date_end'])
        	->where('date_end>NOW()');
   			 },
        'seasons.series' => function ($query) {
        	$query
        	->select(['season','release_date','number','id',])
        	->where('release_date>NOW()');
   			 },
   		'seasons.series.studios_Series' => function ($query) {
        	$query
        	->select(['id','serie','dubbing_studio'])
        	->where('dubbing_studio != 1');
   			 },
   		'seasons.series.studios_Series.studio' => function ($query) {
        	$query
        	->select(['id','name']);
   			 },	 		 
        ])
        ->groupBy(['id'])
        
        ->all();
		return $this->renderPartial('ajaxcontent', [
            'list_of_tv_shows_ajax' => $tv_shows,
            ]);   
	}
}
