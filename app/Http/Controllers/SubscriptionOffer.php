<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TopicDiscussion;
use App\Topic;
use App\Tribe;
use Validator;
use DB;

class SubscriptionOffer extends Controller
{
    //

    public function index(){
    	//get all subscription and display it

    	$user_active=auth()->user()->id;
    	$profile_pic=auth()->user()->profile_pic;

    	$subscriptions=DB::table('subscription_offers')->join('topic_discussions','topic_discussions.id','=','subscription_offers.content_owner_id')->join('users','users.id','=','topic_discussions.user_id')->join('topics','topics.id','=','topic_discussions.topic_id')->where('subscription_offers.subscriber_id','=',$user_active)->get();

    	$num_comments=DB::table('subscription_offers')->join('topic_discussions','topic_discussions.id','=','subscription_offers.content_owner_id')->join('comment_discussions','topic_discussions.id','=','comment_discussions.discussion_id')->select(DB::raw('count(*) as total_comments'))->where('subscription_offers.subscriber_id','=',$user_active)->get()->first();

    	//get all the comments made for the discussions made by the person the authenticated user is following
        $comments=DB::table('subscription_offers')->join('topic_discussions','topic_discussions.id','=','subscription_offers.content_owner_id')->join('comment_discussions','topic_discussions.id','=','comment_discussions.discussion_id')->join('users','users.id','=','comment_discussions.user_id')->where('subscription_offers.subscriber_id','=',$user_active)->get();

        //dd($subscriptions);

    	return view('subscriptions')->with([
    		'discussion_details'=>$subscriptions,
    		'num_of_comments'=>$num_comments,
    		'comments_made'=>$comments,
    		'profile_pic'=>$profile_pic]);
    }
}
