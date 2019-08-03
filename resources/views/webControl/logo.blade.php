@extends('admin.layout.master')
@section('import-css')
    <link href="{{ asset('assets/admin/css/jquery.fileupload.css') }}" rel="stylesheet">
@stop
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('manage-logo')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;background: #eeeeee" data-trigger="fileinput">
                                        <img style="width: 200px" src="{{ asset('assets/images/logo/logo.png') }}" alt="...">

                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                    <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select Logo</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="logo" accept="image/*" >
                                                </span>
                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                                @if ($errors->has('logo'))
                                    <div class="error">{{ $errors->first('logo') }}</div>
                                @endif
                            </div>



                            <div class="col-md-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput" >
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px; background: #eeeeee" data-trigger="fileinput">
                                        <img style="width: 200px" src="{{ asset('assets/images/logo/favicon.png') }}" alt="...">

                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select favicon</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="favicon" accept="image/*" >
                                                </span>
                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                                @if ($errors->has('favicon'))
                                    <div class="error">{{ $errors->first('favicon') }}</div>
                                @endif
                            </div>

                        </div>

                        <br><br>
                        <div class="row">
                            <div class="form-actions right col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@stop

@section('import-script')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@stop