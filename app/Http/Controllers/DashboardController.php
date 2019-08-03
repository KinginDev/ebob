<?php

namespace App\Http\Controllers;

use App\Milestone;
use App\Report;
use App\Subscriber;
use App\Trx;
use Illuminate\Http\Request;
use Auth;
use App\GeneralSettings;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

use Validator;

class DashboardController extends Controller
{
    public function __construct()
    {

    }


    public function reports()
    {
        $data['page_title'] = "All Milestone  Reports ";
        $data['reports'] =  Report::where('report_from', '!=',0)->latest()->groupBy('milestone_id')->select(['milestone_id'])->paginate(15);
        return view('admin.pages.reports', $data);
    }

    public function reportsAllView($id)
    {
         $milestone = Milestone::find($id);
        $data['page_title'] = "Milestone Reports Preview";
        $data['reports'] = Report::where('milestone_id',$id)->get();
        $data['milestone_id'] = $milestone->id;
        $data['milestone'] = $milestone;
        $data['amount'] = $milestone->amount;
        foreach ($data['reports'] as $code)
        {
            $code->is_read = 1;
            $code->save();
        }
        return view('admin.pages.reports-list', $data);
    }

    public function storeReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|min:0',
            'report' => 'required',
            'milestone_id' => 'required',
        ]);

        if ($validator->fails()) {
            $validator->errors()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $data['msg'] = Report::create([
            'report' =>$request->report,
            'amount' => $request->amount,
            'milestone_id' => $request->milestone_id,
            'report_against' => 0,
            'report_from' => 0
        ]);
        if (isset($data['msg'])) {
            $data['ok'] = 'success';
        } else {
            $data['ok'] = 'no_success';
        }
        return $data;
    }

    public function adminGetChat(Request $request)
    {
        $milestone_id = $request->milestone_id;
        $id = $request->length;
        $item = Report::with('receiver', 'user')->where('id', '>', $id)->where('milestone_id',$milestone_id)->
        orWhere(function ($query) use ( $id, $milestone_id) {
            $query->where('id', '>', $id)->where('milestone_id',$milestone_id);
        })->where('id', '>', $id)->get();

        foreach ($item as $code)
        {
            $code->is_read = 1;
            $code->save();
        }
        return $item;
    }


    public function milestoneAccepted(Request $request)
    {

        $request->validate([
            'milestone_id' => 'required',
            'user_id' => 'required',
        ]);
        $basic =  GeneralSettings::first();

        $data =  Milestone::find($request->milestone_id);
        if($data->user_id == $request->user_id)
        {
            $user =  User::find($data->user_id) ;
            $user->balance += $data->amount;
            $user->save();
            $data->status = 1;
            $data->save();

            Trx::create([
                'user_id' => $user->id,
                'amount' => $data->amount,
                'main_amo' => $user->balance,
                'charge' => 0,
                'type' => '+',
                'title' => 'Added Balance By Admin From ' . $data->title . '  milestone',
                'trx' => str_random(16)
            ]);

            $txt = 'Added '. $data->amount . ' '.  $basic->currency . ' By Admin From ' . $data->title . '  milestone';
            send_email($user->email, $user->username, 'Added money ', $txt);

        }elseif($data->creator_id == $request->user_id)
        {
            $user =  User::find($data->creator_id) ;
            $user->balance += $data->amount;
            $user->save();

            $data->status = -1;
            $data->save();

            Trx::create([
                'user_id' => $user->id,
                'amount' => $data->amount,
                'main_amo' => $user->balance,
                'charge' => 0,
                'type' => '+',
                'title' => 'Added Balance By Admin From ' . $data->title . '  milestone ',
                'trx' => str_random(16)
            ]);

            $txt = 'Added '. $data->amount . ' '.  $basic->currency . ' By Admin From ' . $data->title . '  milestone';
            send_email($user->email, $user->username, 'Added money ', $txt);
        }

        Report::where('milestone_id',$request->milestone_id)->update(['status' => 1]);

        return  redirect()->route('admin.reports');
    }






    public function sendMail()
    {
        $data['page_title'] = 'Mail to Subscribers';
        return view('admin.pages.subscriber-email', $data);
    }

    public function sendMailsubscriber(Request $request)
    {
        $this->validate($request,
            [
                'subject' => 'required',
                'emailMessage' => 'required'
            ]);
        $subscriber = Subscriber::whereStatus(1)->get();
        foreach ($subscriber as $data) {
            $to =  $data->email;
            $name = substr($data->email, 0, strpos($data->email, "@"));
            $subject = $request->subject;
            $message = $request->emailMessage;
            send_email($to, $name, $subject, $message);
        }
        $notification = array('message' => 'Mail Sent Successfully!', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function manageSubscribers()
    {
        $data['page_title'] = 'Subscribers';
        $data['events'] = Subscriber::latest()->paginate(30);
        return view('admin.pages.subscriber', $data);
    }

    public function updateSubscriber(Request $request)
    {
        $mac = Subscriber::findOrFail($request->id);
        $mac['status'] = $request->status;
        $res = $mac->save();

        if ($res) {
            return back()->with('success', ' Updated Successfully!');
        } else {
            return back()->with('alert', 'Problem With Updating ');
        }
    }


}
