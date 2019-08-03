@extends('admin.layout.master')
@section('css')
    <link href="{{ asset('assets/front/css/report-chat.css') }}" rel="stylesheet">
@stop
@section('body')

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="mailbox-controls">
                    <div class="tile-title ">
                        <h4 class="name">Conversation for: {{$milestone->title}}
                            ({{$milestone->amount}} {{$basic->currency}} )</h4>
                    </div>
                    <p>
                        @php $user_id = []; @endphp
                        @foreach($reports as $data)
                            @if(!in_array($data->report_from, $user_id))
                                @if($data->report_from !=0)
                                    <button class="btn btn-primary icon-btn milestone_button"
                                            data-milestone="{{$milestone_id}}"
                                            data-user="{{$data->user->id}}"
                                            data-username="{{$data->user->name}}"
                                            data-toggle="modal" data-target="#payButton">
                                        <i class="fa fa-user"></i>
                                        {{$data->user->name}}</button>
                                    @php $user_id[] = $data->report_from; @endphp
                                @endif
                            @endif
                        @endforeach


                    </p>
                </div>
                <div class="tile-body">


                    <div class="panel panel-primary panel-custom " id="app"><!-- single pricing table -->
                        <div class="panel-body" id="messages">
                            <ul class="chat" id="message_append_body">


                                @foreach($reports as $data)
                                    <li class="@if( $data->report_from == 0) right  @else left @endif  clearfix chat-length messages"
                                        data-length="{{ $data->id }}">
                                    <span class="chat-img @if( $data->report_from != 0) pull-left @else pull-right @endif ">
                                        @if($data->report_from!=0)
                                            @php $string = $data->user->username @endphp
                                            <img src="https://placehold.it/50/55C1E7/fff&text={{strtoupper($string[0])}}"
                                                 alt="User Avatar"
                                                 class="img-circle border-radius-50"/>
                                        @else
                                            <img src="https://placehold.it/50/FA6F57/fff&text=A"
                                                 alt="User Avatar"
                                                 class="img-circle border-radius-50"/>

                                        @endif


                                    </span>
                                        <div class="chat-body clearfix">
                                            <div class="header">

                                                @if($data->report_from!=0)
                                                    <strong class="primary-font">{{$data->user->username}}</strong>
                                                    <small class="pull-right text-muted">
                                                        <span class="glyphicon glyphicon-time"></span>{{$data->created_at}}
                                                    </small>
                                                @else

                                                    <small class="text-muted">
                                                        <span class="glyphicon glyphicon-time"></span>{{$data->created_at}}
                                                    </small>
                                                    <strong class="pull-right primary-font">Admin</strong>
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
                                    <input type="hidden" name="report_against" id="report_against" value="0">
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



    <div class="modal fade editModal" id="payButton" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2"><strong>Confirm Milestone Request</strong></h4>

                    <button type="button" class="btn btn-default btn-xs pull-right"
                            data-dismiss="modal">X
                    </button>
                </div>


                <form method="post" action="{{route('milestone.accepted')}}">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure to added balance to '<strong id="username"></strong>' ??</p>
                        <input type="hidden" name="milestone_id" id="get_milestone_id">
                        <input type="hidden" name="user_id" id="user_id">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Yes</button>
                        <button class="btn btn-danger" data-dismiss="modal" aria-label="Close"><i
                                    class="fa fa-times"></i> No
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script type="text/javascript">

        $(document).on('click', '.milestone_button', function () {
            var milestoneId = $(this).data('milestone');
            var userId = $(this).data('user');
            var username = $(this).data('username');
            $('#get_milestone_id').val(milestoneId);
            $('#user_id').val(userId);
            $('#username').text(username);
        });


        $(document).ready(function () {
            setInterval(function () {
                var length = $('.chat').find('.chat-length:last').data('length');
                if (typeof length === "undefined") {
                    length = 0;
                }
                var user = "0";
                var user2 = "{{ Auth::guard('web')->user()->id}} ";
                var report_against = $('#report_against').val();
                var milestone_id = $('#milestone_id').val();
                var amount = $('#amount').val();
                $.ajax({
                    url: '{{ route('admin.get.chat') }}',
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
                            var auth = "admin";

                            var newSender = (val.user != null) ? val.user.username : 'a';
                            var name = (val.report_from == user) ? auth.substr(0, 1) : newSender.substr(0, 1);
                            var name2 = (val.report_from == user2) ? auth.substr(0, 1) : newSender.substr(0, 1);
                            if (user == val.report_from) {
                                var html = '<li class="right clearfix chat-length" data-length="' + val.id + '"><span class="chat-img pull-right">\n' +
                                    '                            <img src="https://placehold.it/50/FA6F57/fff&text=A" alt="User Avatar" class="img-circle border-radius-50" />\n' +
                                    '                        </span>\n' +
                                    '                            <div class="chat-body clearfix">\n' +
                                    '                                <div class="header">\n' +
                                    '                                    <small class=" text-muted"><span class=" glyphicon glyphicon-time"></span>' + val.created_at + '</small>' +
                                    '                                   <strong class="pull-right  primary-font">Admin</strong>' +
                                    '                               </div>\n' +
                                    '                                <p>\n' + val.report +
                                    '                                </p>\n' +
                                    '                            </div>\n' +
                                    '                        </li>'
                            } else {

                                var html = '<li class="left clearfix chat-length" data-length="' + val.id + '"><span class="chat-img pull-left">\n' +
                                    '                            <img src="https://placehold.it/50/55C1E7/fff&text=' + name.toUpperCase() + '" alt="User Avatar" class="img-circle border-radius-50" />\n' +
                                    '                        </span>\n' +
                                    '                            <div class="chat-body clearfix">\n' +
                                    '                                <div class="header">\n' +
                                    '                                    <strong class="primary-font">' + newSender + '</strong>' +
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
                url: '{{route('admin.send.report')}}',
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('.input-lg').val('');
                }
            });
        }

        $(document).ready(function () {
            var elem = document.getElementById('messages');
            elem.scrollTop = elem.scrollHeight;
        })

    </script>
@stop

