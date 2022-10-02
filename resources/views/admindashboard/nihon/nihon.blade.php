@extends('layouts.admindashboard-app')
@section('content')
    <div class="container">

        <span><a href="{{ url('#') }}" class="btn btn-primary" role="button">Nihon edit</a></span>

        <div id="niDeletesuccess" class="alert alert-success my-2" style="display:none;"></div>
        <div id="niDeletef" class="alert alert-danger my-2" style="display:none;"></div>

            <div class="row">
                <div class="table-responsive">

                    <table class="table teble-bordered bg-dark rounded text-light col-md-12">
                        <tr>
                            <th>ID</th>
                            <th>Name_ar</th>
                            <th>Name_en</th>
                            <th>Info_ar</th>
                            <th>Info_en</th>
                        </tr>
                        @foreach($all as $nihon)
                        <tr class="table_food{{ $nihon->id }}">
                            <th class="col-md-2">{{ $nihon->id }}</th>
                            <td class="col-md-4">
                                <p>{{ $nihon->name_ar }}</p>
                            </td>
                            <td class="col-md-4">
                                <p>{{ $nihon->name_en }}</p>
                            </td>
                            <td class="col-md-4">
                                <p>{{ $nihon->info_ar }}</p>
                            </td>
                            <td class="col-md-4">
                                <p>{{ $nihon->info_en }}</p>
                            </td>
                            <td class="col-md-2">
                                <a href="{{ route('food_edit',$nihon->id) }}" class="btn btn-success" role="button">edit</a>
                            </td>
                            <td class="col-md-2">
                                <a href="" food_id="{{ $nihon->id }}" class="btn btn-danger food_delete" role="button">delete</a>
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
        $(document).on('click','.food_delete',function(e){
            e.preventDefault();

            var foodData = $(this).attr('food_id');
            $.ajax({
                method:"post",
                url:"{{ route('food_delete') }}",
                data:{
                    "_token":"{{ csrf_token() }}",
                    "id":foodData
                },

                success:function(data){
                    if(data.status==true){
                        var div = document.getElementById('foDeletesuccess');
                        div.innerHTML=data.msg;
                        $('#foDeletesuccess').show();
                    }
                    else {
                        var div = document.getElementById('foDeletef');
                        div.innerHTML=data.msg;
                        $('#foDeletef').show();
                    }

                    $('.table_food'+data.id).remove();
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

