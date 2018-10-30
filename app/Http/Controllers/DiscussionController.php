<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TopicDiscussion;
use App\Topic;
use App\Tribe;
use Validator;
use DB;



class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_active=auth()->user()->id;
        $profile_pic=auth()->user()->profile_pic;

        $timeline=DB::table('topic_discussions')->join('topics','topics.id','=','topic_discussions.topic_id')->join('users','users.id','topic_discussions.user_id')->where('topic_discussions.user_id','=',$user_active)->get();

        $num_comments=DB::table('topic_discussions')->join('topics','topics.id','=','topic_discussions.topic_id')->join('comment_discussions','topic_discussions.id','=','comment_discussions.discussion_id')->select(DB::raw('count(*) as total_comments'))->where('topic_discussions.user_id','=',$user_active)->get()->first();

        //get all the comments made for the discussions made by the person the authenticated user is following
        $comments=DB::table('topic_discussions')->join('comment_discussions','topic_discussions.id','=','comment_discussions.discussion_id')->join('users','users.id','=','comment_discussions.user_id')->where('topic_discussions.user_id','=',$user_active)->get();

        //dd($subscriptions);

        return view('timeline')->with([
            'discussion_details'=>$timeline,
            'num_of_comments'=>$num_comments,
            'comments_made'=>$comments,
            'profile_pic'=>$profile_pic]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
