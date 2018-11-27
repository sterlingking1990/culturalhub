@extends('layouts.master')
<?php
use \App\Http\Controllers\HomeController;
?>

@section('content')
    <section class="content">
      <!-- Small boxes (Stat box) -->   
     

    



   

    @foreach($discussion_details as $discussion_detail)
    @if(empty($discussion_detail))
    <p>Please upload content on what matters today in your culture or ask question about culture before accesing this page</p>
    @endif
    <div class="row">
        <div class="col-md-6">
          <!-- Box Comment -->
          <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <?php if(($discussion_detail->profile_pic)!='no_image'): ?>
                
                <img class="img-circle" src={{URL::asset("storage/discussion_images/{$discussion_detail->profile_pic}")}} alt="User Image">
                <?php
                    
                    endif;
                ?>

                <span class="username"><a href="#">{{$discussion_detail->name}}</a></span>
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
              <?php if(($discussion_detail->path_extension)!='nopath' || $discussion_detail->discussion_image != 'noimage.jpg'): ?>
              <img class="img-circle" src={{asset("storage/discussion_images/{$discussion_detail->discussion_image}")}} alt="Enjoy" style="width: 500px;height: 500px;">
                <?php
                    
                    endif;
                ?>

             <?php if(($discussion_detail->path_extension)!='nopath' && $discussion_detail->path_extension == 'mp4'): ?>
             <video id="my-video" class="video-js" controls preload="auto" width="540" height="264"
                  poster="MY_VIDEO_POSTER.jpg" data-setup="{}">
                    <source src={{asset("storage/discussion_images/{$discussion_detail->discussion_image}")}} type='video/mp4'>
                    <p class="vjs-no-js">
                      To view this video please enable JavaScript, and consider upgrading to a web browser that
                      <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>
            </video>
            <?php
                    
                    endif;
            ?>


            <?php $comments_count=HomeController::get_comment_count($discussion_detail->discussion_id) ?>

              <p>{{$discussion_detail->topic_body}}</p>
              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
              <span class="pull-right text-muted">{{$discussion_detail->likes}} likes - {{json_decode($comments_count[0]->comments_total)}} comments</span>
            </div>
            <!-- /.box-body -->
            <div class="box-footer box-comments" id="comments_loaded">
                {{-- @if(is_array($comments_made || is_object($comments_made))) --}}
                <?php $all_comments=HomeController::get_comment_for_discussion($discussion_detail->discussion_id)  ?>
                @foreach($all_comments as $comment)


              <div class="box-comment">
                <!-- User image -->
                <img class="img-circle img-sm" src={{URL::asset("storage/discussion_images/{$comment->profile_pic}")}} alt="User Image">

                <div class="comment-text">
                      <span class="username">
                        {{$comment->name}}
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                  {{$comment->comments}}
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->

              @endforeach
              {{-- @endif --}}
            </div>
            <!-- /.box-footer -->
            <div class="box-footer">
              
                <img class="img-responsive img-circle img-sm" src={{URL::asset("storage/discussion_images/{$profile_pic}")}} alt="Alt Text"/>
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" id ="user_comment" class="form-control input-sm" placeholder="Press enter to post comment">
                </div>
                <input type="hidden" id="discussion_id" name="discussion_id" value="{{$discussion_detail->discussion_id}}"/>
                <input type="hidden" name="comment_creator" id="comment_creator" value="{{Auth::user()->id}}"/>
              
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    @endforeach
      

  </section>
      <!-- /.

@endsection
