
<nav class="navbar px-navbar">
    <!-- Header -->
    <div class="navbar-header">
    <a class="navbar-brand px-demo-brand" href="{{ urlBackend('dashboard/index') }}">CMS Panel </a>
    </div>
    <!-- Navbar togglers -->
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-demo-navbar-collapse" aria-expanded="false"><i class="navbar-toggle-icon"></i></button>

<!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="px-demo-navbar-collapse">
      <ul class="nav navbar-nav">
    <li>   
      <a href="{{ urlBackend('dashboard/index') }}">Home</a>  
    </li>   
    <li>   
      <a href="{{ urlBackend('dashboard/index') }}">Pencarian Material</a>
    </li>   



    @foreach($menuPengajuan->get() as $row)

    @if(!empty($row->childs->first()))
    <li  class="{{ searchMenu($row->id,'active') }}">   
      <a  href="{{ urlBackend($row->childs->first()->slug.'/index') }}">{{$row->title}}</a>
    </li> 
    @endif      

    @endforeach    
      </ul>

      <ul class="nav navbar-nav navbar-right">
      <li>        
          <a href="{{ urlBackend('profile/index') }}" >
            <span class="hidden-md">Profile</span>
          </a>
      </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="hidden-md">{{ getUser()->username }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- <li><a href="{{ urlBackend('profile/index') }}"><span class="label label-warning pull-xs-right"><i class="fa fa-asterisk"></i></span>Profile</a></li> -->
            <!-- <li class="divider"></li> -->
            <li><a href="{{ url('login/logout') }}"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->

  </nav>