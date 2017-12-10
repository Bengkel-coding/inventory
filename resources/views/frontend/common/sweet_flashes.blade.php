<?php
	$div = function($class,$msg){
		return '
			<script>
				swal({
					title : "'.ucfirst($class).'",
					type : "'.$class.'",
					text : "'.$msg.'"
				});
			</script>

		';
	};

	$actions = ['success','info','danger','warning'];

	foreach($actions as $row)
	{
		if(Session::has($row))
		{
			echo $div($row , Session::get($row));
		}
	}

?>



