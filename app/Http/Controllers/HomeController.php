<?php

namespace App\Http\Controllers;

use App\Escrow;
use App\Milestone;
use App\Report;
use App\Trx;
use App\WithdrawLog;
use App\WithdrawMethod;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Session;
use Image;
use App\Gateway;
use App\GeneralSettings;
use App\Deposit;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $data['myEscrowList'] = Escrow::where('creator_id', $user->id)->count();
        $data['myEarnList'] = Escrow::where('user_id', $user->id)->count();

        $data['page_title'] = "Dashboard";
        return view('user.index', $data);
    }


    public function authCheck()
    {
        if (Auth()->user()->status == '1' && Auth()->user()->email_verify == '1' && Auth()->user()->sms_verify == '1') {
            return redirect()->route('home');
        } else {
            $data['page_title'] = "Authorization";
            return view('user.authorization', $data);
        }
    }

    public function sendVcode(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if (Carbon::parse($user->phone_time)->addMinutes(1) > Carbon::now()) {
            $time = Carbon::parse($user->phone_time)->addMinutes(1);
            $delay = $time->diffInSeconds(Carbon::now());
            $delay = gmdate('i:s', $delay);
            session()->flash('alert', 'You can resend Verification Code after ' . $delay . ' minutes');
        } else {
            $code = strtoupper(Str::random(6));
            $user->phone_time = Carbon::now();
            $user->sms_code = $code;
            $user->save();
            send_sms($user->phone, 'Your Verification Code is ' . $code);

            session()->flash('success', 'Verification Code Send successfully');
        }
        return back();
    }

    public function smsVerify(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($user->sms_code == $request->sms_code) {
            $user->phone_verify = 1;
            $user->save();
            session()->flash('success', 'Your Profile has been verfied successfully');
            return redirect()->route('home');
        } else {
            session()->flash('alert', 'Verification Code Did not matched');
        }
        return back();
    }

    public function sendEmailVcode(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if (Carbon::parse($user->email_time)->addMinutes(1) > Carbon::now()) {
            $time = Carbon::parse($user->email_time)->addMinutes(1);
            $delay = $time->diffInSeconds(Carbon::now());
            $delay = gmdate('i:s', $delay);
            session()->flash('alert', 'You can resend Verification Code after ' . $delay . ' minutes');
        } else {
            $code = strtoupper(Str::random(6));
            $user->email_time = Carbon::now();
            $user->verification_code = $code;
            $user->save();
            send_email($user->email, $user->username, 'Verificatin Code', 'Your Verification Code is ' . $code);
            session()->flash('success', 'Verification Code Send successfully');
        }
        return back();
    }

    public function postEmailVerify(Request $request)
    {

        $user = User::find(Auth::user()->id);
        if ($user->verification_code == $request->email_code) {
            $user->email_verify = 1;
            $user->save();
            session()->flash('success', 'Your Profile has been verfied successfully');
            return redirect()->route('home');
        } else {
            session()->flash('alert', 'Verification Code Did not matched');
        }
        return back();
    }


    public function editProfile()
    {
        $data['page_title'] = "Edit Profile";
        $data['user'] = User::findOrFail(Auth::user()->id);
        return view('user.edit-profile', $data);
    }

    public function submitProfile(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|min:10|unique:users,phone,' . $user->id,
//            'username' => 'required|min:5||regex:/^\S*$/u|unique:users,username,' . $user->id,
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        $in = Input::except('_method', '_token');
        $in['reference'] = $request->username;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $request->username . '.jpg';
            $location = 'assets/images/user/' . $filename;
            $in['image'] = $filename;
            if ($user->image != 'user-default.png') {
                $path = './assets/images/user/';
                $link = $path . $user->image;
                if (file_exists($link)) {
                    @unlink($link);
                }
            }
            Image::make($image)->resize(800, 800)->save($location);
        }
        $user->fill($in)->save();
        $notification = array('message' => 'Profile Updated Successfully.', 'alert-type' => 'success');
        return back()->with($notification);

    }

    public function changePassword()
    {
        $data['page_title'] = "Change Password";
        return view('user.change-password', $data);
    }

    public function submitPassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:5|confirmed'
        ]);
        try {

            $c_password = Auth::user()->password;
            $c_id = Auth::user()->id;
            $user = User::findOrFail($c_id);
            if (Hash::check($request->current_password, $c_password)) {

                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();

                $notification = array('message' => 'Password Changes Successfully.', 'alert-type' => 'success');
                return back()->with($notification);
            } else {
                $notification = array('message' => 'Current Password Not Match', 'alert-type' => 'warning');
                return back()->with($notification);
            }

        } catch (\PDOException $e) {
            $notification = array('message' => $e->getMessage(), 'alert-type' => 'warning');
            return back()->with($notification);
        }
    }

    public function deposit()
    {
        $data['page_title'] = "Select Payment Gateways";
        $data['gates'] = Gateway::whereStatus(1)->get();
        return view('user.deposit', $data);
    }

    public function depositDataInsert(Request $request)
    {
        $this->validate($request,
            [
                'amount' => 'required|numeric|min:1',
                'gateway' => 'required',
            ]);

        if ($request->amount <= 0) {
            return back()->with('alert', 'Invalid Amount');
        } else {
            $gate = Gateway::findOrFail($request->gateway);

            if (isset($gate)) {
                if ($gate->minamo <= $request->amount && $gate->maxamo >= $request->amount) {
                    $charge = $gate->fixed_charge + ($request->amount * $gate->percent_charge / 100);
                    $usdamo = ($request->amount + $charge) / $gate->rate;


                    $depo['user_id'] = Auth::id();
                    $depo['gateway_id'] = $gate->id;
                    $depo['amount'] = $request->amount;
                    $depo['charge'] = $charge;
                    $depo['usd'] = round($usdamo, 2);
                    $depo['btc_amo'] = 0;
                    $depo['btc_wallet'] = "";
                    $depo['trx'] = str_random(16);
                    $depo['try'] = 0;
                    $depo['status'] = 0;
                    Deposit::create($depo);

                    Session::put('Track', $depo['trx']);

                    return redirect()->route('user.deposit.preview');

                } else {
                    return back()->with('alert', 'Please Follow Deposit Limit');
                }
            } else {
                return back()->with('alert', 'Please Select Deposit gateway');
            }
        }

    }

    public function depositPreview()
    {
        $track = Session::get('Track');
        $data = Deposit::where('status', 0)->where('trx', $track)->first();
        $page_title = "Deposit Preview";
        return view('user.payment.preview', compact('data', 'page_title'));
    }


    public function activity()
    {
        $user = Auth::user();
        $data['invests'] = Trx::whereUser_id($user->id)->latest()->paginate(15);
        $data['page_title'] = "Transaction Log";
        return view('user.trx', $data);
    }

    public function depositLog()
    {
        $user = Auth::user();
        $data['invests'] = Deposit::whereUser_id($user->id)->whereStatus(1)->latest()->paginate(20);
        $data['page_title'] = "Deposit Log";
        return view('user.deposit-log', $data);
    }

    public function withdrawLog()
    {
        $user = Auth::user();
        $data['invests'] = WithdrawLog::whereUser_id($user->id)->where('status', '!=', 0)->latest()->paginate(15);
        $data['page_title'] = "Withdraw Log";
        return view('user.withdraw-log', $data);
    }

    public function withdrawMoney()
    {
        $data['withdrawMethod'] = WithdrawMethod::whereStatus(1)->get();
        $data['page_title'] = "Withdraw Money";
        return view('user.withdraw-money', $data);
    }

    public function requestPreview(Request $request)
    {
        $this->validate($request, [
            'method_id' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);
        $basic = GeneralSettings::first();
        $bal = User::findOrFail(Auth::user()->id);

        $method = WithdrawMethod::findOrFail($request->method_id);
        $ch = $method->fix + round(($request->amount * $method->percent) / 100, $basic->decimal);
        $reAmo = $request->amount + $ch;
        if ($reAmo < $method->withdraw_min) {
            return back()->with('alert', 'Your Request Amount is Smaller Then Withdraw Minimum Amount.');
        }
        if ($reAmo > $method->withdraw_max) {
            return back()->with('alert', 'Your Request Amount is Larger Then Withdraw Maximum Amount.');
        }
        if ($reAmo > $bal->balance) {
            return back()->with('alert', 'Your Request Amount is Larger Then Your Current Balance.');
        } else {

            $tr = strtoupper(str_random(20));
            $w['amount'] = $request->amount;
            $w['method_id'] = $request->method_id;
            $w['charge'] = $ch;
            $w['transaction_id'] = $tr;
            $w['net_amount'] = $reAmo;
            $w['user_id'] = Auth::user()->id;
            $trr = WithdrawLog::create($w);
            $data['withdraw'] = $trr;
            Session::put('wtrx', $trr->transaction_id);

            $data['method'] = $method;
            $data['balance'] = Auth::user();

            $data['page_title'] = "Preview";
            return view('user.withdraw-preview', $data);
        }
    }


    public function requestSubmit(Request $request)
    {
        $basic = GeneralSettings::first();
        $this->validate($request, [
            'withdraw_id' => 'required|numeric',
            'send_details' => 'required'
        ]);

        $ww = WithdrawLog::findOrFail($request->withdraw_id);
        $ww->send_details = $request->send_details;
        $ww->message = $request->message;
        $ww->status = 1;
        $ww->save();

        $user = Auth::user();
        $user->balance = $user->balance - $ww->net_amount;
        $user->save();

        $trx = Trx::create([
            'user_id' => $user->id,
            'amount' => $ww->amount,
            'main_amo' => round($user->balance, $basic->decimal),
            'charge' => $ww->charge,
            'type' => '-',
            'title' => 'Withdraw Via ' . $ww->method->name,
            'trx' => $ww->transaction_id
        ]);

        $text = $ww->amount . " - " . $basic->currency . " Withdraw Request Send via " . $ww->method->name . ". <br> Transaction ID Is : <b>#$ww->transaction_id</b>";
        notify($user, 'Withdraw Via ' . $ww->method->name, $text);
        return redirect()->route('withdraw.money')->with('success', 'Withdraw request Successfully Submitted. Wait For Confirmation.');
    }


    public function addMilestone()
    {
        $data['page_title'] = "Add a Username";
        return view('user.add-escrow', $data);
    }

    public function storeEscrow(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
        ]);
        $auth = Auth::user();
        $user = User::where('username', $request->username)->where('username', '!=', $auth->username)->where('status', 1)->first();
        if ($user) {

            $escrow = Escrow::where('creator_id', $auth->id)->where('user_id', $user->id)->first();

            if (!$escrow) {
                $storeEscrow['creator_id'] = $auth->id;
                $storeEscrow['user_id'] = $user->id;
                $storeEscrow['escrow_code'] = strtoupper(str_random(14));

                $escrowId = Escrow::create($storeEscrow)->id;

                Session::put('escrowId', $escrowId);
                return redirect()->route('createMilestone');
            } else {
                session()->flash('alert', 'This user already  exist in your list!!');
                return back();
            }

        } else {
            session()->flash('alert', 'Username Did not matched!!');
            return back();
        }
    }

    public function createMilestone()
    {
        $data['page_title'] = "Create Escrow";
        return view('user.create-milestone', $data);
    }

    public function storeMilestone(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'escrow_id' => 'required|numeric',
            'amount' => 'required|numeric|min:0'
        ]);
        $basic = GeneralSettings::first();
        $auth = Auth::user();
        if ($auth->balance >= $request->amount) {

            $data = Escrow::find($request->escrow_id);

            $in = input::except('_token');
            $in['creator_id'] = $data->creator_id;
            $in['user_id'] = $data->user_id;
            $in['code'] = str_random(20);
            $mStone = Milestone::create($in)->id;

            $auth->balance -= $request->amount;
            $auth->save();


            $userMilestone = Milestone::where('id', $mStone)->first();

            $trx = Trx::create([
                'user_id' => $auth->id,
                'amount' => round($request->amount, $basic->decimal),
                'main_amo' => round($auth->balance, $basic->decimal),
                'charge' => 0,
                'type' => '-',
                'title' => ' Escrow created for  ' . $userMilestone->user->username,
                'trx' => str_random(16)
            ]);

            Session::forget('escrowId', $request->escrow_id);
            session()->flash('success', 'Escrow Create Successfully!!');
            return redirect()->route('escrow.list');
        } else {
            session()->flash('alert', 'Insufficient Balance!!');
            return back();
        }
    }

    public function milestoneByUser()
    {
        $auth = Auth::user();
        $escrow = Escrow::where('creator_id', $auth->id)->get();
        if ($escrow) {
            $data['invests'] = Escrow::where('creator_id', $auth->id)->latest()->paginate(10);
            $data['page_title'] = "My Escrow List";
            return view('user.user-milestone-list', $data);
        }
        abort(404);
    }
    public function viewMileStone($code)
    {
        $user = Auth::user();
        $assignJob = Escrow::where('escrow_code', $code)->where('creator_id', $user->id)->first();
        if (isset($assignJob)) {
            $data['project'] = Escrow::where('escrow_code', $code)->where('creator_id', $user->id)->first();
            $data['page_title'] = " Escrow History";
            return view('user.milestone', $data);
        }
        abort(404);
    }

    public function earningList()
    {
        $auth = Auth::user();
        $escrow = Escrow::where('user_id', $auth->id)->get();
        if ($escrow) {
            $data['invests'] = Escrow::where('user_id', $auth->id)->paginate(15);
            $data['page_title'] = "My Earn List";
            return view('user.earn-list', $data);
        }
        abort(404);
    }


    public function viewEarnMileStone($code)
    {
        $user = Auth::user();
        $assignJob2 = Escrow::where('escrow_code', $code)->where('user_id', $user->id)->first();
        if (isset($assignJob2)) {
            $data['project'] = Escrow::where('escrow_code', $code)->where('user_id', $user->id)->first();
            $data['page_title'] = " Escrow History";
            return view('user.earnBymilestone', $data);
        }
        abort(404);
    }


    public function rejectAmount(Request $request)
    {
        $basic =  GeneralSettings::first();

       $data =  Milestone::find($request->id);

        $user = User::find($data->creator_id);
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
            'title' => $data->title .' Rejected  Amount By :  ' . $data->user->username ,
            'trx' => str_random(16)
        ]);

        $txt = 'Added money '. $data->amount. ' '. $basic->currency . "<br>". ' Rejected  Amount   : ' .$data->title .' By '.$data->user->name;
        send_email($user->email, $user->username, 'Added money ', $txt);
        return back()->with('success', 'Payment rejected Successfully');
    }

    public function getMileStone(Request $request)
    {
        $basic = GeneralSettings::first();
        $request->validate([
            'escrow_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'amount' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();

        if ($user->balance >= $request->amount) {
            $data['escrow_id'] = $request->escrow_id;
            $data['amount'] = $request->amount;
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['creator_id'] = $user->id;
            $data['user_id'] = $request->user_id;
            $data['code'] = str_random(20);

            $mStone = Milestone::create($data)->id;

            $user->balance -= $request->amount;
            $user->save();


            $userMilestone = Milestone::where('id', $mStone)->first();

            $trx = Trx::create([
                'user_id' => $user->id,
                'amount' => round($request->amount, $basic->decimal),
                'main_amo' => round($user->balance, $basic->decimal),
                'charge' => 0,
                'type' => '-',
                'title' => ' Escrow Amount created for  ' . $userMilestone->user->username,
                'trx' => str_random(16)
            ]);

            return back()->with('success', 'Escrow Amount create Successfully');
        }
        return back()->with('alert', 'Insufficient Balance !');
    }

    public function releaseAmount(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $basic = GeneralSettings::first();

        $data = Milestone::find($request->id);

        $user = User::find($data->user_id);
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
            'title' => ' Escrow Amount release from  ' . $data->creator->username,
            'trx' => str_random(16)
        ]);

        $txt = 'Added money ' . $data->amount . ' ' . $basic->currency . '  from  ' . $data->creator->username or '';
        send_email($user->email, $user->username, 'Escrow Amount release from ' . $data->creator->username, $txt);
        return back()->with('success', ' Release Successfully');
    }

    public function userReport(Request $request)
    {
        $request->validate([
            'milestone_id' => 'required',
            'report' => 'required',
        ]);

        $milestone = Milestone::find($request->milestone_id);
        $user = Auth::user();
        $data['report_from'] = $user->id;
        if($user->id == $milestone->user_id) {
            $data['report_against'] = $milestone->creator_id;
        }
        elseif($user->id == $milestone->creator_id)
        {
            $data['report_against'] = $milestone->user_id;
        }

        $data['milestone_id'] = $milestone->id;
        $data['amount'] = $milestone->amount;
        $data['report'] = $request->report;
        Report::create($data);
        return back()->with('success', 'Report Send  Successfully');
    }


    public function reportLogAuthor($code)
    {
         $checkCode = Milestone::whereCode($code)->first();
        if ($checkCode) {

            $user1 = $checkCode->creator_id;
            $user2 = $checkCode->user_id;
            $milestone_id = $checkCode->id;

            $data['messages'] = Report::whereIn('report_from', [$user1,0])
                ->whereIn('report_against', [$user2,0])
                ->where('milestone_id',$milestone_id)
                ->orWhere(function ($query) use ($user1, $user2,$milestone_id) {
                    $query->whereIn('report_from', [$user2,0])
                        ->whereIn('report_against', [$user1,0])
                        ->where('milestone_id',$milestone_id);
                })->get();


            $data['page_title'] = "Conversation";
            $data['code'] = $checkCode->code;

            $data['report_against'] = (Auth::id() != $user2) ? $user2 :$user1;
            $data['milestone'] = $checkCode;
            $data['amount'] = $checkCode->amount;
            $data['milestone_id'] = $milestone_id;

            $updateMesasge = Report::where('milestone_id', $checkCode->id)->whereIn('report_against',[Auth::user()->id,0])->where('read_type1', '!=',1)->get();
            foreach ($updateMesasge as $msg) {
                $msg->read_type1 = 1;
                $msg->save();
            }

            return view('user.report-log-author', $data);
        }


        abort(404);
    }

}
