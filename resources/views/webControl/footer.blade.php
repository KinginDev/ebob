@extends('admin.layout.master')
@section('import-css')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@stop
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    {!! Form::model($basic,['route'=>['manage-footer-update'],'method'=>'PUT','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}

                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group{{ $errors->has('short_about') ? ' has-error' : '' }}">
                                    <label class="col-md-12"><strong class="text-uppercase">WebSite short About </strong></label>
                                    <div class="col-md-12">
                                        <textarea name="short_about"  rows="5" class="form-control" required>{{ $basic->short_about }}</textarea>
                                        @if ($errors->has('short_about'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('short_about') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>



                                <div class="form-group{{ $errors->has('experience') ? ' has-error' : '' }}">
                                    <label class="col-md-12"><strong class="text-uppercase">Our Experience</strong></label>
                                    <div class="col-md-12">
                                        <textarea name="experience" class="form-control" required>{{ $basic->experience }}</textarea>
                                        @if ($errors->has('experience'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('experience') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('copyright_text') ? ' has-error' : '' }}">
                                    <label class="col-md-12"><strong class="text-uppercase">Copyright Text</strong></label>
                                    <div class="col-md-12">
                                        <textarea name="copyright_text" class="form-control" required>{{ $basic->copyright_text }}</textarea>
                                        @if ($errors->has('copyright_text'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('copyright_text') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                   <div class="form-group{{ $errors->has('breadcrumb_text') ? ' has-error' : '' }}">
                                    <label class="col-md-12"><strong class="text-uppercase">Breadcrumb Text</strong></label>
                                    <div class="col-md-12">
                                        <textarea name="breadcrumb_text" class="form-control" required>{{ $basic->copyright_text }}</textarea>
                                        @if ($errors->has('breadcrumb_text'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('breadcrumb_text') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group{{ $errors->has('fb_comment') ? ' has-error' : '' }}">
                                    <label class="col-md-12"><strong class="text-uppercase">Facebook Comment Script</strong></label>
                                    <div class="col-md-12">
                                        <textarea name="fb_comment" rows="10" class="form-control" required>{{ $basic->fb_comment }}</textarea>
                                        @if ($errors->has('fb_comment'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('fb_comment') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-block btn-lg"><i class="fa fa-send"></i> UPDATE</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- row -->

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@stop

@section('import-script')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@stop