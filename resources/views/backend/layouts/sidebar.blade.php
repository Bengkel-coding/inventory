
<?php
    $search = function($eachId,$return,$else="",$status=""){
        $menu = trinata::getMenu();

        if($status == 'child')
        {
            $id = $menu->id;

        }else{
            if($menu->parent_id != null)
            {
                $id =  $menu->parent_id;
            }else{
                $id = $menu->id;
            }
        }
               

        return $eachId == $id ? $return : $else;
    };
?>

  <nav class="px-nav px-nav-left px-nav-fixed">
    <button type="button" class="px-nav-toggle" data-toggle="px-nav">
      <span class="px-nav-toggle-arrow"></span>
      <span class="navbar-toggle-icon"></span>
      <span class="px-nav-toggle-label font-size-11">HIDE MENU</span>
    </button>

    <ul class="px-nav-content">
      <li class="px-nav-box p-a-3 b-b-1" id="demo-px-nav-box">
        <img src="{{ asset(null) }}backend/assets/demo/avatars/1.jpg" alt="" class="pull-xs-left m-r-2 border-round" style="width: 54px; height: 54px;">
        <div class="font-size-16"><span class="font-weight-light">Welcome, </span><strong>{{ getUser()->username }}</strong></div>
        <div class="btn-group" style="margin-top: 4px;">
          <a href="{{ urlBackend('profile/index') }}" class="btn btn-xs btn-primary btn-outline"><i class="fa fa-user"></i></a>
          <a href="{{ url('login/logout') }}" class="btn btn-xs btn-danger btn-outline"><i class="fa fa-power-off"></i></a>
        </div>
      </li>

      @foreach(injectModel('Menu')->whereParentId(null)->orderBy('order','asc')->get() as $row)
        @if(!empty($row->childs->first()->id))
          <li class="px-nav-item px-nav-dropdown {{ $search($row->id,'px-open active') }}">
        @else
          <li class="px-nav-item {{ $search($row->id,'active') }}">
        @endif
        <a href="{{ ($row->controller != '#' ? urlBackend($row->slug.'/index') : '#') }}"><i class="px-nav-icon fa {{(!empty($row->icon)) ? $row->icon : 'fa-clone'}}"></i><span class="px-nav-label">{{ $row->title }}</span></a>
        @if(!empty($row->childs->first()->id))
        <ul class="px-nav-dropdown-menu">
          @foreach($row->childs as $child)
          <li class="px-nav-item {{ $search($child->id,'active','','child') }}"><a href="{{ urlBackend($child->slug.'/index') }}">
            <span class="px-nav-label">{{ $child->title}} </span></a>
          </li>
          @endforeach
        </ul>
        @endif      
      </li>
      @endforeach
      <li class="px-nav-item">
        <a href="{{ url('/') }}" target="_blank"><i class="px-nav-icon ion-monitor"></i><span class="px-nav-label">Go to Web</span></a>
      </li>
    </ul>
  </nav>