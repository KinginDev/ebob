@extends('admin.layout.master')
@section('import-css')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@stop
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title ">{{$page_title}}
                    <a href="{{route('team')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </h3>
                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('update.team',$post->id)}}" name="editForm"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6">
                                <h6> Name</h6>
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg"
                                           name="name" value="{{$post->name}}">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-font"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('name'))
                                    <div class="error">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h6> Designation</h6>
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg"
                                           name="designation" value="{{$post->designation}}">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-font"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('designation'))
                                    <div class="error">{{ $errors->first('designation') }}</div>
                                @endif
                            </div>

                        </div>
                        <br>


                        <div class="row">
                            <div class="col-md-6">
                                <h6>Image</h6>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"
                                         data-trigger="fileinput">
                                        @if($post->image !=  null)
                                        <img style="width: 200px"
                                             src="{{asset('assets/images/our-team/'.$post->image)}}" alt="...">
                                        @else
                                        <img style="width: 200px" src="https://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Image" alt="...">
                                            @endif
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i
                                                                class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i
                                                                class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image" accept="image/*">
                                                </span>
                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase"
                                           data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                                @if ($errors->has('image'))
                                    <div class="error">{{ $errors->first('image') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6> Facebook</h6>
                                        <div class="input-group">
                                            <input type="text" class="form-control input-lg"
                                                   name="facebook" value="{{$post->facebook}}"
                                                   placeholder="https://www.facebook.com/">
                                            <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-facebook"></i>
                                            </span>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <h6> Twitter</h6>
                                        <div class="input-group">
                                            <input type="text" class="form-control input-lg"
                                                   name="twitter" value="{{$post->twitter}}" placeholder="https://twitter.com/">
                                            <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-twitter"></i>
                                            </span>
                                            </div>
                                        </div>

                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <h6> Linkedin</h6>
                                        <div class="input-group">
                                            <input type="text" class="form-control input-lg"
                                                   name="linkedin" value="{{$post->linkedin}}"
                                                   placeholder="https://www.linkedin.com/">
                                            <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-linkedin"></i>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>


                        <div class="row">
                            <div class="col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('import-script')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@stop
@section('script')
@stop