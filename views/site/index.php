<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url; 
$this->title = 'tv-shows.one';
$count_row=0;

?>
<div id="inline">
	<h2 id="subscribe_header">Подписка на сериал</h2>

	<!--<form id="subscribe" name="subscribe" action="" method="post">
		<label for="email">Ваш E-mail</label>
		<input type="email" id="email" name="email" class="txt">
		<br>
		<button id="send_email">Подписаться</button>
	</form>-->
	<div class="successful_send">На вашу почту отправлено сообщение с подтверждением подписки!</div>
	<?php $form = ActiveForm::begin(['options' => ['class' => 'subscribe-form','id'=>'subscribe','name'=>'subscribe']]); ?>
		
		<?= $form->field($model, 'email')->textInput(['maxlength' => 255], ['class' => 'txt','id'=>'email','name'=>'email']); ?>		<?= Html::activeHiddenInput($model, 'name_studio', ['value' => ''],['options' => ['id' => 'name_studio']]); ?>
		<?= Html::activeHiddenInput($model, 'name_tv_shows', ['value' => ''],['options' => ['id' => 'name_tv_shows']]); ?>
		<br>	
		<?= Html::submitButton('Подписаться', ['id' => 'send_email']) ?>

	<?php ActiveForm::end(); ?>
	
	
</div> 
<div class="cssload-container" >
				<div class="cssload-teardrop cssload-tearLeft"></div>
				<div class="cssload-teardrop cssload-tearRight"></div>
				
				<div id="cssload-contain1">
					<div id="cssload-ball-holder1">
						<div class="cssload-ballSettings cssload-ball1"></div>
					</div>
				</div>
				
				<div id="cssload-contain2">
					<div id="cssload-ball-holder2">
						<div class="cssload-ballSettings cssload-ball2"></div>
					</div>
				</div>
		  </div>
<?php foreach( $list_of_tv_shows as $key_show => $show) { ?>
			<?php if($count_row==0 ||$count_row%3==0){ ?>
 			<div class="row_tv">
 			<?php } ?>
 			<div class ="tv_item_all">	
		 			<div class="tv_item">
		 				<img src="<?=$show->img?>">
		 				<div class="tv_item_text">
		 					<?=$show->russian_name;?> 
		 					<?php if(isset($show->seasons[0]['number'])=='true') {  ?>
		 						s<?=$show->seasons[0]['number'];?>
		 						<?php if(isset($show->seasons[0]['series'][0]['number'])=='true') { ?>ep<?=$show->seasons[0]['series'][0]['number']?> 
		 						<?php } } ?>

		 				</div>
		 				</img>
		 			</div>
		 			<div class="tv_item_active">
		 				<img src="<?=$show->img?>" class="img_item_active"></img>
		 				<div class="tv_item_text">
		 					<?=$show->russian_name;?> 
		 					<?php if(isset($show->seasons[0]['number'])=='true') {  ?>
		 						s<?=$show->seasons[0]['number'];?>
		 						<?php if(isset($show->seasons[0]['series'][0]['number'])=='true') { ?>ep<?=$show->seasons[0]['series'][0]['number'];?> 
		 						<?php } } ?>
		 				</div>
		 				<div class="tv_item_block"> 
			 				<div class="tv_item_real_usa">
			 					USA
			 				</div>
			 				<div class="tv_item_real_usa_data">
			 					<?php if(isset($show->seasons[0]['series'][0]['release_date'])=='true') { ?>
		 						<?=$show->seasons[0]['series'][0]['release_date']?> 
		 						<?php }  else {?>	
		 						<?php echo 'Неизвестно'; ?>
		 						<?php } ?>
			 				</div>
			 				<div class="tv_item_real_usa_data_subscribe popbutton"  href="#inline">
			 					Подписаться
			 				</div>
			 			</div>	
		 				<?php if(isset($show->seasons[0]['series'])=='true') { ?>
		 						<?php foreach($show->seasons[0]['series'] as $serie) {  ?>
		 							<?php if(isset($serie['studios_Series'])=='true') { ?>
			 							<?php foreach($serie['studios_Series'] as $studios_Series) {  ?>
			 								<?php if(isset($studios_Series['studio']['name'])=='true') { ?>
				 							<hr>
				 							<div class="tv_item_block"> 
								 				<div class="tv_item_studio">
								 					<?=$studios_Series['studio']['name'];?> 
								 				</div>
								 				<div class="tv_item_studio_data">
								 				&nbsp;
								 				</div>
								 				<div class="tv_item_studio_subscribe" href="#inline">
								 					Подписаться
								 				</div>	
							 				
								 			</div>	
							 				
							 				<?php } ?>	
					 					<?php } ?>	
		 							<?php } ?>
		 						<?php } ?>
		 				<?php } ?>	
		 			</div>
	 	       </div>	
 			<?php  $count_row++; if($count_row%3==0){ ?>
 			</div>
 			<?php } ?>
 			
 			<?php }?>
 			
 			<script>
 				var url_ajax="<?php echo Yii::$app->urlManager->createUrl(['site/submitsubscribe']); ?>";
 				var url_ajax_content="<?php echo Yii::$app->urlManager->createUrl(['site/ajaxcontent']); ?>";
 				var url_ajax_serch="<?php echo Yii::$app->urlManager->createUrl(['site/serch']); ?>";
 			</script>	
	   