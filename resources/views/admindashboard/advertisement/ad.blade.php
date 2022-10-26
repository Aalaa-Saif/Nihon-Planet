@extends('layouts.admindashboard-app')
@section('content')
    <div class="container">

        <span><a href="{{ url('#') }}" class="btn btn-primary" role="button">Nihon edit</a></span>

        <div id="adDeletesuccess" class="alert alert-success my-2" style="display:none;"></div>
        <div id="adDeletef" class="alert alert-danger my-2" style="display:none;"></div>

            <div class="row">
                <div class="table-responsive">

                    <table class="table teble-bordered bg-dark rounded text-light col-md-12">
                        <tr>
                            <th>ID</th>
                            <th>Text</th>
                            <th>Media</th>
                        </tr>
                        @foreach($all as $ad)
                        <tr class="table_ad{{ $ad->id }}">
                            <th class="col-md-2">{{ $ad->id }}</th>
                            <td class="col-md-4">
                                <p>{{ $ad->text }}</p>
                            </td>
                            <td class="col-md-4">
                                <img src="{{ asset('img/ad/'.$ad->media) }}" style="width:100px; height:100px;">
                                <vedio controls width="400px">
                                    <source src="{{URL::asset('/img/ad/$ad->media')}}" type="video/mp4">

                                </vedio>
                            </td>

                            <td class="col-md-2">
                                <a href="{{ route('ad_edit',$ad->id) }}" class="btn btn-success" role="button">edit</a>
                            </td>
                            <td class="col-md-2">
                                <a href="" ad_id="{{ $ad->id }}" class="btn btn-danger ad_delete" role="button">delete</a>
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
        $(document).on('click','.ad_delete',function(e){
            e.preventDefault();

            var formData = $(this).attr('ad_id');
            $.ajax({
                method:"post",
                url:"{{ route('ad_delete') }}",
                data:{
                    "_token":"{{ csrf_token() }}",
                    "id":formData
                },

                success:function(data){
                    if(data.status==true){
                        var div = document.getElementById('adDeletesuccess');
                        div.innerHTML=data.msg;
                        $('#adDeletesuccess').show();
                    }
                    else {
                        var div = document.getElementById('adDeletef');
                        div.innerHTML=data.msg;
                        $('#adDeletef').show();
                    }

                    $('.table_ad'+data.id).remove();
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

