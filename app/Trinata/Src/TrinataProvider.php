<?php namespace App\Trinata\Src;

use Illuminate\Support\ServiceProvider;
use App\Trinata\Src\Trinata;

class TrinataProvider extends ServiceProvider
{
	public function boot()
	{
		$this->mergeConfigFrom(config_path('trinata.php'),'trinata');
	}

	public function register()
	{
		$this->app->bind('register-trinata',function(){
			return new Trinata;
		});
	}
}

?>