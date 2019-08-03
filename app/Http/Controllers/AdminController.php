<?php

namespace App\Http\Controllers;

use App\Gateway;
use App\PlanLog;
use App\Post;
use App\Report;
use App\Subscriber;
use App\User;
use App\WithdrawLog;
use App\WithdrawMethod;
use Illuminate\Http\Request;
use Auth;
use App\GeneralSettings;

class AdminController extends Controller
{

	public function __construct(){
		$Gset = GeneralSettings::first();
		$this->sitename = $Gset->sitename;
	}

	public function dashboard()
    {
        $data['page_title'] = 'DashBoard';

        $data['totalUsers'] = User::count();
        $data['banUsers'] = User::where('status',0)->count();
        $data['gateway'] = Gateway::count();
        $data['withdraw'] = WithdrawMethod::count();
        $data['withdrawReq'] = WithdrawLog::whereStatus(1)->count();
        $data['subscribers'] = Subscriber::count();
        $data['blog'] = Post::count();
        $data['reports'] = Report::where('is_read',0)->where('report_from','!=',0)->count();

        $data['Gset'] = GeneralSettings::first();
        return view('admin.dashboard', $data);
    }

    public function showBreadcrumbs($value='')
    {
        # code...
        $page_title = 'Breadcrumbs';
        return view('webControl.breadcrumb')->with(compact(['page_title']));
    }
	public function logout()    {
		Auth::guard('admin')->logout();
		session()->flash('message', 'Just Logged Out!');
		return redirect('/admin');
	}
















}
