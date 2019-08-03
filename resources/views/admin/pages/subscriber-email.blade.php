@extends('admin.layout.master')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title ">
                    <a href="{{route('manage.subscribers')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-eye"></i> View Subscribers
                    </a>

                    <br>
                </div>
                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('send.email.subscriber')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <label><strong>Subject</strong></label>
                                <input type="text" name="subject" class="form-control input-lg" value="">
                            </div>
                            <div class="form-group">
                                <label><strong>Email Message</strong></label>
                                <textarea class="form-control" name="emailMessage" rows="10">

                                                </textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="submit-btn btn btn-primary btn-lg btn-block login-button">Send Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection