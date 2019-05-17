<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;

use Intervention\Image\Facades\Image;


class TeamsController extends Controller
{
    public function index()
    {
        $team = Team::latest()->get();

        return view('admin.team.index', compact('team'));
    }

    public function show($id)
    {
        $member = Team::find($id);

        return view('admin.team.show', compact('member'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function update(Request $request, $id)
    {
        if ((count(request()->request) == 3) && isset(request()['flag'])){
            Team::where('flag', 1)->update(['flag' => false]);
            Team::find($id)->update(['flag' => true]);
        } else {
            $attributes = request()->validate([
                'name' => 'required',
                'job' => 'required',
                'image_name' => 'image'
            ]);

            $attributes = $this->UploadImage($attributes);

            Team::find($id)->update($attributes);

        }
        return back();
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'job' => 'required',
        ]);
        $attributes['flag'] = false;
        
        $attributes = $this->UploadImage($attributes);

        Team::create($attributes);

        return redirect('/admin/team')->with('success', "{$attributes['name']} added successfuly");
    }

    public function destroy($id)
    {
        $team = Team::find($id);
        $name = $team->name;

        $team->delete();

        if((Team::where('flag', 1)->get()->count()) == 0) {
            Team::all()->first()->update(['flag' => true]);
        }

        return back()->with('success', "{$name} successfuly deleted");
    }

    public function UploadImage($attributes)
    {
        if(request()->hasFile('image')){
            $image = request()->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $path = 'app\public\uploads\\';

            Image::make($image)->save( storage_path($path . $filename ) );

            $attributes['image_name'] = $filename;
          };

          return $attributes;
    }
}
