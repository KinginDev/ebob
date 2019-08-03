@extends('admin.layout.master')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form class="form-horizontal" role="form" action="" method="post">
                        @csrf
                        <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                            <label class="col-md-3 offset-1 control-label"><b>Current Password</b></label>
                            <div class="col-md-9 offset-1">
                                <div class="input-group">
                                    <input type="password" name="old_password" class="form-control "
                                           placeholder="Current Password">
                                    <div class="input-group-append"><span class="input-group-text"><i
                                                    class="fa fa-lock"></i></span></div>
                                </div>
                                @if ($errors->has('old_password'))
                                    <strong class="error">{{ $errors->first('old_password') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label class="col-md-3 offset-1 control-label"><b>New Password</b></label>
                            <div class="col-md-9 offset-1">
                                <div class="input-group">
                                    <input type="password" name="new_password" class="form-control "
                                           placeholder="New Password">
                                    <div class="input-group-append"><span class="input-group-text"><i
                                                    class="fa fa-lock"></i></span></div>
                                </div>
                                @if ($errors->has('new_password'))
                                    <strong class="error">{{ $errors->first('new_password') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-3 offset-1 control-label"><b>Confirm Password</b></label>
                            <div class="col-md-9 offset-1">
                                <div class="input-group">
                                    <input type="password" name="password_confirmation"
                                           class="form-control " placeholder="Confirm Password">
                                    <div class="input-group-append"><span class="input-group-text"><i
                                                    class="fa fa-lock"></i></span></div>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <strong class="error">{{ $errors->first('password_confirmation') }}</strong>
                                @endif
                            </div>
                        </div>


                        <div class="col-md-offset-3 offset-1 col-md-9">
                            <button type="submit" class="btn btn-block btn-lg btn-primary">Submit</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>


@stop