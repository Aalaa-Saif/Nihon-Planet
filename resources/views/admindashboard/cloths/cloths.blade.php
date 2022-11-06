@extends('layouts.admindashboard-app')
@section('content')
    <div class="container div_reload">

        <div id="clDeletesuccess" class="alert alert-success my-2" style="display:none;"></div>
        <div id="clDeletef" class="alert alert-danger my-2" style="display:none;"></div>

            <div class="row">
                <div class="table-responsive">

                    <table class="table teble-bordered bg-dark rounded text-light col-md-12">
                        <tr>
                            <th>ID</th>
                            <th>Name_ar</th>
                            <th>Name_en</th>
                            <th>Photo</th>
                        </tr>
                        @foreach($all as $cloth)
                        <tr class="table_cloth{{ $cloth->id }}">
                            <th class="col-md-2">{{ $cloth->id }}</th>
                            <td class="col-md-4">
                                <p>{{ $cloth->name_ar }}</p>
                            </td>
                            <td class="col-md-4">
                                <p>{{ $cloth->name_en }}</p>
                            </td>
                            <td class="col-md-4">
                                <a href="">
                                    <img id='imgstyle' src="{{asset('img/cloths/'.$cloth->photo)}}" style="width:100px; height:100px;"> <br>
                                </a>
                            </td>
                            <td class="col-md-2">
                                <a href="{{ route('cloths_edit',$cloth->id) }}" class="btn btn-success" role="button">edit</a>
                            </td>
                            <td class="col-md-2">
                                <a href="" cloth_id="{{ $cloth->id }}" class="btn btn-danger cloth_delete" role="button">delete</a>
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
        $(document).on('click','.cloth_delete',function(e){
            e.preventDefault();

            var formData = $(this).attr('cloth_id');
            $.ajax({
                method:"post",
                url:"{{ route('cloths_delete') }}",
                data:{
                    "_token":"{{ csrf_token() }}",
                    "id":formData
                },

                success:function(data){
                    if(data.status==true){
                        var div = document.getElementById('clDeletesuccess');
                        div.innerHTML=data.msg;
                        $('#clDeletesuccess').show();
                    }
                    else {
                        var div = document.getElementById('clDeletef');
                        div.innerHTML=data.msg;
                        $('#clDeletef').show();
                    }

                    $('.table_cloth'+data.id).remove();
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

