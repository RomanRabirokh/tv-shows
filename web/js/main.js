var name_studio;
var name_tv_shows;
	$(document).ready(function() {
		
		var scroll_flag=true;
		$(".modalbox").fancybox();
		$(document).on("submit", '.subscribe-form', function (e) 
			{
				console.log(name_studio);	
				console.log(name_tv_shows);
				e.preventDefault();
				
				var form = $(this);
				//var url= "<?php echo Url::toRoute('site/submitsubscribe'); ?>";
				var email=$('#subscribeform-email').val();
				
				$.ajax({
				            url: url_ajax,
				            type: "POST",
				            //data: {email:email,name_studio:name_studio,name_tv_shows:name_tv_shows},
				            data: form.serialize(),
				            success: function (result) 
				            {
				             	  $('.successful_send').show();
				             	  $('#subscribeform-email').hide();
				             	  $('#send_email').hide();
				             	  $('#subscribe_header').hide();
				             	  $('#subscribe label').hide();
				             	  setTimeout(function() { // скрываем modal через 4 секунды
								$.fancybox.close();
									}, 4000);
				             	  
				            },
				             error: function(jqXHR, textStatus, errorThrown)
		                    {
		                         alert('статус:'+jqXHR.readyState+"  "+ jqXHR.status+"    "+jqXHR.responseText+ "   ");
		                         alert("Что-то пошло не так. Повторите попытку позже! " +textStatus+" "+errorThrown+ " "+jqXHR);
		                    }
				        });
				


			});
		$('.tv_item_studio_subscribe').on('click', function()
		{
			
			var JqObj =$(this);
			tv_item_studio_subscribe(JqObj)
						
		});

		$('.tv_item_real_usa_data_subscribe').on('click', function()
		{
			
			
			var JqObj =$(this);
			tv_item_real_usa_data_subscribe(JqObj);
		});

		$(".tv_item_real_usa_data_subscribe").fancybox();
		$(".tv_item_studio_subscribe").fancybox();

		

		$('.serch').click(function()
 		{
 			$('#serch_input').show('slow');	
 		});
 		
 		
		$(window).scroll(function(){
			if ($(document).height() - $(window).height() <= $(window).scrollTop())
			{
				if((typeof url_ajax_content == 'string')==true)
				{
					

				var count=$('.tv_item_all').length;
				if(scroll_flag==true)
				{
				$('.cssload-container').css('margin-top',$(window).scrollTop()-100);	
				console.log($('.cssload-container').css('margin-top'));
				$('.cssload-container').show();	
				scroll_flag=false;
				
				$.ajax({
				            url: url_ajax_content,
				            type: "POST",
				            data: {count:count},
				            success: function (result) 
				            {
				             	  show_ajax_content(result);
				             	  scroll_flag=true;
				             	  $('.cssload-container').hide();	
				            },
				             error: function(jqXHR, textStatus, errorThrown)
		                    {
		                         alert('статус:'+jqXHR.readyState+"  "+ jqXHR.status+"    "+jqXHR.responseText+ "   ");
		                         alert("Что-то пошло не так. Повторите попытку позже! " +textStatus+" "+errorThrown+ " "+jqXHR);
		                    }
				        });
				    }    
				 }
			}
		});

	});
	function show_ajax_content(content)
	{
		$('.content').append(content);
		$('.tv_item_all').off('mouseover');
		$('.tv_item_all').off('mouseout');
		$('.tv_item_all').on('mouseover', function ()
		{
			var obj=$(this);
			tv_item_all_mouse_over(obj);
		});

		$('.tv_item_all').on('mouseout', function ()
		{
			var obj=$(this);
			tv_item_all_mouse_out(obj);
		});
		
		$('.tv_item_studio_subscribe').off('click');
		$('.tv_item_real_usa_data_subscribe').off('click');
		$('.tv_item_real_usa_data_subscribe').on('click', function()
		{
			
			
			var JqObj =$(this);
			tv_item_real_usa_data_subscribe(JqObj);
		});
		$('.tv_item_real_usa_data_subscribe').on('click', function()
		{
			
			
			var JqObj =$(this);
			tv_item_real_usa_data_subscribe(JqObj);
		});
		
	}
	function get_date_for_ajax(JqClick,IsUSA)
	{
		var JQparent =JqClick.parent();
		if(IsUSA==false)
		{
			var studioname=JQparent.find('.tv_item_studio').html();
			studioname = $.trim(studioname);
			name_studio=studioname;
		}
		else if(IsUSA==true)
		{
			name_studio='original';
		}
		JQparent_parent=JQparent.parent();
		var name=JQparent_parent.find('.tv_item_text').html();
		name = $.trim(name);
		var prob = name.lastIndexOf("\n");
		if(prob!=-1)
			name=name.slice(0,prob);
		name_tv_shows=name;
		$('#subscribeform-name_studio').val(name_studio);
		$('#subscribeform-name_tv_shows').val(name_tv_shows);

	}
	function show_elements_form()
	{
			$('.successful_send').hide();
			$('#subscribeform-email').show();
			$('#send_email').show();
			$('#subscribe_header').show();
			$('#subscribe label').show();
	}
	function tv_item_studio_subscribe(JqObj)
	{
		show_elements_form();
		get_date_for_ajax(JqObj,false);
	}
	function tv_item_real_usa_data_subscribe(JqObj)
	{
			show_elements_form();
			get_date_for_ajax(JqObj,true);			
	}
