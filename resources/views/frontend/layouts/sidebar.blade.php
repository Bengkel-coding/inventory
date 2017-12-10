
  <nav class="px-nav px-nav-left px-nav-fixed">
    <button type="button" class="px-nav-toggle" data-toggle="px-nav">
      <span class="px-nav-toggle-arrow"></span>
      <span class="navbar-toggle-icon"></span>
      <span class="px-nav-toggle-label font-size-11">HIDE MENU</span>
    </button>

    <ul class="px-nav-content">
      <li class="px-nav-box p-a-3 b-b-1 text-xs-center" id="demo-px-nav-box">
      @if(\Auth::user()->photo)
        <img src="{{ asset(null) }}frontend/uploads/{{\Auth::user()->photo}}" alt="" class="border-round" style="height: 100px;">
      @else
        <img src="{{ asset(null) }}frontend/assets/images/user-icon.png" alt="" class="border-round" style="height: 100px;">
      @endif
        <br/>
        <span class="font-weight-light">Selamat Datang </span><br/>
        <strong>{{ $dataUser->name }}</strong>
       <!--  <div class="font-size-16"><span class="font-weight-light">Welcome, </span><strong>{{ Auth::user()->name }}</strong></div> -->
       <br/>
        
      </li>
      <li class="px-nav-item {{checkActive('home',1,'active')}}">
        <a href="{{url('/home')}}"><i class="px-nav-icon fa fa-home"></i><span class="px-nav-label">Dashboard</span></a>
      </li>
      <li class="px-nav-item {{checkActive('agenda-pimpinan',1,'active')}}">
        <a href="{{url('/agenda-pimpinan')}}"><i class="px-nav-icon fa fa-clipboard"></i><span class="px-nav-label">Agenda Pimpinan</span></a>
      </li>
      <li class="px-nav-item px-nav-dropdown {{checkActive('event-calendar',1,'px-open')}}">
        <a href="#"><i class="px-nav-icon fa fa-calendar"></i><span class="px-nav-label">Agenda BSN</span></a>
        <ul class="px-nav-dropdown-menu">
          <li class="px-nav-item {{checkActive('event-calendar',1,'active')}}"><a href="{{url('/event-calendar')}}"><span class="px-nav-label">Event Umum</span></a></li>
          <li class="px-nav-item {{checkActive('eventku',2,'active')}}"><a href="{{url('/event-calendar/eventku')}}"><span class="px-nav-label">EventKu</span></a></li>
        </ul>
      </li>
      <li class="px-nav-item {{checkActive('agendaku',1,'active')}}">
        <a href="{{url('/agendaku')}}"><i class="px-nav-icon ion-clipboard"></i><span class="px-nav-label">Agendaku</span></a>
      </li>
      <li class="px-nav-item px-nav-dropdown {{checkActive('pengumuman',1,'px-open')}}">
        <a href="#"><i class="px-nav-icon fa fa-bullhorn"></i><span class="px-nav-label">Pengumuman</a>

        <ul class="px-nav-dropdown-menu">
          <li class="px-nav-item {{checkActive('pengumuman-umum',1,'active')}}"><a href="{{url('/pengumuman-umum')}}"><span class="px-nav-label">Pengumuman Umum</span></a></li>
          <li class="px-nav-item {{checkActive('pengumumanku',2,'active')}}"><a href="{{url('/pengumuman/pengumumanku')}}"><span class="px-nav-label">Pengumumanku</span></a></li>
        </ul>
      </li>
      <li class="px-nav-item px-nav-dropdown {{checkActive('pengumuman',1,'px-open')}}">
        <a href="#"><i class="px-nav-icon fa fa-comments"></i><span class="px-nav-label">Forum</span></a>

        <ul class="px-nav-dropdown-menu">
          <li class="px-nav-item"><a href="{{url('/forum-umum')}}"><span class="px-nav-label">Forum BSN</span></a></li>
          <li class="px-nav-item"><a href="{{url('/forum-group')}}"><span class="px-nav-label">Forum Group</span></a></li>
        </ul>
      </li>
      <li class="px-nav-item">
        <a href="{{url('/inbox')}}"><i class="px-nav-icon fa fa-envelope-o"></i><span class="px-nav-label">Inbox @if($inboxNotif>0)<span class="label label-danger">{{$inboxNotif}}</span>@endif</span></a>
      </li>
      <!-- <li class="px-nav-item px-nav-dropdown {{checkActive('inventaris',1,'px-open')}}">
        <a href="#"><i class="px-nav-icon fa fa-cubes"></i><span class="px-nav-label">Invetarisasi(admin cms)</span></a>

        <ul class="px-nav-dropdown-menu">
          <li class="px-nav-item {{checkActive('inventaris',1,'active')}}"><a href="#"><span class="px-nav-label">Daftar Kategori</span></a></li>
          <li class="px-nav-item {{checkActive('inventaris',1,'active')}}"><a href="{{url('/inventaris/list')}}"><span class="px-nav-label">Daftar Inventaris</span></a></li>
          <li class="px-nav-item {{checkActive('peminjaman',2,'active')}}"><a href="{{url('/inventaris/listpeminjaman')}}"><span class="px-nav-label">Daftar Peminjaman</span></a></li>
        </ul>
      </li> -->
      <li class="px-nav-item px-nav-dropdown {{checkActive('inventaris',1,'px-open')}}">
        <a href="#"><i class="px-nav-icon fa fa-cubes"></i><span class="px-nav-label">Invetarisasi</span></a>

        <ul class="px-nav-dropdown-menu">
          <li class="px-nav-item {{checkActive('inventaris',1,'active')}}"><a href="{{url('/inventaris')}}"><span class="px-nav-label">Daftar Inventaris</span></a></li>
          <li class="px-nav-item {{checkActive('peminjaman',2,'active')}}"><a href="{{url('/inventaris/peminjaman')}}"><span class="px-nav-label">Daftar Peminjaman</span></a></li>
        </ul>
      </li>
      <li class="px-nav-item {{checkActive('agendaku',1,'active')}}">
        <a href="{{url('/berkas-digital')}}"><i class="px-nav-icon ion-social-buffer"></i><span class="px-nav-label">Berkas Digital</span></a>
      </li>
      <li class="px-nav-item px-nav-dropdown {{checkActive('knowledge',1,'px-open')}}">
        <a href="#"><i class="px-nav-icon fa fa-globe"></i><span class="px-nav-label">Knowledge</span></a>

        <ul class="px-nav-dropdown-menu">
          <li class="px-nav-item {{checkActive('knowledge-umum',1,'active')}}"><a href="{{url('/knowledge-umum')}}"><span class="px-nav-label">Knowledge Umum</span></a></li>
          <li class="px-nav-item {{checkActive('knowledgeku',2,'active')}}"><a href="{{url('/knowledge/knowledgeku')}}"><span class="px-nav-label">Knowledgeku</span></a></li>
        </ul>
      </li>      
      <li class="px-nav-item">
        <a href="{{url('/takpin')}}"><i class="px-nav-icon fa fa-file"></i><span class="px-nav-label">Tapkin</span></a>
      </li>
    </ul>
  </nav>