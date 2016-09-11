<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$count_row=0; 
?>


<?php if(isset($list_of_tv_shows_ajax[0])){ foreach(  $list_of_tv_shows_ajax as $key_show => $show) { ?>
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
 			
 			<?php } }?>