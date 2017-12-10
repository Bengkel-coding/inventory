function openChild(id)
{
	$("[id^='child']").hide();
	$("#child" + id).show();
}