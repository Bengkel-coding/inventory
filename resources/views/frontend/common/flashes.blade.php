<?php
	$div = function($class,$msg){
		return '
			<div class = "alert alert-'.$class.'" >
				'.$msg.'
			</div>
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



