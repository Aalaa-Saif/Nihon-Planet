<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Nihon Planet</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <link href="{{ asset('css/admindashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="nofollow" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="{{ asset('js/admindashboardjs.js') }}"></script>

</head>
<html >

<body>



<div class="container">
    <div id="sidebar-id" class="sidebar border-right border-dark">


        <div class="sidebar-header">
            <button class="close closedash" type="button">
                <span >&times</span>
            </button>
        </div>
        <div>
            <img class="img-fluid rounded-circle mt-5 mx-auto d-block" src="{{ asset('img/adminimg/'.$admin->photo) }}" style="width:100px; height:100px;">
            <h2 class="adminName text-center">{{ $admin->name }}</h2>
            <span><img src="{{ asset('img/edit.png') }}" style="width:15px; height:15px;" class="click_pen" alt="edit"></span>
        </div>

        <div id="changeProfile" class="changeProfile">
            <form method="POST" action="" id="profile_update_id" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-center">Admin Name</label>

                    <div class="col-md-7">
                        <input type="text" class="form-control" name="name" value="{{ $admin->name }}" autofocus>
                            <small id="name_ar_error" class="small-text text-danger font-weight-bold" role="alert"></small>
                    </div>
                </div>
                <input type="text" class="form-control" name="id" style="display:none;" value="{{ $admin->id }}">

                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-center">Admin Photo</label>

                        <img class="img-fluid ml-3" style="width:100px; height:100px" src="{{asset('img/adminimg/'.$admin->photo)}}">

                        <div class="col-md-5 mt-5">
                            <input type="file" class="form-control mt-2" name="photo">
                                <small class="small-text text-danger font-weight-bold" role="alert"></small>
                        </div>
                </div>

                <div class="row">
                    <div class="col-md-3 offset-md-3">
                        <button id="profile_update_btn" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>
            </form>

            <button class="close text-light profile_close" type="button">
                <span>&times</span>
            </button>
        </div>



        <hr class="bg-dark mx-1">
        <div class="sidebar-body">

            <ul>
                <p class="mb-1">Pages</p>
                <li class="nav-item">
                    <img src="{{ asset('img/nihon.png') }}" class="mr-1" style="width:30px; height:30px;"><a href="#first" data-toggle="collapse" aria-expanded="false" aria-controls="first">Nihon</a>
                    <ul id="first" class="collapse">
                        <li class="nav-item">
                            <a href="{{ url('nihon create') }}">Create Nihon</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('nihon all') }}">Edit/Delete Nihon</a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <img src="{{ asset('img/city.png') }}" class="mr-1" style="width:30px; height:30px;"><a href="#second" data-toggle="collapse" aria-expanded="false" aria-controls="second">City</a>
                    <ul id="second" class="collapse">
                        <li class="nav-item">
                            <a href="{{ url('city create') }}">Create City</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('city all') }}">Edit/Delete City</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <img src="{{ asset('img/cloth.png') }}" class="mr-1" style="width:30px; height:30px;"><a href="#third" data-toggle="collapse" aria-expanded="false" aria-controls="third">Cloths</a>
                    <ul id="third" class="collapse">
                        <li class="nav-item">
                            <a href="{{ url('cloths create') }}">Create Cloths</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('cloths all') }}">Edit/Delete Cloths</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <img src="{{ asset('img/food.png') }}" class="mr-1" style="width:30px; height:30px;"><a href="#fourth" data-toggle="collapse" aria-expanded="false" aria-controls="fourth">Food</a>
                    <ul id="fourth" class="collapse">
                        <li class="nav-item">
                            <a href="{{ url('food create') }}">Create Food</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('food all') }}">Edit/Delete Food</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <img src="{{ asset('img/all might.png') }}" class="mr-1" style="width:30px; height:30px;"><a href="#fifth" data-toggle="collapse" aria-expanded="false" aria-controls="fifth">Advertisement</a>
                    <ul id="fifth" class="collapse">
                        <li class="nav-item">
                            <a href="{{ url('ad create') }}">Create Advertisement</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('ad all') }}">Edit/Delete Advertisement</a>
                        </li>
                    </ul>
                </li>

                <hr class="bg-dark mx-1">
                <li class="nav-item">
                    <img src="{{ asset('img/logout.ico') }}" class="mr-1" style="width:30px; height:30px;"> <a href="{{ url('admin logout') }}">Logout</a>
                </li>
            </ul>

        </div>
    </div>



     <div id="sidebtn-id">
        <button class="btn navbar-btn navbar-toggler navbar-light bg-light opendash" type="button"> <span class="navbar-toggler-icon"></span></button>
        <h3 class="navbar-text text-center"><a href="{{ url('admin dashboard') }}" class="text-dark"><u>Admin Dashboard</u></a></h3>

        <br>

        @yield('content')

     </div>


</div>




    <script>

$(document).on('click','#profile_update_btn',function(e){
    e.preventDefault();

    var formData = new FormData($('#profile_update_id')[0]);
    $.ajax({
        method:"post",
        enctype:"multipart/form-data",
        url:"{{ route('admin_update_profile') }}",
        data:formData,
        processData:false,
        contentType:false,
        cache:false,
        success:function(data){
            if(data.status==true){
                location.reload();
            }
        },
        error:function(reject){

        }
    });
});

    </script>




    <!-- jQuery library -->
 <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 @yield('script')

</body>
</html>







