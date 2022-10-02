@extends('layouts.main-app')
@section('content')
    <div class="container my-4">
        <div class="row food">

    </div>

@endsection


@section('script')
    <script>
        $(document).ready(function(){
            $.ajax({
                method:"get",
                url:"{{ route('get_food') }}",
                success:function(response){

                    $('.food').html("");

                    $.each(response.gf, function(key, value) {
                        $('.food').append('<div class="col-md-4">\
                            <div class="card border-dark">\
                                <div class="card-body">\
                                    <img class="img-fluid card-img-top" src="/img/food/'+value.photo+'" style="width:300px; height:300px;">\
                                    <h3 class="text-center my-1">'+value.name+'</h3>\
                                    <h5 class="text-center my-1">'+value.info+'</h5>\
                                </div>\
                            </div>\
                        </div> ');

                        console.log(response.gf);
                    });

                },
                error:function(reject){

                }
            });
        })
    </script>
@endsection
