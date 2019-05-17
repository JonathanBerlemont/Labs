<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('role')->get();

        return view('admin.user.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if($user->role == 'admin') {
            if (count(User::where('role', 'admin')->get()) == 1 ) {
                return back()->with('error', 'You cannot delete the last admin');
            };
        }

        $user->delete();

        return back()->with('success', "{$user->name} successfuly deleted");
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'bio' => 'required|min:5',
            'password' => 'required|min:3'
        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        $attributes = $this->UploadImage($attributes);

        User::create($attributes);

        return redirect('/admin/users')->with('success', "{$attributes['name']} successfuly created");
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ((count(User::where('role', 'admin')->get()) == 1) && ($request['role'] == 'writer') && ($user->role == 'admin')) {
            return back()->with('error', 'You cannot delete the last admin');
        }
        
        $attributes = request()->validate([
            'email' => 'required|email',
            'bio' => 'required',
            'role' => 'required|in:admin,writer',
        ]);

        $attributes = $this->UploadImage($attributes);

        $user->update($attributes);

        return back()->with('success', "{$user->name} successfuly updated");
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::find($id);

        if ((count(User::where('role', 'admin')->get()) == 1) && ($request['role'] == 'writer')) {
            return back()->with('error', 'You cannot delete the last admin');
        }

        $role = request()->validate(['role' => 'required|in:admin,writer']);

        $user->update($role);

        return back()->with('success', 'Role updated');
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
