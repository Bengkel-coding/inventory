<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TrinataController extends Controller
{
	public function __construct()
	{

        $Role = injectModel('Role')->where('id',getUser()->role_id)->first();
        $menuRole = arrayMenuRole($Role->role()->get());
        $menuParentRole = arrayParentMenuRole($Role->role()->get());
        $menuPengajuan = injectModel('Menu')->whereParentId(null)->where('slug','pengajuan')->orderBy('order','asc');
        $menuPencarian = injectModel('Menu')->whereParentId(null)->where('slug','pencarian')->orderBy('order','asc');
        
        view()->share('menuPencarian', $menuPencarian);
        view()->share('menuPengajuan', $menuPengajuan);
        view()->share('Role', $Role);
        view()->share('menuRole', $menuRole);
        view()->share('menuParentRole', $menuParentRole);
	}

    public function handleUpload($request,$model,$fieldName,$resize=[])
    {
       $image = $request->file($fieldName);
       
        if(!empty($image))
        {
             if(!empty($model->$fieldName))
                {
                    @unlink(public_path('contents/'.$model->$fieldName));
                }

            $imageName = randomImage().'.'.$image->getClientOriginalExtension();

            $image = \Image::make($image);

            if(!empty($resize))
            {
            	$image = $image->resize($resize[0],$resize[1]);
            }

            $image = $image->save(public_path('contents/'.$imageName));

            return $imageName;

        }else{

            return $model->$fieldName;
        }
    }


    public function save($model,$inputs)
    {
    	$model->create($inputs);

    	return redirect(urlBackendAction('index'))->with('success','Data has been saved');
    }

    public function update($model,$inputs)
    {
    	$model->update($inputs);

    	return redirect(urlBackendAction('index'))->with('success','Data has been updated');
    }

    public function delete($model,$images=[])
    {
        try
        {
            $model->delete();

            foreach($images as $image)
            {
                @unlink(public_path('contents/'.$image));
            }

            return redirect(urlBackendAction('index'))->with('success','Data has been deleted');
            
        }catch(\Exception $e){
        
            return redirect(urlBackendAction('index'))->with('info','Data cannot be deleted');
        }

        	
    }

    public function publish($model)
    {
        if($model->status == 'y')
        {
            $status = 'n';
            $msg = 'Data has been Un Published';
        
        }else{
            $status = 'y';
            $msg = 'Data has been Published';
        }

        $model->update([
            'status' => $status,
        ]);

        return redirect(urlBackendAction('index'))->withSuccess($msg);
    }

    public function insertOrUpdate($model,$inputs,$redirect = ['redirect'=>true,'url'=>'index'])
    {
        if(!empty($model->id))
        {
            $model->update($inputs);
            $message = "updated";
        }else{
            $model->create($inputs);
            $message = "saved";
        }

        if($redirect['redirect'] == true)
        {
            return redirect(urlBackendAction($redirect['url']))
                ->with('success','Data has been '.$message);
        }
    }

    
}
