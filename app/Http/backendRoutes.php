<?php
	
	Route::group(['prefix' => trinata()->backendUrl , 'middleware' => ['auth','right']] , function(){

		if(\Schema::hasTable('menus'))
		{
			foreach(injectModel('Menu')->where('controller','!=','#')->get() as $row)
			{	
				$path = app_path('Http/Controllers/Backend/'.$row->controller.'.php');

				if(file_exists($path))
				{
					Route::controller($row->slug,'Backend\\'.$row->controller);
				}
					
			}

		}

		
	});

?>