@extends('admin.layout.master')
@section('css')
@stop
@section('body')
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('create.team')}}" class="btn btn-success btn-md pull-right ">
                <i class="fa fa-plus"></i> Create New
            </a>
        </div>
        <br>
        <br>
        @foreach($teams as $key => $data)
            <div class="col-md-4">
                <div class="tile">
                    <div class="tile-title text-center">

                        <img src="{{asset('assets/images/our-team/'.$data->image)}}" width="60%" alt="Image"><br>
                    </div>
                    <div class="tile-body text-center">

                        <h3 class="title">{!! $data->name !!}</h3>
                       <strong>{!! $data->designation !!}</strong>
                    </div>
                    <div class="tile-footer text-center">
                        <a class="btn btn-primary " href="{{route('edit.team',$data->id)}}">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                        <button class="btn btn-danger delete_button"
                           data-toggle="modal" data-target="#DelModal"
                           data-id="{{ $data->id }}">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2"><i class='fa fa-trash'></i> Delete !</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <strong>Are you sure you want to Delete ?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('delete.team') }}" >
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="id" class="abir_id" value="0">

                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Yes</button>

                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash"></i> No</button>&nbsp;
                    </form>
                </div>

            </div>
        </div>
    </div>

@stop
@section('script')
    <script>
        $(document).ready(function () {
            $(document).on("click", '.delete_button', function (e) {
                var id = $(this).data('id');
                $(".abir_id").val(id);
            });
        });
    </script>
@stop