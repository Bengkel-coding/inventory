<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Menu;
use App\Models\Action;
use App\Models\MenuAction;
use DB;

class MenuController extends TrinataController
{
    public function __construct(Menu $model,Action $action,MenuAction $detail)
    {
        parent::__construct();

        $this->model = $model;
        $this->action = $action;
        $this->detail = $detail;
    }

    public function getIndex()
    {
        $model = $this->model;

        return view('backend.menu.index',compact('model'));
    }

    public function parents()
    {
        $parents = $this->model->whereParentId(null)->orderBy('order')->lists('title','id')->toArray();

        return [null => 'This Parent'] + $parents;
    }

    public function getCreate()
    {

        $model = $this->model;
        $parents = $this->parents();
        return view('backend.menu._form',compact('model','parents'));
    }

    public function handleRequest($request,$model)
    {
        $inputs = $request->all();

        if(empty($model->id))
        {
            $inputs['slug'] = str_slug($request->title);
        }
        
        if(empty($request->parent_id))
        {
            $inputs['parent_id'] = null;
        }

        return $inputs;
    }

    public function postCreate(Request $request)
    {
        $this->validate($request,$this->model->rules());

        $model = $this->model;

        $requestAll = $this->handleRequest($request, $model);
        
        $model->create($requestAll);

        return redirect(urlBackendAction('index'))->withSuccess('Data has been saved');
    }

    public function getUpdate($id)
    {

        $model = $this->model->findOrFail($id);
        $parents = $this->parents();
        return view('backend.menu._form',compact('model','parents'));
    }

    public function postUpdate(Request $request , $id)
    {
        $this->validate($request,$this->model->rules($id));

        $model = $this->model->findOrFail($id);

        $requestAll = $this->handleRequest($request,$model);
        
        $model->update($requestAll);

        return redirect(urlBackendAction('index'))->withSuccess('Data has been updated');
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);

        $model->delete();

        return redirect(urlBackendAction('index'))->withSuccess('Data has been deleted');

    }

    public function getView($id)
    {
        $model = $this->model->findOrFail($id);

        $actions = $this->action->all();
        
        $detail = $this->detail;

        $cek = function($id) use ($model,$detail){

            $check = $detail->whereMenuId($model->id)->whereActionId($id)->first();

            if(!empty($check->id))
            {
                if($check->action_id == $id)
                {
                    return 'checked';
                }
            }
           
        };
        
       return view('backend.menu.view',compact('model','actions','cek'));
    }

    public function postView(Request $request , $id)
    {
        $model = $this->model->findOrFail($id);

        $count =  count($request->action);

        DB::beginTransaction();

        try
        {
            $this->detail->whereMenuId($model->id)->delete();
            
            for($a=0;$a<$count;$a++)
            {
                $this->detail->create([
                    'menu_id'   => $model->id,
                    'action_id' => $request->action[$a],
                ]);
            }

            DB::commit();

            return redirect(urlBackendAction('index'))->withSuccess('Data has been updated'); 

        }catch(\Exception $e){

            DB::rollback();

            return redirect(urlBackendAction('index'))->withInfo('Transaction Failed! : '.$e->getMessage());
        }
            

    }
}
