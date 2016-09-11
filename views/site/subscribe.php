<?php
$this->title = 'Подтверждение подписки';
?>
<div class="subscribe-text">
	<?php if($answer['status']=='success'){ ?>
		
	Подписка на сериал  <?=$tv_show;?> в озвучке <?=$dubbing_studio;?>  успешно оформленна!
</div>
	
	<?php } else { ?>
	<div  class="subscribe-text"> Произошла ошибка! <?=$answer['message'];?> </div>
	<?php } ?>  
