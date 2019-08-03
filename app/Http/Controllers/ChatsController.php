<?php

namespace App\Http\Controllers;

use App\Message;
use App\Report;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;


class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|min:0',
            'report' => 'required',
            'report_against' => 'required',
            'milestone_id' => 'required',
        ]);

        if ($validator->fails()) {
            $validator->errors()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $data['msg'] = Report::create([
            'report' => $request->report,
            'amount' => $request->amount,
            'report_against' => $request->report_against,
            'milestone_id' => $request->milestone_id,
            'report_from' => Auth::user()->id
        ]);
        if (isset($data['msg'])) {
            $data['ok'] = 'success';
        } else {
            $data['ok'] = 'no_success';
        }
        return $data;
    }

    public function getChat(Request $request)
    {
        $user1 = $request->report_from;
        $user2 = $request->report_against;
        $milestone_id = $request->milestone_id;
        $id = $request->length;
        $item = Report::with('receiver', 'user')->where('id', '>', $id)
            ->where('milestone_id',$milestone_id)
            ->whereIn('report_from', [$user1,0])
            ->whereIn('report_against', [$user2,0])
            ->orWhere(function ($query) use ($user1, $user2, $id, $milestone_id) {
                $query->where('id', '>', $id)
                    ->whereIn('report_from', [$user2,0])
                    ->whereIn('report_against', [$user1,0])
                    ->where('milestone_id',$milestone_id);
        })->where('id', '>', $id)->get();

        return $item;
    }

    public function messageslist()
    {
         $user = Auth::id();
          $data['messages'] = Message::where('receiver_id',$user)->orWhere('user_id', $user)->distinct()->get(['bit_job_id']);
        $data['page_title'] = "Messages";
        return view('chat.messagelist', $data);
    }

}
