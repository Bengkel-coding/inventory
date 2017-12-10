<nav class="navbar px-navbar">
    <!-- Header -->
    <div class="navbar-header">
      <a class="navbar-brand px-demo-brand" href="{{ url('/')}}"><img src="{{ asset(null) }}frontend/assets/images/logo.png" height="50px"/></a>
    </div>

    <!-- Navbar togglers -->
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-demo-navbar-collapse" aria-expanded="false"><i class="navbar-toggle-icon"></i></button>

<!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="px-demo-navbar-collapse">
      <ul class="nav navbar-nav">

        
      </ul>

      <ul class="nav navbar-nav navbar-right">

        <li>
          <a href="{{url('/eksternal-link')}}" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="Eksternal Link">
            <i class="fa fa-desktop font-size-20"></i>
          </a>
        </li>
        <li>
          <form class="navbar-form" role="search" method="get" action="{{url('/search')}}">
          <div class="input-group">
            <span class="input-group-addon b-a-0 font-size-16"><i class="ion-search"></i></span>
            <input type="text" placeholder=" Search..." class="form-control p-l-0 b-a-0" name="q">
          </div>
          </form>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          @if(\Auth::user()->photo)
            <img src="{{ asset(null) }}frontend/uploads/{{\Auth::user()->photo}}" alt="" class="px-navbar-image">
          @else
            <img src="{{ asset(null) }}frontend/assets/images/user-icon.png" alt="" class="px-navbar-image">
          @endif
            <span class="hidden-md">{{ $dataUser->name }}</span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{url('/profile')}}"><span class="label label-warning pull-xs-right"><i class="fa fa-asterisk"></i></span>Profile</a></li>
            <!-- <li><a href="pages-account.html">Account</a></li> -->
            <!-- <li><a href="#"><i class="dropdown-icon fa fa-envelope"></i>&nbsp;&nbsp;Messages</a></li> -->
            <li class="divider"></li>
            <li><a href="{{ url('/auth/logout') }}"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="px-navbar-icon fa fa-comments font-size-24"></i>
            <span class="px-navbar-icon-label">Income messages</span>
            <?php
            $counter = 0;
            if (count($notif) > 0) {
              foreach ($notif as $key => $value) {
                if ($value->read == 'pending') $counter += 1;
              }
            } 
            // dd($counter);
            ?>
            <span class="px-navbar-label label @if($counter > 0) label-danger @endif notif-counter" style="padding: 2px;font-size: 11px">{{ $counter }}</span>
          </a>
          <div class="dropdown-menu p-a-0" style="width: 300px;">
            <div id="navbar-messages" style="height: 280px; position: relative;">
              @if($notif)
              @foreach($notif as $event)
              <div class="widget-messages-alt-item" @if($event->read == 'read') style="background-color:#ccc" @endif>
                @if($event->photo)
                <img src="{{ asset('frontend/uploads/'.$event->photo) }}" alt="" class="widget-messages-alt-avatar">
                @else
                <img src="{{ asset('frontend/assets/images/user-icon.png') }}" alt="" class="widget-messages-alt-avatar">
                @endif
                <?php
                $detail = ($event->type == 'agendaku') ? 'view' : 'detail';
                ?>
                <a href="javascript:void(0)" data-href="{{ url($event->type.'/'.$detail.'/'.$event->id.'/notif')}}" class="widget-messages-alt-subject text-truncate" data-id="{{$event->id}}" data-type="{{$event->type}}">{{ $event->name }}</a>
                <div class="widget-messages-alt-description">Dari <a href="javascript:void(0)">{{ $event->postby}}</a></div>
                <!-- <div class="widget-messages-alt-date">2h ago</div> -->
              </div>
              @endforeach
              @endif
              <!-- <div class="widget-messages-alt-item">
                <img src="{{ asset(null) }}frontend/assets/demo/avatars/3.jpg" alt="" class="widget-messages-alt-avatar">
                <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
                <div class="widget-messages-alt-description">from <a href="#">Michelle Bortz</a></div>
                <div class="widget-messages-alt-date">2h ago</div>
              </div>

              <div class="widget-messages-alt-item">
                <img src="{{ asset(null) }}frontend/assets/demo/avatars/4.jpg" alt="" class="widget-messages-alt-avatar">
                <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet.</a>
                <div class="widget-messages-alt-description">from <a href="#">Timothy Owens</a></div>
                <div class="widget-messages-alt-date">2h ago</div>
              </div>

              <div class="widget-messages-alt-item">
                <img src="{{ asset(null) }}frontend/assets/demo/avatars/5.jpg" alt="" class="widget-messages-alt-avatar">
                <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
                <div class="widget-messages-alt-description">from <a href="#">Denise Steiner</a></div>
                <div class="widget-messages-alt-date">2h ago</div>
              </div>

              <div class="widget-messages-alt-item">
                <img src="{{ asset(null) }}frontend/assets/demo/avatars/2.jpg" alt="" class="widget-messages-alt-avatar">
                <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet.</a>
                <div class="widget-messages-alt-description">from <a href="#">Robert Jang</a></div>
                <div class="widget-messages-alt-date">2h ago</div>
              </div>

              <div class="widget-messages-alt-item">
                <img src="{{ asset(null) }}frontend/assets/demo/avatars/3.jpg" alt="" class="widget-messages-alt-avatar">
                <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
                <div class="widget-messages-alt-description">from <a href="#">Michelle Bortz</a></div>
                <div class="widget-messages-alt-date">2h ago</div>
              </div>

              <div class="widget-messages-alt-item">
                <img src="{{ asset(null) }}frontend/assets/demo/avatars/4.jpg" alt="" class="widget-messages-alt-avatar">
                <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet.</a>
                <div class="widget-messages-alt-description">from <a href="#">Timothy Owens</a></div>
                <div class="widget-messages-alt-date">2h ago</div>
              </div>

              <div class="widget-messages-alt-item">
                <img src="{{ asset(null) }}frontend/assets/demo/avatars/5.jpg" alt="" class="widget-messages-alt-avatar">
                <a href="#" class="widget-messages-alt-subject text-truncate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</a>
                <div class="widget-messages-alt-description">from <a href="#">Denise Steiner</a></div>
                <div class="widget-messages-alt-date">2h ago</div>
              </div> -->
            </div>

            <!-- <a href="#" class="widget-more-link">MORE MESSAGES</a> -->
          </div> <!-- / .dropdown-menu -->
        </li>

      </ul>
    </div><!-- /.navbar-collapse -->

  </nav>

  @push('script-js')
    <script type="text/javascript">
  
      $('.text-truncate').click(function(){
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var url = $(this).attr('data-href');
          
        $.ajax({
          type : 'get',
          url : '{{ url("home/open-notif") }}',
          data : {
            id : id,
            type : type,
          },
          success : function(data){
            

            if (data.status == true) {
              window.location.href=url;
            }
            
          },
        });
      })
    </script>
  @endpush