<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cultural Hub</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://vjs.zencdn.net/7.2.3/video-js.css" rel="stylesheet">

  <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
  <script src="https://vjs.zencdn.net/ie8/ie8-version/videojs-ie8.min.js"></script>
  {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> --}}
  <!--add jQuery -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{url('/home')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>HB</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Cultural</b>Hub</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
    
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('images/avatar2.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
<!--       <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> -->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header">HEADER</li> -->
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Settings</span></a></li>
        <li><a href="{{route('timeline')}}"><i class="fa fa-link"></i> <span></span>Timeline</a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Subscription Offer</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('subscriptions')}}">Specials</a></li>
            <li><a href="#">Language</a></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        CULTURAL HUB
        <small>culture as it matters</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      culture as it matters
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Culturalhub</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->

</div>





<script src="{{asset('js/app.js')}}"></script>
<script>
$('div.alert').not('.alert-success').delay(3000).fadeOut(350);
</script>
<!--add script for pagination here (jquery)-->
<script>
$(document).ready(function(){


$(window).scroll(fetchDiscussions);

function fetchDiscussions(){
  var page= $('.endless-pagination').data('next-page');

  if(page!==null){
    clearTimeout($.data(this,"scrollCheck"));
    $.data(this,"scrollCheck",setTimeout(function(){
      var scroll_position_for_discussions_load=$(window).height()+$(window).scrollTop() + 100;

      if(scroll_position_for_discussions_load >= $(document).height()){
        $.get(page,function(data){
          $('.discussions').append(data.discussion_details);
          $('.endless-pagination').data('next-page',data.next_page);
        });
      }
    },350))

  }

}
})
</script>



{{-- <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
</script> --}}

<script src="https://vjs.zencdn.net/7.2.3/video.js"></script>

<script>
  $(document).ready(function(){
  $('#user_comment').keydown(function(event){
    if(event.which==13){
      event.preventDefault();
      
      var searchitem=$('#user_comment').val();
      var comment_creator=$('#comment_creator').val();
      var discussion_id=$('#discussion_id').val();
      
               $.ajax({
                type:"GET",
                url:"/postcomment",
                
                data:{
                  discussion_id:discussion_id,
                  comment_created:searchitem,
                  comment_creator:comment_creator
                },
                success:showComment
              });
               


             }});

    //describe the showComment function 
    function showComment(data){
      $.each(data,function(item){
        $('#comments_loaded').append("<div class='box-comment'><img class='img-circle img-sm' src=" + 'storage/discussion_images/' + data[item]['profile_pic'] + "><div class='comment-text'><span class='username'>" + data[item]['name'] + "<span class='text-muted pull-right'>" + data[item]["created_at"] + "</span></span>" + data[item]["comments"]+ "</div></div>");
        $('#user_comment').val("");

      });
    }
});
  
</script>

</body>
</html>