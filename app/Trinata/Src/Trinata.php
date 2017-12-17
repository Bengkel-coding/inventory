<?php namespace App\Trinata\Src;

class Trinata
{
	public function __construct()
	{
		$this->backendUrl = config('trinata.backendUrl');
		$this->backendName = config('trinata.backendName');
	}
	
	public function hello()
	{
		return 'TRINATA';
	}

	public function config($config)
	{
		return config('trinata.'.$config);
	}

	public function buttonUpdate($params)
	{
		if($this->right('update') == 'true')
		{
			$url = urlBackendAction('update/'.$params);
			
			return '<a href = "'.$url.'" class = "btn btn-info btn-sm"><span class="fa fa-pencil"></span></a>';	
		}
	}

	public function buttonDelete($params)
	{	
		if($this->right('delete') == 'true')
		{
			$url = urlBackendAction('delete/'.$params);
			
			return '<a href = "'.$url.'" class = "btn btn-danger btn-sm" onclick = "return confirm(\'Are You sure want to delete this data?\')"><span class="fa fa-trash"></span></a>';	
		}
	}

	public function buttonView($params)
	{
		if($this->right('view') == 'true')
		{
			$url = urlBackendAction('view/'.$params);
			
			return '<a href = "'.$url.'" class = "btn btn-warning btn-sm"><span class="fa fa-search"></span></a>';	
		}
	}

	public function buttonCreate($params="")
	{
		if($this->right('create') == 'true')
		{
			$url = urlBackendAction('create/'.$params);
			return '<a href = "'.$url.'" class = "btn btn-primary btn-sm"><span class="fa fa-plus"></span> Add New</a>';
		}
	}

	public function buttonPublish($params,$status = true)
	{
		if($this->right('publish') == 'true')
		{
			$url = urlBackendAction('publish/'.$params);
			$active =  '<a onclick = "return confirm(\'are you sure want to un publish this data ?\')" href = "'.$url.'" class = "btn btn-default btn-sm"><span class="fa fa-eye"></span></a>';
			$notActive =  '<a onclick = "return confirm(\'are you sure want to  publish this data ?\')" href = "'.$url.'" class = "btn btn-default btn-sm"><span class="fa fa-eye-slash"></span></a>';
			
			if($status == true)
			{
				return $active;
			}else{
				return $notActive;
			}
		}
	}

	public function buttons($id , $array = [] , $status = false)
	{
		($array == []) ? $array = ['update','view','delete','publish'] : $array = $array;

		$str = "";

		foreach($array as $button)
		{
			if($button == 'update')
			{
			
				$str .= $this->buttonUpdate($id).' ';
			
			}elseif($button == 'view'){
				
				$str .= $this->buttonView($id).' ';
			
			}elseif($button == 'delete'){
				
				$str .= $this->buttonDelete($id).' ';

			}elseif($button == 'publish'){
				

				$str .= $this->buttonPublish($id,$status).' ';
			
			}
		}

		return $str;
	}

	public function getMenu()
	{
		$permalink = request()->segment(2);

		$model = injectModel('Menu')->whereSlug($permalink)->first();
		
		return $model;
	}

	public function getAction($slug = "")
	{
		if(!empty($slug))
		{
			$slug = $slug;
		}else{
			$slug = request()->segment(3);
		}

		$model = injectModel('Action')->whereSlug($slug)->first();

		if(!empty($model->id))
		{
			return $model;
		}else{
			return injectModel('Action');
		}
			
	}

	public function titleActionForm()
	{	
		$actions = $this->getAction();

		$title =  $actions->title.' '.$this->getMenu()->title;

		return $title;
	}

	public function right($action = "")
	{

		if(!empty($action))
		{
			$action = $action;
		}else{
			$action = request()->segment(3);
		}

		$menu = $this->getMenu();

		if($menu->slug == 'dashboard')
		{
			return 'true';
		}else{
			$modelAction = $this->getAction($action);

			if(!empty($modelAction->id))
			{
				$role = injectModel('Role')->find(getUser()->role_id);

				$right = $role->menu_actions()->whereMenuId($menu->id)->whereActionId($modelAction->id)->first();

				if(!empty($right->id))
				{
					return 'true';
				}else{
					return 'false';
				}
			}else{
				return 'true';
			}
				
		}
		
	}

	public function addMenu($data = [],$actions=[])
	{	
		\DB::beginTransaction();
		try
		{
			$model = injectModel('Menu');
			
			$cek = $model->whereSlug($data['slug'])->first();

			if($data['parent_id'] != null)
			{
				$parent = $model->whereSlug($data['parent_id'])->first();
				$data['parent_id'] = $parent->id;
			}

			if(empty($cek->id))
			{
				$save = $model->create($data);

				$action = injectModel('Action');
				
				$menuAction = injectModel('MenuAction');

				$right = injectModel('Right');

				foreach($actions as $row)
				{
					$cekAction = $action->whereSlug($row)->first();

					if(!empty($cekAction->id))
					{
						$menuActionSave = $menuAction->create([
							'menu_id'		=> $save->id,
							'action_id'		=> $cekAction->id,
						]);

						$right->create([
							'role_id'			=> 1,
							'menu_action_id'	=> $menuActionSave->id,
						]);
					}
				}

			}

			\DB::commit();
		
		}catch(\Exception $e){
			\DB::rollback();
			echo "menu gagal disimpan : ".$e->getMessage();
		}

	}

	public function updateMenu($data = [],$actions=[])
	{
		$model = injectModel('Menu');
		
		if($data['parent_id'] != null)
		{
			$parent = $model->whereSlug($data['parent_id'])->first();
			$data['parent_id'] = $parent->id;
		}

		//$parent = $model->whereSlug($data['parent_id'])->first();
		
		$update = $model->whereSlug($data['slug'])->first();

		//$data['parent_id'] = $parent->id;

		$update->update($data);

		$action = injectModel('Action');
			
		$menuAction = injectModel('MenuAction');

		$right = injectModel('Right');

		\DB::table('menu_actions')->where('menu_id',$update->id)->delete();

		foreach($actions as $row)
		{
			$cekAction = $action->whereSlug($row)->first();

			if(!empty($cekAction->id))
			{
				$menuActionSave = $menuAction->create([
					'menu_id'		=> $update->id,
					'action_id'		=> $cekAction->id,
				]);
				
				$right->create([
					'role_id'			=> 1,
					'menu_action_id'	=> $menuActionSave->id,
				]);
			}
		}

	}

	public function deleteMenu($slug)
	{
		$model = injectModel('Menu')->whereSlug($slug)->first()->delete();
	}


	public function htmlImage($name,$imagePath="",$model="")
    {
        $paramModel = get_class($model);
        $paramModel = explode("\\", $paramModel)[2];
        $display = !empty($model->{$name}) ? 'inherit' : 'none';
       

        $image=\Form::file($name,['id'=>$name,'onchange'=>"readURL(this,'image_$name')",'id'=>$name]);
        
        $image.= \Html::image(asset('contents/'.$imagePath),'',['height'=>100,'width'=>100,'id'=>'image_'.$name,'style'=>'display:'.$display]);
        
        
        $image.="<div style = 'cursor:pointer;display:$display;' id = 'div_image_$name'>";
            $image.= \Html::link("#","Delete",['onclick'=>"hide_image('$paramModel','$model->id','$name')"]);
        $image.="</div>";
        
        return $image;                       
    }
}