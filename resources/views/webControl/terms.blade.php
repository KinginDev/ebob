@extends('admin.layout.master')
@section('css')
@stop
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form class="form-horizontal" method="post" role="form">
                        {!! csrf_field() !!}
                        <div class="form-body">

                            <div class="form-group{{ $errors->has('terms') ? ' has-error' : '' }}">
                                <label class="col-md-12"><strong style="text-transform: uppercase;">Terms & Condition</strong></label>
                                <div class="col-md-12">
                                    <textarea id="area1" class="form-control" rows="15"
                                              name="terms">{{ $basic->terms }}</textarea>
                                    @if ($errors->has('terms'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('terms') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <br>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block btn-lg"><i
                                            class="fa fa-send"></i> Update Terms & Condition
                                </button>
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
        bkLib.onDomLoaded(function () {
            new nicEditor({fullPanel: true}).panelInstance('area1');
        });
    </script>
@stop