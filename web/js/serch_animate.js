$(document).ready(function() 
{
 	$('.serch').on('focus', function()
 	{
 		$('#serch_input').show();	
 	});
	$('#serch_input').change( function (){
		if((typeof url_ajax_serch == 'string')==true)
				{
		$('.cssload-container').css('margin-top',0);			
		$('.cssload-container').show();	
		var serch_str=	$('#serch_input').val();	
				
					
				
				scroll_flag=false;
				$.ajax({
				            url: url_ajax_serch,
				            type: "POST",
				            data: {serch_str:serch_str},
				            success: function (result) 
				            {
				             	  show_ajax_content_serch(result);
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
    });
});


function show_ajax_content_serch(content)
	{
		$('.row_tv').remove();
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
		
	}