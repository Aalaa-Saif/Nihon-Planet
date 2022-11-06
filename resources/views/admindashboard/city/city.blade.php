@extends('layouts.admindashboard-app')
@section('content')
    <div class="container">

        <div id="ciDeletesuccess" class="alert alert-success my-2" style="display:none;"></div>
        <div id="ciDeletef" class="alert alert-danger my-2" style="display:none;"></div>

            <div class="row">
                <div class="table-responsive">

                    <table class="table teble-bordered bg-dark rounded text-light col-md-12">
                        <tr>
                            <th>ID</th>
                            <th>Name_ar</th>
                            <th>Name_en</th>
                            <th>Photo</th>
                        </tr>
                        @foreach($all as $city)
                        <tr class="table_city{{ $city->id }}">
                            <th class="col-md-2">{{ $city->id }}</th>
                            <td class="col-md-4">
                                <p>{{ $city->name_ar }}</p>
                            </td>
                            <td class="col-md-4">
                                <p>{{ $city->name_en }}</p>
                            </td>
                            <td class="col-md-4">
                                @foreach ($city->images as $img)
                                <a href="">
                                    <img id='imgstyle' src="{{asset('img/city/'.$img->image)}}" style="width:100px; height:100px;"> <br>
                                </a>
                                @endforeach

                            </td>
                            <td class="col-md-2">
                                <a href="{{ route('city_edit',$city->id) }}" class="btn btn-success" role="button">edit</a>
                            </td>
                            <td class="col-md-2">
                                <a href="" city_id="{{ $city->id }}" class="btn btn-danger city_delete" role="button">delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                </div>
            </div>

    </div>
@stop


@section('script')
    <script>
        $(document).on('click','.city_delete',function(e){
            e.preventDefault();

            var formData = $(this).attr('city_id');
            $.ajax({
                method:"post",
                url:"{{ route('city_delete') }}",
                data:{
                    "_token":"{{ csrf_token() }}",
                    "id":formData
                },

                success:function(data){
                    if(data.status==true){
                        var div = document.getElementById('ciDeletesuccess');
                        div.innerHTML=data.msg;
                        $('#ciDeletesuccess').show();
                    }
                    else {
                        var div = document.getElementById('ciDeletef');
                        div.innerHTML=data.msg;
                        $('#ciDeletef').show();
                    }

                    $('.table_city'+data.id).remove();
                },
                error:function(reject){
                    var ajaxresponse = $.parseJSON(reject.responseText);
                    $.each(ajaxresponse.errors,function(key,val){
                        $("#"+key+"_error").text(val[0]);
                    });
                }
            });
        });
    </script>
@endsection

