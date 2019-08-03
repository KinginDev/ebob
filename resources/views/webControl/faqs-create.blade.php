@extends('admin.layout.master')
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    {!! Form::open(['method'=>'post','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
                    <div class="form-body">

                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Question Title</strong></label>
                                    <div class="col-md-12 ">
                                        <input name="title" class="form-control input-lg" placeholder="Question Title" required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Question Answer</strong></label>
                                    <div class="col-md-12 ">
                                        <textarea name="description" id="area1" rows="10" class="form-control" required placeholder="Question Answer"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" onclick="nicEditors.findEditor('area1').saveContent();" class="btn btn-primary btn-block bold btn-lg uppercase"><i class="fa fa-send"></i> Create FAQS</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div>
                    {!! Form::close() !!}
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