<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\User;
use App\Http\Controllers\Controller;

class TrinataController extends Controller
{
    public function __construct()
    {
    	if (\Auth::user()) {
            $this->usersData = new User;
            
            $notif = $this->getNotif();
            $dataUser = $this->usersData
                    ->select('users.*','p.nip','p.echelon_name','p.name')
                    ->join('member_profiles as p','p.user_id','=','users.id')
                    ->where('users.id',\Auth::user()->id)->first();
            $inbox = $this->inboxNotif
                    ->where('reciever_id',\Auth::user()->id)
                    ->where('read_status',0)
                    ->count();

            \View::share('inboxNotif', $inbox);  
            \View::share('notif', $notif);  
            \View::share('dataUser', $dataUser);  

        } 
    }

    public function handleUploadFile($request,$model,$file_name,$pathFileUpload='frontend/uploads/files/')
    {
       $filename = $request->file($file_name);
       
                // dd($filename,$_FILES);
        if(!empty($filename))
        {
             if(!empty($model->$file_name ))
                {
                    @unlink(public_path($pathFileUpload.$model->$file_name));
                }
                // dd($filename,$_FILES);
            $nameOriginal = str_replace(".".$filename->getClientOriginalExtension(), "", $filename->getClientOriginalName());

            $imageName = $nameOriginal."_".randomImage().'.'.$filename->getClientOriginalExtension();
            
            $destinationPath = public_path($pathFileUpload);
            Input::file($file_name)->move($destinationPath, $imageName);

            return $imageName;

        }else{

            return $model->$file_name;

        }
    }

    public function handleUploadFiles($request,$model,$file_name,$pathFileUpload='frontend/uploads/files/')
    {
       $filename = $request->file($file_name);
       $filename = $filename[0];
        if(!empty($filename))
        {
             if(!empty($model->$file_name ))
                {
                    @unlink(public_path($pathFileUpload.$model->$file_name));
                }
                // dd($_FILES);
            $nameOriginal = str_replace(".".$filename->getClientOriginalExtension(), "", $filename->getClientOriginalName());

            $imageName = $nameOriginal."_".randomImage().'.'.$filename->getClientOriginalExtension();
            
            $destinationPath = public_path($pathFileUpload);
            dd(Input::file($file_name)->move($destinationPath, $imageName));
            Input::file($file_name)->move($destinationPath, $imageName);

            return $imageName;

        }else{

            return $model->$file_name;

        }
    }

    public function logNotif($id, $type)
    {
        // $log = \App\Models\PopupLog::whereUserId(\Auth::user()->id)->whereType($type)->whereTypeId($id)->count();
        //     if ($log < 1) \App\Models\PopupLog::create(['user_id'=>\Auth::user()->id, 'type_id'=>$id, 'type'=>$type, 'panel'=>'notification', 'status'=>'read']);
    }

    public function getNotif()
    {
        /*$data = ['event'=>[], 'agenda'=>[], 'announcement'=>[]];

        $log = \App\Models\PopupLog::whereUserId(\Auth::user()->id)->wherePanel('notification')->get();
        if ($log) {
            foreach ($log as $key => $value) {
                $data[$value->type][] = $value->type_id;
            }
        }
        // dd($data);
        $eventData = (count($data['event']) > 0) ? implode(',', $data['event']) : 'null'; 
        $announcementData = (count($data['announcement']) > 0) ? implode(',', $data['announcement']) : 'null'; 
        $agendaData = (count($data['agenda']) > 0) ? implode(',', $data['agenda']) : 'null'; 

        $events = \DB::table('member_events')
                        ->select('member_events.id as id', 'member_events.user_id as user_id', 'member_events.name as name', 'member_events.created_at as created_at', 
                            \DB::raw("if (member_events.id in (".$eventData."), 'read', 'pending') as 'read', 'event-calendar' as type, users.name as postby, users.photo")
                            )
                        ->join('users', 'member_events.user_id', '=', 'users.id')
                        ->where('member_events.status', 'active')
                        ->orderBy('member_events.created_at', 'desc');
        
        $announcements  = \DB::table('member_announcements')
                        ->select('member_announcements.id as id', 'member_announcements.user_id as user_id', 'member_announcements.name as name', 'member_announcements.created_at as created_at', 
                            \DB::raw("if (member_announcements.id in (". $announcementData ."), 'read', 'pending') as 'read', 'pengumuman' as type, users.name as postby, users.photo")
                            )
                        ->join('users', 'member_announcements.user_id', '=', 'users.id')
                        ->where('status', 'publish')
                        ->orderBy('created_at', 'desc');
        
        $agendas  = \DB::table('member_agendas')
                        ->select('member_agendas.id as id', 'member_agendas.user_id as user_id', 'member_agendas.name as name', 'member_agendas.created_at as created_at', 
                            \DB::raw("if (member_agendas.id in (".$agendaData."), 'read', 'pending') as 'read', 'agendaku' as type, users.name as postby, users.photo")
                            )
                        ->join('users', 'member_agendas.user_id', '=', 'users.id')
                        ->where('status', 'active')
                        ->orderBy('created_at', 'desc');

        $dataArr = $events->union($announcements);
        $dataArr = $dataArr->union($agendas)->orderBy('created_at', 'desc')->take(10)->get();
        // dd($dataArr);
        
        return $dataArr;*/
    }
}
