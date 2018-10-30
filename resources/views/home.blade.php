@extends('layouts.master')
<?php
use \App\Http\Controllers\HomeController;
?>

@section('content')
    <section class="content">
      <!-- Small boxes (Stat box) -->   
        @if(Session::has('discussion_created'))
            <div class="alert alert-success"><em> {!! session('discussion_created') !!}</em></div>
        @endif
       {{--  @if(session('no-users'))
            <div class="alert alert-danger"><em> {!! session('no-users')!!}</em></div>

        @endif --}}
        <div class="alert alert-danger"><em>{{$no_users}}</em></div>
{{--       <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$num_following_this_user->total_following_user}}</h3>

              <p>Followers</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$num_of_followings->total_user_following}}<sup style="font-size: 20px"></sup></h3>

              <p>Following</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$total_discussion_made->total_discussion}}</h3>

              <p>Discuss by You</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Create Discussion <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$total_discussions->all_discussions}}</h3>

              <p>Total Discussions</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div> --}}
      <div class="row" style="background-color:rgb(60, 141, 188);margin-top:5px; ">
            <?php foreach($users_to_subscribe_to as $subscribe_to_user) { ?>
            <div class="col-lg-3 col-xs-6" style="padding-top:10px;">
            <div><h3 style="background-color: white; text-align:center;">SPECIAL OFFER </h3>
                <h5 style="background-color: white;">{{$subscribe_to_user["subscription_count"]}} {{($subscribe_to_user["subscription_count"])>0 ? " Subs" : " Sub, be first"}}</h5>

            <div class="info-box bg-red">
            <span class="info-box-icon" style="height:140px;"><i class="fa fa-comments-o"></i></span>

            <div class="info-box-content">
              <p>Peep in to learn about <strong>{{$subscribe_to_user["topic"]}}</strong></p>
              <p>As it matters in (<strong>{{implode(',',json_decode(($subscribe_to_user["tribes"])))}}</strong>)</p>
              {{-- <p>{{$subscribe_to_user["subscription_count"]}} {{($subscribe_to_user["subscription_count"])>0 ? " Subs" : " Sub, be first"}}</p> --}}

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    Created by: {{$subscribe_to_user["name"]}}

                    
                  </span>

            </div>
             {{Form::open(['action'=>['HomeController@subscribeuser'],'method'=>'POST'])}}
             <button type="submit" name="subscribe" class="btn btn-outline-dark">EXPLORE</button>
             <input type="hidden" name="subscriber_id" value="{{Auth::user()->id}}">
             <input type="hidden" name="content_owner_id" value="{{$subscribe_to_user["content_id"]}}">
             {{Form::close()}}
            <!-- /.info-box-content -->
          </div>
          </div>
      
      </div>
      <?php }
          ?>
    </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-lg-3 col-xs-6">
            <!-- Button trigger modal -->
            <p>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style="padding-top: 10px;">
              What matters today?
            </button>
            </p>
        </div>
    </div>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
                    <h4 class="modal-title" id="myModalLabel">Create Discussion</h4>
                  </div>
                  {{Form::open(['action'=>['HomeController@creatediscussion'],'method'=>'POST', 'enctype'=>'multipart/form-data'])}}
                    {{csrf_field()}}
                    <div class="modal-body">

                        <div class="form-group">
                            <div class="row">
                                @foreach($topics as $topic)
                               <div class="form-check">
                                    <label>
                                        <input type="radio" name="topic" value="{{$topic->id}}"> <span class="label-text">{{$topic->topic}}</span>
                                    </label>
                                </div>
                                @endforeach
                                  
                        </div>
                        <p>Didnt find your topic of interest? add here
                            <input type="text" class="form-control" name="topicextra" id="topicextra">
                        </p>

                        </div>

                        <div class="form-group">
                            <p>Discussion</p>
                            <textarea cols="53" rows="7" name="discuss" id="discuss"></textarea>
                        </div>

                         <div class="form-group">
                            Picture?
                            {{Form::file("discussion_image")}}
                        </div>

                        {{-- <div class="form-group">
                            Video?

                        {!! Form::file('discussion_video', array('class' => 'video')) !!}

                        </div> --}}

                        <div class="form-group">
                            <p>Tag Tribes?</p>
                            <div class="row">
                                
                                @foreach($tribes as $tribe)
                                
                                

                               <div class="form-check">
                                    <label>
                                        <input type="checkbox" name="tribe[]" value="{{$tribe->tribe_name}}"> <span class="label-text">{{$tribe->tribe_name}}</span>
                                    </label>
                                </div>
                                @endforeach
            
                                  
                        </div>
                        <p>Didn't find a tag? enter here
                            <input type="text" class="form-control" name="tribetag" id="tribetag">
                        </p>
                        

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="submit" value="Save">
                    </div>
                   {{Form::close()}}
                </div>
              </div>
            </div>
        </div>



  


    @foreach($discussion_details as $discussion_detail)
    <div class="row">
        <div class="col-md-6">
          <!-- Box Comment -->
          <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                
                <img class="img-circle" src="storage/discussion_images/{!! App\User::findOrFail($discussion_detail->follow_id)->profile_pic !!}" alt="User Image">
            
                <span class="username"><a href="#">{!! App\User::findOrFail($discussion_detail->follow_id)->name !!}</a></span>
                <span class="description">Shared <strong>{{$discussion_detail->topic}}</strong> as it matters in <strong>{{implode(',',json_decode(($discussion_detail->tribes)))}}</strong> - 7:30 PM Today</span>
              </div>
              <!-- /.user-block -->
            {{--   <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Mark as read">
                  <i class="fa fa-circle-o"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div> --}}
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php if(($discussion_detail->discussion_image != 'noimage.jpg' && $discussion_detail->path_extension == 'jpg')) { ?>
              <img class="img-circle" src="storage/discussion_images/{{$discussion_detail->discussion_image}}" alt="" style="width: 500px;height: 500px;">
                <?php
                    }
                    
                ?>
         
              <?php

              if($discussion_detail->path_extension == 'mp4') { ?>
             <video id="my-video" class="video-js" controls preload="auto" width="540" height="260"
                  poster="MY_VIDEO_POSTER.jpg" data-setup="{}">
                    <source src="storage/discussion_images/{{$discussion_detail->discussion_image}}" type='video/mp4'>
                    <p class="vjs-no-js">
                      To view this video please enable JavaScript, and consider upgrading to a web browser that
                      <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>
            </video>
            <?php
                    }
                    ?>


            <?php $comments_count=HomeController::get_comment_count($discussion_detail->discussion_id) ?>



           



              <p>{{$discussion_detail->topic_body}}</p>
              <span class="pull-left" style="padding-left: 5px;">
              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
              {{Form::open(['action'=>['HomeController@postlike'],'method'=>'POST'])}}
              <input type="hidden" name="discussion_id" value="{{$discussion_detail->discussion_id}}">
              <button type="submit" class="btn btn-default btn-xs" name="like"><i class="fa fa-thumbs-o-up"></i> Like</button>

              {{Form::close()}}
            </span>
              <span class="pull-right text-muted">{{$discussion_detail->likes}} likes - {{json_decode($comments_count[0]->comments_total)}} comments</span>
            </div>
            <!-- /.box-body -->
          {{--   {{Form::open(['action'=>['HomeController@loadcomments'],'method'=>'POST'])}}

                <button class="btn btn-primary" id='comment_loader' type="submit" name="comments">{{$discussion_detail->number_of_comments > 0? "Load Comments":"No comments yet"}}</button>
                <input type="hidden" name="discussion_id" value="{{$discussion_detail->discussion_id}}" id="discussion_id">
            {{Form::close()}} --}}
            <div class="box-footer box-comments" id="comments_loaded">
              <?php $all_comments=HomeController::get_comment_for_discussion($discussion_detail->discussion_id)  ?>
              @foreach($all_comments as $comment)   
              <div class="box-comment">
               
                <img class="img-circle img-sm" src="storage/discussion_images/{{$comment->profile_pic}}" alt="User Image">
                <div class="comment-text">
                      <span class="username">
                        {{$comment->name}}
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span>
                  {{$comment->comments}}
                </div>
                
              </div>

               @endforeach
            </div>
            <!-- /.box-footer -->
            <div class="box-footer">
              {{Form::open(['action'=>['HomeController@postcomment'],'method'=>'POST'])}}
                <img class="img-responsive img-circle img-sm" src="storage/discussion_images/{{Auth::user()->profile_pic}}" alt="Alt Text">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" class="form-control input-sm" placeholder="Press enter to post comment" name="comment" id="comment">
                  <input type="hidden" name="discussion_id" value="{{$discussion_detail->discussion_id}}">
                </div>
              {{Form::close()}}
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    @endforeach




        <aside class="col-md-3 col-xs-6">
            <?php if(!empty($users_to_follow)) { ?>
            @foreach($users_to_follow as $follow_this_user)
            <div style="background-color: rgb(0, 167, 208)">
            <h3 style="background-color: white;">TRENDING TOPICS</h3>
            {{-- @if(is_array($users_to_subscribe_to || is_object($users_to_subscribe_to))) --}}
            
         {{--    <p>
                 uploaded new content about <strong></strong> as it matters in <strong>{{implode(',',json_decode(($subscribe_to_user->tribes)))}}</strong>
                <button class="btn btn-primary">Subscribe</button> to follow all his interesting details
            </p> --}}
            
            {{-- @endif --}}

          
            {{-- @if(is_array($users_to_follow || is_object($users_to_follow))) --}}
            
            <p style="text-align: justify-all;padding-left: 5px;">
                {{$follow_this_user->name}} <span> uploaded content on </span> <strong>{{$follow_this_user->topic}}</strong> as it matters in <span><strong>{{implode(',',json_decode($follow_this_user->tribes))}}</strong></span>
             {{Form::open(['action'=>['HomeController@followuser'],'method'=>'POST'])}}
             <button class="btn btn-danger">Follow</button>
             <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
             <input type="hidden" name="follow_id" value="{{$follow_this_user->id}}">
             {{Form::close()}}
                 to enjoy all his interesting details
            </p>
            
            </div>
            @endforeach
            <?php } ?>


        </aside>
      

  </section>
      <!-- /.

@endsection
