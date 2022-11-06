@extends('layouts.admindashboard-app')
@section('content')
    <div class="container">

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
                        <tr class="table_nihon{{ $nihon->id }}">
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
                                <a href="{{ route('nihon_edit',$nihon->id) }}" class="btn btn-success" role="button">edit</a>
                            </td>
                            <td class="col-md-2">
                                <a href=""  nihon_id="{{ $nihon->id }}" class="btn btn-danger nihon_delete" role="button">delete</a>
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
        $(document).on('click','.nihon_delete',function(e){
            e.preventDefault();

            var formData = $(this).attr('nihon_id');
            $.ajax({
                method:"post",
                url:"{{ route('nihon_delete') }}",
                data:{
                    "_token":"{{ csrf_token() }}",
                    "id":formData
                },

                success:function(data){
                    if(data.status==true){
                        var div = document.getElementById('niDeletesuccess');
                        div.innerHTML=data.msg;
                        $('#niDeletesuccess').show();
                    }
                    else {
                        var div = document.getElementById('niDeletef');
                        div.innerHTML=data.msg;
                        $('#niDeletef').show();
                    }

                    $('.table_nihon'+data.id).remove();
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

