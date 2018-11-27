<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CulturalHub</title>

        <!-- Fonts --> <!--this was originally there-->
        {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css"> --}} <!--originally there ends here-->
        <!--mdb css-->
        <!-- Font Awesome -->
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800i" rel="stylesheet"> 
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.13/css/mdb.min.css" rel="stylesheet">
<!--mdb javascripe -->
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.13/js/mdb.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!--autocomplete script -->
    <script>
  $( function() {
    var availableTags = [
      "Awka",
      "Anambra",
      "Abia",
      "Benin",
      "Congo",
      "Calabar",
      "Cotonou",
      "Crossriver",
      "Cele",
      "Enugu",
      "Ezinifite",
      "Folake",
      "Gombe",
      "Hasan",
      "Jigawa",
      "Jos",
      "Ibadan-west",
      "Lagos",
      "Umuomam"
      "Portharcourt",
      "Port",
      "Plateau",
      "Rivers",
      "Sokoto",
      "Sudan"
    ];
    $( "#searchentry" ).autocomplete({
      source: availableTags
    });
  } );
  </script>
  <!--end it here-->

        <!-- Styles -->
        <style>
            html, body {
                background-color: white;
                background-image: {{(url('storage/discussion_images/cultureimage.jpg'))}}
                color: #636b6f;
                font-family: 'Comic-sans';
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .center-block{
              margin:0 auto;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');

.container{
    padding: 10%;
    text-align: center;
}
#custom-search-input {
    margin:0;
    margin-top: 10px;
    padding: 0;
}
 
#custom-search-input .search-query {
    width:100%;
    padding-right: 3px;
    padding-left: 15px;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
    margin-bottom: 0;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 0;
}
 
#custom-search-input button {
    border: 0;
    background: none;
    /** belows styles are working good */
    padding: 2px 5px;
    margin-top: 2px;
    position: absolute;
    right:0;
    /* IE7-8 doesn't have border-radius, so don't indent the padding */
    margin-bottom: 0;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    color:#D9230F;
    cursor: unset;
    z-index: 2;
}
 
.search-query:focus{
    z-index: 0;   
}

.flexcontainer {
   display: flex;
   flex-direction: row;
   padding-top:-15px;
   border-spacing: 10px;
}

/*modal css */
.form-dark .font-small {
  font-size: 0.8rem; }

.form-dark [type="radio"] + label,
.form-dark [type="checkbox"] + label {
  font-size: 0.8rem; }

.form-dark [type="checkbox"] + label:before {
  top: 2px;
  width: 15px;
  height: 15px; }

.form-dark .md-form label {
  color: #fff; }

.form-dark input[type=email]:focus:not([readonly]) {
  border-bottom: 1px solid #00C851;
  -webkit-box-shadow: 0 1px 0 0 #00C851;
  box-shadow: 0 1px 0 0 #00C851; }

.form-dark input[type=email]:focus:not([readonly]) + label {
  color: #fff; }

.form-dark input[type=password]:focus:not([readonly]) {
  border-bottom: 1px solid #00C851;
  -webkit-box-shadow: 0 1px 0 0 #00C851;
  box-shadow: 0 1px 0 0 #00C851; }

.form-dark input[type=password]:focus:not([readonly]) + label {
  color: #fff; }

.form-dark input[type="checkbox"] + label:before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 17px;
  height: 17px;
  z-index: 0;
  border: 1.5px solid #fff;
  border-radius: 1px;
  margin-top: 2px;
  -webkit-transition: 0.2s;
  transition: 0.2s; }

.form-dark input[type="checkbox"]:checked + label:before {
  top: -4px;
  left: -3px;
  width: 12px;
  height: 22px;
  border-style: solid;
  border-width: 2px;
  border-color: transparent #00c851 #00c851 transparent;
  -webkit-transform: rotate(40deg);
  -ms-transform: rotate(40deg);
  transform: rotate(40deg);
  -webkit-backface-visibility: hidden;
  -webkit-transform-origin: 100% 100%;
  -ms-transform-origin: 100% 100%;
  transform-origin: 100% 100%; }

.form-dark .modal-header {
    border-bottom: none;
}
/*end modal css*/


        </style>
    </head>
    <body style="background-image:url('storage/discussion_images/cultureimage.jpg'); opacity: 1;">
        <div class="flex-center position-ref full-height" id="div">
            @if (Route::has('login'))
                <div class="top-right links" style="color:white;">
                    {{-- <button onClick="scrollToBottom()">Scroll to Bottom</button> --}}
                    <button class="btn btn-primary" onClick="scrollSmoothToBottom()">See <b>Recent</b> Facts on Culture</button>
                    <button class="btn btn-default btn-rounded" data-toggle="modal" data-target="#darkModalForm">Enter <b>Facts</b> on Culture</button>

                    @auth
                        <a href="{{ url('/home') }}" style="color:white;">Home</a>
                    @else
                        <a href="{{ route('login') }}" style="color:white;">Login</a>
                        <a href="{{ route('register') }}" style="color:white;">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
              @if(Session::has('fact_created'))
            <div class="alert alert-success"><em> {!! session('fact_created') !!}</em></div>
            @endif
            </div>
             <div class="content">
              @if(Session::has('failure'))
            <div class="alert alert-success"><em> {!! session('failure') !!}</em></div>
            @endif
            </div>

            <div class="content">
                <div class="title m-b-md" style="color:white;">
                    MYCULTURE.NG
                </div>
                <div style="margin-top: -40px;color:#999cd4;border-width: 2px;"><strong style="border-width: 2px;"><p style="font-size: 20px";> connect to your culture</p></strong></div>
    

                {{-- <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div> --}}
            </div>
        </div>

        <div class="container" style="margin-top: -450px;">
    <div class="row">
        <div class="col-12"><h2></h2></div>
        <div class="col-12">
             
            <div id="custom-search-input">
                <div class="input-group">
                   
                    <input type="text" id="searchentry" class="search-query form-control" placeholder="Where are you from?" />
                   
                    <span class="input-group-btn">
                        <button  id="searchval" enabled >
                            <span class="fa fa-search"></span>
                        </button>
                    </span>
                 
                </div>
            </div>
              
             <p style="color:white;"><bold>Anambra | Enugu | Calabar | and many more </bold> <button class="btn btn-sm btn-primary" id="reloadpage">Return Home</button></p>
        </div>
    </div>
 

</div>

<!--modal things-->
<!-- Modal -->
<div class="modal fade" id="darkModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog form-dark" role="document">
        <!--Content-->
        <div class="modal-content card card-image" style="background-image: url('storage/discussion_images/cultureimage.jpg')">
            <div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">
                <!--Header-->
                <div class="modal-header text-center pb-4">
                    <h3 class="modal-title w-100 white-text font-weight-bold" id="myModalLabel"><strong>YOUR</strong> <a class="green-text font-weight-bold"><strong> FACT</strong></a></h3>
                    <button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                {{Form::open(['action'=>['FactController@create'],'method'=>'POST', 'enctype'=>'multipart/form-data'])}}

                <div class="modal-body">
                    <!--Body-->
                    <div class="md-form mb-5">
                        <input type="text" id="txt_facttitle" name="txt_facttitle" class="form-control" placeholder="fact concerning?" style="color: white;">
                        
                    </div>

                    <div class="md-form pb-3">
                        <textarea cols="6" rows="5" id="txt_factbody" name="txt_factbody" class="form-control" placeholder="Tell the fact" style="color:white;"></textarea>
                        
                        
                    </div>
                     <div class="md-form pb-3">
                        <div class="btn btn-sm btn-primary form-control">
                            Upload Image
                            <input type="file" name="fact_pic"/>
                        </div>
                        
                        
                    </div>

                    <div class="form-group">
                      <p>Tag Tribes?</p>
                      <div class="row">
                                
                        @foreach($all_places as $place)
                        <div class="form-check" id="tribe">
                          <label>
                            <input type="checkbox" name="place[]" value="{{$place}}"> <span class="label-text">{{$place}}</span>
                          </label>
                        </div>
                        @endforeach  

                      </div>
                        
                      Didn't find a tag? enter here
                      <div class="md-form pb-3">
                        <input type="text" class="form-control" name="placetag" id="tribetag">
                      </div>
                    </div>

                    <div class="md-form pb-3">
                      <input type="text" name="creator" id="creator" placeholder="enter your social media name" class="form-control">
                    </div>

                    <div class="md-form mb-5">
                        <input type="text" id="txt_factsource" name="txt_factsource" class="form-control" placeholder="Enter website where fact is gotten" style="color: white;">
                        
                    </div>

                    <!--Grid row-->
                    <div class="row d-flex align-items-center mb-4">

                        <!--Grid column-->
                        <div class="text-center mb-3 col-md-12">
                            <button type="submit" class="btn btn-success btn-block btn-rounded z-depth-1">Share Fact</button>
                        </div>
                        <!--Grid column-->

                    </div>
                    <!--Grid row-->

                    <!--Grid row-->
                 
                    <!--Grid row-->

                </div>
                {{Form::close()}}
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Modal -->


<!--close modal -->


    <div class="flex-container" style="background-color:black;">
      <div class="infinite-scroll">
    <div class="card-group" style="margin-top:50px;" id="result">
      @foreach($all_facts as $all_fact)
  <div class="card">
    <img class="card-img-top" src="storage/discussion_images/{{$all_fact->fact_pic}}" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{$all_fact->title}}</h5>
      <p class="card-text">{{$all_fact->body}}</p>
      
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      <p class="card-text"><small class="text-muted">Written by: {{$all_fact->creator}}</small></p>
      @if($all_fact->fact_source!=='unknown')
       <p class="card-text"><small class="text-muted">Source:<a href="{{$all_fact->fact_source}}">{{$all_fact->fact_source}}</a></small></p>
       @else
       <p class="card-text"><small class="text-muted">Source:{{$all_fact->fact_source}}</small></p>
       @endif

       @if(is_array($all_fact->places))
       <p class="card-text"><small class="text-muted">Related to: {{implode(",",json_decode($all_fact->places))}}</small></p>
       @else
        <p class="card-text"><small class="text-muted">Related to: {{$all_fact->places}}</small></p>
      @endif
       

    </div>
  </div>
  @endforeach
  {{$all_facts->links()}}
</div>
</div>
</div>



{{-- <button onClick="scrollToTop()">Scroll to Top</button> --}}
<button class="btn btn-primary" onClick="scrollSmoothToTop()">Return <b>to Top</b></button>


<script type="text/javascript">
scrollingElement = (document.scrollingElement || document.body)
function scrollToBottom () {
   scrollingElement.scrollTop = scrollingElement.scrollHeight;
}

function scrollToTop (id) {
   scrollingElement.scrollTop = 0;
}

//Require jQuery
function scrollSmoothToBottom (id) {
   $(scrollingElement).animate({
      scrollTop: document.body.scrollHeight
   }, 500);
}

//Require jQuery
function scrollSmoothToTop (id) {
   $(scrollingElement).animate({
      scrollTop: 0
   }, 500);
}
</script>


<script>
$(document).ready(function() {
    $('#searchval').on('click', function (e) {
      e.preventDefault();
        
        var searchitem = $('#searchentry').val();
        
       
        $.ajax({
            type: "GET",
            url: '/facts',
            data: {searchplace:searchitem},
            success: showFacts
          });
      });
    $('#searchentry').keydown(function (event) {
        
      if(event.which==13){
        event.preventDefault();

        
        var searchitem = $('#searchentry').val();
        scrollToBottom();
        $.ajax({
            type: "GET",
            url: '/facts',
            data: {searchplace:searchitem},
            success: showFacts
          });
        //check if entry is empty
        if(!$(this).val()){
          alert("Its empty");
          return;
        }
      }});
        
        function showFacts(data) {
          $.each(data,function(item){


            $("#result").empty().append("<div class='card'><img class='card-img-top' src=" +'storage/discussion_images/' + data[item]["fact_pic"] + "><div class='card-body'><h5 class='card-title'>" + data[item]["title"] + "</h5><p class='card-text'>"+data[item]["body"]+"</p><p class='card-text'><small class='text-muted'>"+"last updated 3 min ago"+ "</small><small class='text-muted'> Created By: "+data[item]["creator"]+"</small><small class='text-muted'> Source: " + "<a href=" + data[item]["fact_source"] + ">" + data[item]["fact_source"] + "</a><small></p></div></div>");


          });
                
            }
        });
</script>

<script type="text/javascript">

$(document).on("click", "#reloadpage", function(){
    location.reload(true);
});

</script>

<script>
$('div.alert').not('.alert-success').delay(3000).fadeOut(350);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>

<script type="text/javascript">
    $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '<img style="margin-left:700px;width:30px;height:30px;" src={{asset("/storage/discussion_images/loading.gif")}} alt="Loading..." />',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>

    </body>


</html>
