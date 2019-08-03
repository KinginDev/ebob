@extends('admin.layout.master')
@section('css')
@stop
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-body">

                            <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                                <label class="col-md-12"><strong style="text-transform: uppercase;">About Page</strong></label>
                                <div class="col-md-12">
                                    <textarea id="area1" class="form-control" rows="15" name="about">{{ $basic->about }}</textarea>
                                    @if ($errors->has('about'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('about') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                            <div class="col-md-12">
                                <h6>Video Thumbnail</h6>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img style="width: 200px" src="{{asset('assets/images/about-video-image.jpg')}}" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image" accept="image/*" >
                                                </span>
                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                                @if ($errors->has('image'))
                                    <div class="error">{{ $errors->first('image') }}</div>
                                @endif
                            </div>
                                <br>

                            <div class="col-md-12">
                                <h6> Video link</h6>
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg"
                                           name="about_video" value="{{$basic->about_video}}">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-font"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('about_video'))
                                    <div class="error">{{ $errors->first('about_video') }}</div>                                @endif
                            </div>
                            </div>



                            <br>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg"><i class="fa fa-send"></i> Update About</button>
                                </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@stop
@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/NicEdit/0.93/nicEdit.js"></script>

<script type="text/javascript">
    bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('area1'); });
</script>
@stop