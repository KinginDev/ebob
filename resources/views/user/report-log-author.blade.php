@extends('user')

@section('css')
    <link href="{{ asset('assets/front/css/report-chat.css') }}" rel="stylesheet">
@stop
@section('content')
    <!-- get in touch area start -->
    <div class="get-in-touch-area cotnact-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 remove-col-padding">
                    <div class="panel panel-primary panel-custom " id="app"><!-- single pricing table -->
                        <div class="panel-heading ">
                            <h4 class="name">{{$page_title}} for: {{$milestone->title or ''}}
                                ({{round($milestone->amount,2)}}  {{$basic->currency}} )</h4>
                        </div>
                        <div class="panel-body" id="messages">
                            <ul class="chat" id="message_append_body">

                                @foreach($messages as $data)
                                    <li class="@if(Auth::user()->id == $data->report_from) right  @else left @endif  clearfix chat-length messages"
                                        data-length="{{ $data->id }}">
                                    <span class="chat-img @if(Auth::user()->id == $data->report_from) pull-right @else pull-left @endif  ">

                                        @if(Auth::user()->id == $data->report_from)
                                            @php $string = $data->user->username @endphp
                                            <img src="https://placehold.it/50/FA6F57/fff&text={{strtoupper($string[0])}}"
                                                 alt="User Avatar"
                                                 class="img-circle"/>
                                        @else
                                            @if($data->report_from!=0)
                                                @php $string = $data->user->username @endphp
                                                <img src="https://placehold.it/50/55C1E7/fff&text={{strtoupper($string[0])}}" alt="User Avatar"
                                                     class="img-circle"/>
                                            @else
                                                <img src="https://placehold.it/50/55C1E7/fff&text=A" alt="User Avatar"
                                                     class="img-circle"/>
                                            @endif
                                        @endif
                                    </span>
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                @if(Auth::user()->id == $data->report_from)
                                                    <small class="text-muted">
                                                        <span class="glyphicon glyphicon-time"></span>{{$data->created_at}}
                                                    </small>
                                                    <strong class="pull-right primary-font">{{$data->user->username}}</strong>
                                                @else
                                                    @if($data->report_from!=0)
                                                        <strong class="primary-font">{{$data->user->username}}</strong>
                                                    @else
                                                        <strong class="primary-font">Admin</strong>
                                                    @endif

                                                    <small class="pull-right text-muted">
                                                        <span class="glyphicon glyphicon-time"></span>{{$data->created_at}}
                                                    </small>
                                                @endif
                                            </div>
                                            <p>{!! $data->report !!}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <!-- //.content form wrapper -->
                        </div>
                        <div class="panel-footer">
                            <form id="sendMessage" onsubmit="sendMessage(event)">
                                @csrf
                                <div class="input-group">
                                    <input type="hidden" name="report_against" id="report_against"
                                           value="{{$report_against}}">
                                    <input type="hidden" name="milestone_id" id="milestone_id"
                                           value="{{$milestone_id}}">
                                    <input type="hidden" name="amount" id="amount" value="{{$amount}}">
                                    <input id="btn-input" type="text" name="report" class="form-control input-lg"
                                           placeholder="Type your message here..." autocomplete="off"/>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary custom-sbtn btn-lg" id="btn-chat">
                                            Send
                                        </button>
                                    </span>
                                </div>
                                <p class="eml"></p>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- get in touch area end -->


@endsection
@section('js')
    <script>
        $(document).ready(function () {
            var elem = document.getElementById('messages');
            elem.scrollTop = elem.scrollHeight;
        });


        $(document).ready(function () {
            setInterval(function () {
                var length = $('.chat').find('.chat-length:last').data('length');
                if (typeof length === "undefined") {
                    length = 0;
                }

                var user = "{{ Auth::id() }}";
                var report_against = $('#report_against').val();
                var milestone_id = $('#milestone_id').val();
                var amount = $('#amount').val();
                $.ajax({
                    url: '{{ route('get.chat') }}',
                    type: 'post',
                    data: {
                        length: length,
                        report_from: user,
                        report_against: report_against,
                        milestone_id: milestone_id,
                        amount: amount
                    },
                    success: function (data) {
                        $.each(data, function (key, val) {
                            var auth = "{{Auth::user()->username}}";
                            //var newSender = val.user.username;
                            var newSender = (val.user != null) ? val.user.username : 'admin';
                            var name = (val.report_from == user) ? auth.substr(0, 1) : newSender.substr(0, 1);
                            if (user == val.report_from) {
                                var html = '<li class="right clearfix chat-length" data-length="' + val.id + '"><span class="chat-img pull-right">\n' +
                                    '                            <img src="https://placehold.it/50/FA6F57/fff&text=' + name.toUpperCase() + '" alt="User Avatar" class="img-circle" />\n' +
                                    '                        </span>\n' +
                                    '                            <div class="chat-body clearfix">\n' +
                                    '                                <div class="header">\n' +
                                    '                                    <small class=" text-muted"><span class=" glyphicon glyphicon-time"></span>' + val.created_at + '</small>' +
                                    '                                   <strong class="pull-right  primary-font">' + auth + '</strong>' +
                                    '                               </div>\n' +
                                    '                                <p>\n' + val.report +
                                    '                                </p>\n' +
                                    '                            </div>\n' +
                                    '                        </li>'
                            }

                            else {
                                var html = '<li class="left clearfix chat-length" data-length="' + val.id + '"><span class="chat-img pull-left">\n' +
                                    '                            <img src="https://placehold.it/50/55C1E7/fff&text=' + name.toUpperCase() +'" alt="User Avatar" class="img-circle" />\n' +
                                    '                        </span>\n' +
                                    '                            <div class="chat-body clearfix">\n' +
                                    '                                <div class="header">\n' +
                                    '                                    <strong class="primary-font">'+newSender+'</strong>' +
                                    '                                       <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>' + val.created_at + '</small>\n' +
                                    '                                </div>\n' +
                                    '                                <p>\n' + val.report +
                                    '                                </p>\n' +
                                    '                            </div>\n' +
                                    '                        </li>'
                            }
                            $('#message_append_body').append(html).ready(function () {
                                var elem = document.getElementById('messages');
                                elem.scrollTop = elem.scrollHeight;
                            });

                        });
                    }
                });
            }, 2000)
        });


        function sendMessage(e) {
            e.preventDefault();
            var form = document.getElementById('sendMessage');
            var fd = new FormData(form);
            $.ajax({
                url: '{{route('store.message')}}',
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('.input-lg').val('');
                }
            });
        }
    </script>
@endsection
