@extends('layouts.main-app')
@section('content')
<div class="container nihon-container my-5">
    <div class="row nihon">


    </div>

</div>

@endsection


@section('script')
    <script>
        $(document).ready(function(){
            $.ajax({
                method:"get",
                url:"{{ route('get_nihon') }}",
                success:function(response){

                    $('.nihon').html("");

                    $.each(response.gn, function(key, value) {
                        $('.nihon').append('<div class="col-md-8 my-2">\
                            <h1>'+value.name+'</h1>\
                            <br>\
                            <h3 class="mx-2">'+value.info+'</h3>\
                        </div>');

                        console.log(response.gn);
                    });

                },
                error:function(reject){

                }
            });
        })
    </script>
@endsection

