<div class="notification-wrapper">
    @php
        $user = Auth::id();
        $msg =  App\Report::whereIn('report_against',[$user,0])->where('read_type1',0)->distinct()->get(['milestone_id']);
    @endphp

    <div class="single-notification-item">
        <div class="icon">
            <i class="fab fa-facebook-messenger messenger-white"></i>

            @if($msg->count() >0)<span class="badge__">{{$msg->count()}}</span>@endif
        </div>
        <div class="dropdown-notification">
            <ul>
                @foreach($msg as $data)
                    <li>
                        @php
                            $chat =  App\Report::whereIn('report_against',[$user,0])->where('read_type1',0)->where('milestone_id',$data->milestone_id)->latest()->first();
                        @endphp
                        <a href="{{route('report.log.author',$data->reports->code)}}">
                            <div class="single-notification">
                                <h4 class="title">{{str_limit($chat->report,30)}}</h4>
                                <span class="textColor padding-tb-10 sent-from">Sent From : {{$chat->user->name or 'Admin'}} </span>
                            </div>
                        </a>
                    </li>
                @endforeach
                @if($msg->count() ==0)
                    <li>
                        <div class="single-notification">
                            <h4 class="title">You have no new message</h4>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    @php
        $authUser = Auth::user();
        $notifyMileStones =  App\Milestone::where('user_id',$authUser->id)->latest()->where('status',0)->where('is_read',0)->get();
    @endphp

    <div class="single-notification-item">
        <div class="icon">
            <i class="fa fa-bell"></i>
            @if($notifyMileStones->count() >0)<span class="badge__">{{$notifyMileStones->count()}}</span>@endif
        </div>
        <div class="dropdown-notification">
            <ul>
                @foreach($notifyMileStones->take(5) as $data)
                    <li>
                        <a href="{{route('get.earnStone.list',[$data->escrow->escrow_code])}}">
                            <div class="single-notification">
                                <h4 class="title">
                                    {{$data->title}}
                                    <br>{{round($data->amount, $basic->decimal)}} {{$basic->currency}}
                                </h4>
                                <span class="textColor padding-tb-10 sent-from">Created By : <strong> {{$data->creator->username}}</strong>   </span>
                            </div>
                        </a>
                    </li>
                @endforeach
                @if($notifyMileStones->count() ==0)
                    <li>
                        <div class="single-notification">
                            <h4 class="title">
                                You have no new notification
                            </h4>
                        </div>

                    </li>
                @endif

            </ul>
        </div>

    </div>


</div>