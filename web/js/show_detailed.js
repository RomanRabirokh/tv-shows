$(document).ready(function() 
{
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

})
function tv_item_all_mouse_over(JQthis)
{
	JQthis.find(".tv_item").hide();
	JQthis.find(".tv_item_active").show();
}
function tv_item_all_mouse_out(JQthis)
{
	JQthis.find(".tv_item").show();
	JQthis.find(".tv_item_active").hide();
	setTimeout(5000);
}