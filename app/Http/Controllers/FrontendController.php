<?php

namespace App\Http\Controllers;

use App\Category;
use App\GeneralSettings;
use App\Post;
use App\Slider;
use App\Subscriber;
use App\Team;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\Menu;
use App\Faq;
use App\Advertisment;

class FrontendController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        $data['page_title'] = "Home";

        $data['totalUsers'] = User::count();
        $data['totalblogs'] = Post::count();
        $data['totalSubscriber'] = Subscriber::count();

        $data['sliders'] = Slider::all();
        $data['posts'] = Post::latest()->whereStatus(1)->take(3)->get();
        return view('front.index', $data);
    }

    public function menu($slug)
    {
        $menu = $data['menu'] = Menu::whereSlug($slug)->first();
        $data['page_title'] = "$menu->name";
        return view('layouts.menu', $data);
    }

    public function about()
    {
        $data['page_title'] = "About Us";
        $data['ourTeams'] = Team::all();
        return view('layouts.about', $data);
    }

    public function faqs()
    {
        $data['faqs'] = Faq::all();
        $data['page_title'] = "Faqs";
        return view('layouts.faqs', $data);
    }


    public function contactUs()
    {
        $data['page_title'] = "Contact Us";
        return view('layouts.contact', $data);
    }

    public function contactSubmit(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'subject' => 'required',
            'phone' => 'required',
        ]);
        $subject = $request->subject;
        $phone =  "<br><br>" ."Contact Number : ". $request->phone . "<br><br>";

        $txt = $request->message.$phone;

        send_contact($request->email, $request->name, $subject, $txt);
        $notification = array('message' => 'Contact Message Send.', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function clickadd($id)
    {

        $add = Advertisment::findOrFail($id);
        $data = array();
        $data['views'] = $add->views + 1;
        Advertisment::whereId($id)->update($data);
        $go = $add->link;
        return redirect($go);
    }

    public function blog()
    {
        $data['page_title'] = "Blog Feed";
        $data['posts'] = Post::latest()->paginate(12);
        return view('front.blog', $data);
    }

    public function details($id)
    {
        $post = $data['post'] = Post::find($id);
        $post->hit += 1;
        $post->save();
        $data['page_title'] = $data['post']->title;
        $data['latest'] = Post::latest()->whereStatus(1)->take(3)->get();
        $data['categories'] = Category::whereStatus(1)->get();
        return view('front.details', $data);
    }

    public function categoryByBlog($id)
    {
        $cat = Category::find($id);
        $data['page_title'] = "$cat->name";
        $data['posts'] = Post::where('cat_id', $id)->latest()->paginate(12);
        return view('front.category-blog', $data);
    }


    public function subscribe(Request $request)
    {

		 $request->validate([
            'email' => 'required|email|max:255',
        ]);
        $macCount = Subscriber::where('email', $request->email)->count();
        if ($macCount > 0) {
            return back()->with('alert', 'This Email Already Exist !!');
        }else{
            Subscriber::create($request->all());
            return back()->with('success', ' Subscribe Successfully!');
        }
    }


}
