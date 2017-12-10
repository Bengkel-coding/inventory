@extends('app')

@section('content')

  <div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
      <li class="active">Dashboard</li>
    </ol>

    <div class="row">
      <div class="col-md-5 fadeIn animated">   
        <div class="panel panel-primary panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-picture-o"></i>Event Terbaru</span>
          </div>   
          <div id="owl-carousel-basic" class="owl-carousel">
            <img src="assets/images/carousel/image-3.jpg"/>
            <img src="assets/images/carousel/image-2.jpg"/>
            <img src="assets/images/carousel/image-3.jpg"/>
            <img src="assets/images/carousel/image-2.jpg"/>
          </div>
        </div>
      </div>

      <div class="col-md-7 fadeIn animated"> 
        <div class="panel panel-primary panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-newspaper-o "></i>Event Terbaru</span>
          </div> 
          <div class="row p-a-3">
            <div class="col-md-12"> 
            <div class="font-size-24 font-weight-bold">Pengenalan SPK 2017</div>
            </div>
            <div class="col-md-12 p-b-2 "> 
            <div class="font-size-14">Jakarta, Rabu - 19 januari 2017</div>
            </div>
            <div class="col-md-5"> 
            <img src="assets/images/carousel/image-1.jpg" width="100%" />
            </div>
            <div class="col-md-7"> 
              <p>Badan Standarisasi Nasional (BSN) pada tanggal 13 Juli 2017 bersama Universitas Muhammadiyah Sukabumi (UMMI) melakukan Peresmian SNI Corner. Diharapkan dengan adanya SNI </p>
            </div>

          </div>
          <a href="#" class="widget-more-link">SEE MORE</a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-5">
      <div class="col-md-12 fadeIn animated">

        <!-- Support tickets -->

        <div class="panel panel-success">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-bullhorn"></i>Pengumuman Terbaru</span>
          </div>

          <div id="support-tickets" class="ps-block">

            <div class="widget-support-tickets-item">
              <a href="#" title="" class="widget-support-tickets-title">
                Kurma Spesial
              </a>
              <span class="widget-support-tickets-info">1 week 35 mins ago, By <a href="#" title="">Ovan - Trinata</a></span>
            </div>

            <div class="widget-support-tickets-item">
              <a href="#" title="" class="widget-support-tickets-title">
                Berita Duka Cita
              </a>
              <span class="widget-support-tickets-info">2 week 17 mins ago, By  <a href="#">Arum - Trinata</a></span>
            </div>

            <div class="widget-support-tickets-item">
              <a href="#" title="" class="widget-support-tickets-title">
                Liburan Bersama 13 juli 2017
              </a>
              <span class="widget-support-tickets-info">3 week 35 mins ago, By <a href="#">Junaedi - Trinata</a></span>
            </div>
          </div>

          <a href="#" class="widget-more-link">SEE MORE</a>
        </div>

        <!-- / Support tickets -->

      </div>
      <div class="col-md-12 fadeIn animated">

        <!-- Recent comments / threads -->

        <div class="panel panel-warning">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-comments text-danger"></i>Forum</span>
            <ul class="nav nav-tabs nav-xs">
              <li class="active"><a href="#umum" data-toggle="tab">Forum Umum</a></li>
              <li><a href="#bsn" data-toggle="tab">Forum Group</a></li>
            </ul>
          </div>

          <div class="tab-content p-a-0">
            <div id="umum" class="ps-block tab-pane fade in active">

              <div class="widget-support-tickets-item">
                <a href="#" title="" class="widget-support-tickets-title">
                  Jagalah sehatmu sebelum Sakitmu
                </a>
                <span class="widget-support-tickets-info">20 Oktober 2017 | By : <a href="#" title="">Ovan - Trinata</a></span>
              </div>

              <div class="widget-support-tickets-item">
                <a href="#" title="" class="widget-support-tickets-title">
                  Gagal itu pasti, Menyerah jangan
                </a>
                <span class="widget-support-tickets-info">10 September 2017 | By : <a href="#">Arum - Trinata</a></span>
              </div>

              <div class="widget-support-tickets-item">
                <a href="#" title="" class="widget-support-tickets-title">
                  Hidup itu tidak mati
                </a>
                <span class="widget-support-tickets-info">1 Agustus 2017 | By : <a href="#">Junaedi - Trinata</a></span>
              </div>
              <a href="#" class="widget-more-link">SEE MORE</a>
            </div>

            <div id="bsn" class="ps-block tab-pane fade">
              <div class="widget-support-tickets-item">
                <a href="#" title="" class="widget-support-tickets-title">
                  Tata Tertib BSN
                </a>
                <span class="widget-support-tickets-info">11 Agustus 2017 | By :  <a href="#" title="">Ovan - Trinata</a></span>
              </div>

              <div class="widget-support-tickets-item">
                <a href="#" title="" class="widget-support-tickets-title">
                  Event Bulanan di BSN
                </a>
                <span class="widget-support-tickets-info">12 Juni 2017 | By :  <a href="#">Arum - Trinata</a></span>
              </div>

              <div class="widget-support-tickets-item">
                <a href="#" title="" class="widget-support-tickets-title">
                  Aturan Cuti Bersama 2017
                </a>
                <span class="widget-support-tickets-info">13 Mei 2017 | By :  <a href="#">Junaedi - Trinata</a></span>
              </div>
              <a href="#" class="widget-more-link">SEE MORE</a>

            </div>
          </div>
        </div>

        <!-- / Recent comments / threads -->

      </div>
      </div>
      <div class="col-md-7 fadeIn animated">
        <div class="panel panel-success panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-calendar"></i>Jadwal Kegiatan Bulan ini</span>
          </div>

          <div id='calendar' class="p-a-1"></div>
          <a href="#" class="widget-more-link">SEE MORE</a>
        </div>

      </div>
    </div>
  </div>
@endsection
