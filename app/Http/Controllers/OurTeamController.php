<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use Image;

class OurTeamController extends Controller
{

    public function ourTeam()
    {
        $data['page_title'] = "Our Team";
        $data['teams'] = Team::all();
        return view('admin.our-team.index', $data);
    }

    public function createOurTeam()
    {
        $data['page_title'] = " Add New";
        return view('admin.our-team.create', $data);
    }

    public function storeOurTeam(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'image' => 'required|mimes:png,PNG| max:1000',
        ],
            [
                'name.required' => ' name Must not be empty',
                'designation.required' => 'Designation  must not be empty',
            ]
        );
        $in = input::except('_token');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'team_' . time() . '.jpg';
            $location = 'assets/images/our-team/' . $filename;
            Image::make($image)->resize(360, 426)->save($location);
            $in['image'] = $filename;
        }
        Team::create($in);
        $notification = array('message' => 'Saved Successfully.', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function editOurTeam($id)
    {
        $data['page_title'] = " Edit";
        $data['post'] = Team::findOrFail($id);
        return view('admin.our-team.edit', $data);
    }

    public function updateOurTeam(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'image' => 'mimes:png,PNG| max:1000',
        ],
            [
                'name.required' => ' name Must not be empty',
                'designation.required' => 'Designation  must not be empty',
            ]
        );

        $data = Team::findOrFail($id);
        $in = input::except('_token');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'team_' . time() . '.jpg';
            $location = 'assets/images/our-team/' . $filename;
            Image::make($image)->resize(360, 426)->save($location);
            $path = './assets/images/our-team/';
            File::delete($path . $data->image);
            $in['image'] = $filename;
        }

        $data->fill($in)->save();
        $notification = array('message' => 'Updated Successfully.', 'alert-type' => 'success');
        return back()->with($notification);
    }

    public function deleteOurTeam(Request $request)
    {
        $data = Team::find($request->id);
        $path = './assets/images/our-team/';
        File::delete($path . $data->image);
        $data->delete();
        $notification = array('message' => 'Deleted Successfully.', 'alert-type' => 'success');
        return back()->with($notification);
    }

}
