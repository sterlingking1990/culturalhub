<?php

namespace App\Http\Controllers;

use App\Fact;
use App\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class FactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $all_facts=DB::table('facts')->paginate(3);

         //get all places
         $all_places=DB::table('places')->select('places as place')->distinct()->get();


          $valp=[];
           for ($i=0; $i <count($all_places) ; $i++) { 

              $valp[$i]=$all_places[$i]->place;
          }





     
           $num_of_ele=count($all_places);
           $num_ele=$num_of_ele/2;

          $random_places_key=array_rand($valp,$num_ele);
          //get the random places from the random keys
          $random_places=[];
          for ($i=0; $i<count($random_places_key); $i++) { 
              $random_places[$i]=$valp[$random_places_key[$i]];
          }
         

        return view('welcome')->with([
            'all_facts'=>$all_facts,
            'all_places'=>$random_places]);


         

        


    }

    public function display_places(){

    }

    public function display_fact(Request $request){
         
    
            $place_to_search=$request->searchplace;
            if(!empty($place_to_search)){

            $data=DB::table('facts')->where('places','like','%'.$place_to_search.'%')->get();

        //     $response = array(
        //     'status' => 'success',
        //     'msg' => $data,
        // );
            $response=$data;

           //$returnHTML = view('welcome')->with('result', $data);
        return \Response::json($response);
    }
    else{
        //the user didnt enter anything and hit the enter button
        //return the user to welcome page
        $data=Fact::all();
        $response=$data;
        return \Response::json($response);

    }

           

       
}

public function return_home(){
     //$all_facts=DB::table('facts')->paginate(3);

         //get all places
        // $all_places=DB::table('places')->select('places as place')->get();
    $data=DB::table('facts')->get();
    return json_encode($data,true);
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // create new facts here
        $data[] = $request->all();
        $validate = Validator::make($data, [
        // 'discussion_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        'fact_pic' => 'mimes:jpeg,png,jpg,mp4|max:2048',
        'txt_facttitle'=>'required',
        'txt_factbody'=>'required',
        'place'=>'required'
    ]);

        //Handle file upload


        //upload discussion
        
        
        if($request->hasFile('fact_pic')){

            


        $filenameWithExt=$request->file('fact_pic')->getClientOriginalName();
        //get file name
        $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
        //get extension
        $extension=$request->file('fact_pic')->getClientOriginalExtension();
        // dd($extension);
        //get filename to save
        $filenametosave=$filename . '-' . time(). '.' . $extension;
        //upload image
        $path=$request->file('fact_pic')->storeAs('public/discussion_images',$filenametosave);
    }
    else{
        $filenametosave="cultureimage1.jpg";
        
    }
     

        //save the details
        $fact=new Fact;

         $fact->fact_pic=$filenametosave;
         $fact->title=$request->input('txt_facttitle');


         $fact->body=$request->input('txt_factbody');

         
         $fact_tribe=$request->input('place');

         $fact->creator=$request->input('creator');
         $fact->fact_source=$request->input('txt_factsource');
         if(empty($fact->creator)){
            $fact->creator = "anonymous";
         }
         if(empty($fact->fact_source)){
            $fact->fact_source="unknown";
         }
         $fact->places=$fact_tribe;
        
        // //check for tribe too
        if((!empty($request->input('placetag'))) && (!empty($fact_tribe))){

            $placenew = new Place;
            $placenew->places=$request->input('placetag');
            $placenew->save();
            $placeid=$placenew->places;

            //add this additional tribe name to tribes selected
            $fact_tribes=array_prepend($fact_tribe,$placeid);
            //dd($fact_tribes);
            $fact->places=$fact_tribes;

    
        }
        else{
            //either fact_tribe or placetag is empty or both is empty
            if((empty($request->input('placetag'))) && (empty($fact_tribe))){
                $fact->places="None";
            }
            if((empty($fact_tribe)) && (!empty($request->input('placetag')))){
                $placenew = new Place;
                $placenew->places=$request->input('placetag');
                $placenew->save();
                $placeid=$placenew->places;
                $fact->places=$placeid;
            }

        }

        $fact->save();
        \Session::flash('fact_created','Fact successfully created.'); 

        return redirect('/');


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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fact  $fact
     * @return \Illuminate\Http\Response
     */
    public function show(Fact $fact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fact  $fact
     * @return \Illuminate\Http\Response
     */
    public function edit(Fact $fact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fact  $fact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fact $fact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fact  $fact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fact $fact)
    {
        //
    }
}
