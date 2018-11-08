<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TopicDiscussion;
use App\CommentDiscussion;
use App\Topic;
use App\Tribe;
use App\User;
use Validator;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            
        $user_active=auth()->user()->id;
        $users_following=DB::table('user_follows')->Join('topic_discussions','user_follows.follow_id','=','topic_discussions.user_id')->Join('topics','topics.id','topic_discussions.topic_id')->select('user_follows.*','topic_discussions.id as discussion_id','topic_discussions.*','topics.*','topic_discussions.created_at as created_time')->where('user_follows.user_id','=',$user_active)->where('topic_discussions.available','=','unlocked')->get();
        // dd($users_following);
        

        //get the total number of culture lovers following the follower this person is following
        // $num_of_followers=DB::table('topic_discussions')->join('user_follows','user_follows.follow_id','=','topic_discussions.user_id')->select(DB::raw('count(*) as total_followers'))->get()->first();

        //get the total number of followings
        $num_of_followings=DB::table('user_follows')->select(DB::raw('count(*) as total_user_following'))->where('user_follows.user_id','=',$user_active)->get()->first();

        //get the total number of people following this user
        $num_following_this_user=DB::table('user_follows')->select(DB::raw('count(*) as total_following_user'))->where('user_follows.follow_id','=',$user_active)->get()->first();



        //get the active user total discussion made
        $num_of_discussion_made=DB::table('topic_discussions')->select(DB::raw('count(*) as total_discussion'))->where('topic_discussions.user_id','=',$user_active)->get()->first();

        //get total number of discussions made in the platform
        $num_of_discussions=DB::table('topic_discussions')->select(DB::raw('count(*) as all_discussions'))->get()->first();

        //get the total comments for the discussions made by the person the authenticated user is following
        $num_comments=DB::table('user_follows')->join('topic_discussions','topic_discussions.user_id','=','user_follows.follow_id')->join('comment_discussions','topic_discussions.id','=','comment_discussions.discussion_id')->select(DB::raw('count(*) as total_comments'))->where('user_follows.user_id','=',$user_active)->get()->first();

        //get all the comments made for the discussions made by the person the authenticated user is following
        $comments=DB::table('topic_discussions')->join('comment_discussions','comment_discussions.discussion_id','=','topic_discussions.id')->join('users','users.id','=','comment_discussions.user_id')->where('comment_discussions.user_id','=',$user_active)->get();

        //Get those who the user should follow: note; these recommended set of people are the followers of those who the user is already following, not including the followers
        //1. get those who the user is following into an array
        $users_am_following=DB::table('user_follows')->select('follow_id')->where('user_id','=',$user_active)->get();
        if(count($users_am_following)>0){
             //return result in an arry
                //dd($celebrities_following[0]);
            $result_array=[];
                
                for ($i=0; $i < count($users_am_following); $i++) { 
                    
                        $result_array[$i]=$users_am_following[$i];
                }
                //the result array is returned as standard class, now convert it to normal array.
                $result_array = json_decode(json_encode($result_array), true);
            
            $users_to_follow=DB::table('user_follows')->join('topic_discussions','topic_discussions.user_id','=','user_follows.follow_id')->join('topics','topics.id','=','topic_discussions.topic_id')->join('users','users.id','=','topic_discussions.user_id')->whereIn('user_follows.user_id',$result_array)->whereNotIn('user_follows.follow_id',$result_array)->select('users.name as name','users.id as id','topic_discussions.tribes as tribes','topics.topic as topic')->where('topic_discussions.available','<>','locked')->where('user_follows.follow_id','<>',$user_active)->get();            
        
        }
        else{
                //this means the user isnt following some users, hence he should follow those who posted contents but the user isnt following this person;;;
                $users_to_follow=DB::table('topic_discussions')->join('topics','topics.id','=','topic_discussions.topic_id')->join('users','users.id','=','topic_discussions.user_id')->where('topic_discussions.user_id','<>',$user_active)->select('users.name as name','users.id as id','topic_discussions.tribes as tribes','topics.topic as topic')->where('topic_discussions.available','<>','locked')->get();
            }


            //get those users who should start earning money because they have been verified and their contents have much likes

            //1. get the users that the authenticated user should subscribe to their contents since they have been verified:::the contents are those already subscribed by others, not yet subscribed by the active user
            $subscribe_to_these_users_2=DB::table('subscription_offers')->join('topic_discussions','topic_discussions.id','=','subscription_offers.content_owner_id')->join('topics','topics.id','=','topic_discussions.topic_id')->join('users','users.id','=','topic_discussions.user_id')->select('topics.topic as topic','topic_discussions.tribes as tribes','users.name as name')->where('subscription_offers.subscriber_id','<>',$user_active)->where('topic_discussions.user_id','<>',$user_active)->where('topic_discussions.available','=','locked')->get();

            //the contents are those not yet subscribed by others,,just uploaded

            $subscribe_to_these_users=DB::table('topic_discussions')->join('topics','topics.id','=','topic_discussions.topic_id')->join('users','users.id','=','topic_discussions.user_id')->select('topics.topic as topic','topic_discussions.tribes as tribes','topic_discussions.id as content_id','topic_discussions.subscription_count','users.name as name')->where('topic_discussions.available','=','locked')->where('topic_discussions.user_id','<>',$user_active)->get();

            //i can from the above get the count of those already subscribed to this video if any




            // $users_to_subscribe_to = json_decode(json_encode($subscribe_to_these_users), true);

            $users_to_subscribe_to = json_decode(json_encode($subscribe_to_these_users), true);
           // $users_to_subscribe_to=json_decode(json_encode($users_to_subscribe_to));
            //dd($users_to_subscribe_to);
            


            

            //get the tribes from the db and 
            $tribes_available=DB::table('tribes')->get();

            //get the topics from the db
            $topics_available=DB::table('topics')->distinct()->get();



            if(count($users_following)>0){
                 return view('home')->with([
                    'no_users'=>"Now, you can follow users who are updating culture contents",
                    'discussion_details'=>$users_following,
                    // 'num_of_followers'=>$num_of_followers,
                    'num_of_followings'=>$num_of_followings,
                    'num_following_this_user'=>$num_following_this_user,
                    'total_discussion_made'=>$num_of_discussion_made,
                    'total_discussions'=>$num_of_discussions,
                    'num_of_comments'=>$num_comments,
                    'comments_made'=>$comments,
                    'users_to_follow'=>$users_to_follow,
                    'users_to_subscribe_to'=>$users_to_subscribe_to,
                    'tribes'=>$tribes_available,
                    'topics'=>$topics_available
                    ]);
        }
        else{
              //display his personal timeline discussion
            $users_following=DB::table('topic_discussions')->join('users','users.id','=','topic_discussions.user_id')->join('topics','topics.id','=','topic_discussions.topic_id')->where('topic_discussions.user_id','=',$user_active)->get();
            return view('home')->with([
                'no_users'=>"No user followed yet, follow culture lovers to enjoy contents from them",
                'discussion_details'=>$users_following,
                // 'num_of_followers'=>$num_of_followers,
                'num_of_followings'=>$num_of_followings,
                'num_following_this_user'=>$num_following_this_user,
                'total_discussion_made'=>$num_of_discussion_made,
                'total_discussions'=>$num_of_discussions,
                'num_of_comments'=>$num_comments,
                'comments_made'=>$comments,
                'users_to_follow'=>$users_to_follow,
                'tribes'=>$tribes_available,
                'topics'=>$topics_available,
                'users_to_subscribe_to'=>$users_to_subscribe_to]);
        }

}

     public function creatediscussion(Request $request){
         
        $data[] = $request->all();
        $validate = Validator::make($data, [
        // 'discussion_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        'discussion_image' => 'required|mimes:jpeg,png,jpg,mp4|max:4096',
        'discuss'=>'required',
        'tribe'=>'required',
        'topic'=>'required'

    ]);

        //Handle file upload


        //upload discussion
        
        
        if($request->hasFile('discussion_image')){

            


        $filenameWithExt=$request->file('discussion_image')->getClientOriginalName();
        //get file name
        $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
        //get extension
        $extension=$request->file('discussion_image')->getClientOriginalExtension();
        // dd($extension);
        //get filename to save
        $filenametosave=$filename . '-' . time(). '.' . $extension;
        //upload image
        $path=$request->file('discussion_image')->storeAs('public/discussion_images',$filenametosave);
    }
    else{
        $filenametosave="noimage.jpg";
        
    }
     

        //save the details
        $discussion=new TopicDiscussion;

         $discussion->discussion_image=$filenametosave;
         $discussion->path_extension=$extension;
         $discussion->topic_body=$request->input('discuss');
         $discussion->number_of_comments=0;
         $discussion->likes=0;
         $discussion->comments="Really nice post on culture";


         $discussion->topic_id=$request->input('topic');
         
         $discussion_tribe=$request->input('tribe');
         $discussion->user_id=auth()->user()->id;
         

        if(!empty($request->input('topicextra'))){

            $topicnew = new Topic;
            $topicnew->topic=$request->input('topicextra');
            $topicnew->save();
            $topicid=$topicnew->id;

            //add this new topicid instead
            $discussion->topic_id=$topicid;

    
        }
        
        $discussion->tribes=$discussion_tribe;
        // //check for tribe too
        if((!empty($request->input('tribetag'))) && (!empty($discussion_tribe))){

            $tribenew = new Tribe;
            $tribenew->tribe_name=$request->input('tribetag');
            $tribenew->save();
            $tribeid=(string)$tribenew->tribe_name;

            //add this additional tribe name to tribes selected
            $discussion_tribes=array_prepend($discussion_tribe,$tribeid);
            $discussion->tribes=$discussion_tribes;

    
        }

        else{
            //either tribe or tribe tag is empty or both is empty; 
            if(empty($discussion_tribe) && empty($request->input('tribetag'))){
                //since both are empty, then let us save tribe as none selected
                $discussion->tribes="none";
            }
            //seems the discussion_tribe is empty but the tribe tag isnt
            if(empty($discussion_tribe) && (!empty($request->input('tribetag')))){
                $tribenew = new Tribe;
                $tribenew->tribe_name=$request->input('tribetag');
                $tribenew->save();
                $tribeid=(string)$tribenew->tribe_name;
                $discussion->tribes=$tribeid;


            }
            
        }

        $discussion->save();

        \Session::flash('discussion_created','Discussion successfully added.'); 

        return redirect('/home');
         
    }

    public function subscribeuser(Request $request){
        $subscriber_id=$request->subscriber_id;
        $content_owner_id=$request->content_owner_id;
        //check if the person have subscribed before
        $check_sub_status=DB::table('subscription_offers')->where('subscriber_id','=',$subscriber_id)->where('content_owner_id','=','$content_owner_id')->get()->first();
        if(!empty($check_sub_status)>0){

            //it means the person did subscribe before
             \Session::flash('subscribed_status','You already subscribed.'); 

        return redirect('/home');

        }
        else{
            //this means the person hasnt subscribed yet save sub status
            $sub_status="subscribed";
            DB::table('subscription_offers')->insert([
                'subscriber_id'=>$subscriber_id,
                'content_owner_id'=>$content_owner_id,
                'sub_status'=>$sub_status]);

            //get the subcount for this content so we update the subscription count
            $get_sub_count=DB::table('topic_discussions')->select('subscription_count')->where('topic_discussions.id','=',$content_owner_id)->get()->first();

            //increment the count
            
            $sub_count=$get_sub_count->subscription_count+=1;


            DB::table('topic_discussions')->where('topic_discussions.id',$content_owner_id)->update(['subscription_count'=>$sub_count]);

             \Session::flash('subscribed_status','Subscription successful.'); 

        return redirect('/home/subscriptions');


        }

    }

    public function followuser(Request $request){

                $user_id=$request->user_id;
                $follow_id=$request->follow_id;
        //check if the person is already following this users
        $check_follow_status=DB::table('user_follows')->where('user_id','=',$user_id)->where('follow_id','=',$follow_id)->get()->first();
        if(!empty($check_follow_status)){

            //it means the person did subscribe before
             \Session::flash('follow_status','You already following this user.'); 

        return redirect('/home');

        }
        else{
            //this means the person hasnt followed yet 
            $follow_status="following";
            DB::table('user_follows')->insert([
                'user_id'=>$user_id,
                'follow_id'=>$follow_id,
                'status'=>$follow_status]);

             \Session::flash('follow_success','You are now following this user.'); 

        return redirect('/home');


        }



    }

    public function postcomment(Request $request){

        // $comment=$request->input('comment');
        // $comment_creator=auth()->user()->id;
        // $discussion_id=$request->input('discussion_id');

        //take input from ajax in master where ajax was described
        $comments=$request->comment_created;


        $discussion_id=$request->discussion_id;
        
        $comment_creator=$request->comment_creator;

        //save comment to 
        $discussion_comment=new CommentDiscussion;
        $discussion_comment->discussion_id=$discussion_id;
        $discussion_comment->comments=$comments;
        $discussion_comment->user_id=$comment_creator;
        $discussion_comment->number_of_like=0;
        $discussion_comment->save();

        $discussion_id_new=(string)$discussion_comment->id;
        //retrieve the comment being save using the comment id
        //get the number of comments for this discussion id
        // $comment_count=DB::table('topic_discussions')->select('number_of_comments')->where('id','=',$discussion_id)->get();
        // $num_of_comments=$comment_count[0]->number_of_comments;
            //get the comments now from the comments_discussion table
              $data=DB::table('comment_discussions')->join('users','users.id','=','comment_discussions.user_id')->where('comment_discussions.id','=',$discussion_id_new)->get();
            $response=$data;
            //dd($response);
        

        //     return redirect('/home')->with('comments_made',$comments);

         return \Response::json($response);

        
    }

    public function loadcomments(Request $request){
        $discussion_id=$request->discussion_id;
        //get the number of comments for this discussion id
        $comment_count=DB::table('topic_discussions')->select('number_of_comments')->where('id','=',$discussion_id)->get();
        $num_of_comments=$comment_count[0]->number_of_comments;
        if($num_of_comments>0){
            //get the comments now from the comments_discussion table
            $comments=DB::table('comment_discussions')->join('topic_discussions','topic_discussions.id','=','comment_discussions.discussion_id')->join('users','users.id','=','comment_discussions.user_id')->where('topic_discussions.id','=',$discussion_id)->get();
        }

    //     return redirect('/home')->with('comments_made',$comments);
            return response()->json(['success'=>$comments]);

    }

    public function postlike(Request $request){
        //check if the user already made a like on the comment
        $user=auth()->user()->id;
        $num_of_like=[];
        $discussion_id=$request->input('discussion_id');
        //dd($discussion_id);
        $number_of_like=DB::table('comment_discussions')->select('number_of_like')->where('user_id','=',$user)->where('discussion_id','=',$discussion_id)->get();
        
        if(count($number_of_like)>0){
                //return result in an arry
                //dd($celebrities_following[0]);
                
                
                for ($i=0; $i < count($number_of_like); $i++) { 
                    
                        $num_of_like[$i]=$number_of_like[$i];
                }
            
            //the user have not liked before this discussion, like it then update the discussion likes
            ($num_of_like[0]->number_of_like===0?$num_of_like=1:$num_of_like=0);
            DB::table('comment_discussions')->where('comment_discussions.discussion_id','=',$discussion_id)->where('comment_discussions.user_id','=',$user)->update([
                'number_of_like'=>$num_of_like]);

            //update discussion likes
            //1.get the total likes first for this discussion from topic discussioon

            $total_like=[];
            $total_likes_for_discussion=DB::table('topic_discussions')->select('likes')->where('topic_discussions.id','=',$discussion_id)->get();
            for ($i=0; $i < count($total_likes_for_discussion); $i++) { 
                    
                        $total_like[$i]=$total_likes_for_discussion[$i];
                }
                ($num_of_like===1?$total_likes=$total_like[0]->likes + $num_of_like:$total_likes=$total_like[0]->likes - 1);
                

            

            DB::table('topic_discussions')->where('topic_discussions.id','=',$discussion_id)->update([
                'likes'=>$total_likes]);
        }

        return redirect('/home');

    }

    public static function get_comment_for_discussion($discussion_id){
        //get the comments now
        $all_comments=DB::table('comment_discussions')->join('users','users.id','=','comment_discussions.user_id')->where('comment_discussions.discussion_id','=',$discussion_id)->get();

        return $all_comments;
    }

    public static function get_comment_count($discussion_id){
        //count the comments for this discussion
        $comment_count=DB::table('comment_discussions')->select(DB::raw('count(*) as comments_total'))->where('comment_discussions.discussion_id','=',$discussion_id)->get();
        
        

        return $comment_count;
        
        }

    public function searchitem(Request $request){

    }





}

   