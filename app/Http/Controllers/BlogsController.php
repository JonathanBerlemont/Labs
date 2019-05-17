<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Blog;
use App\Category;
use App\Tag;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{
    public function index()
    {
        return view('blog.index', [
            'blogs' => Blog::latest()->paginate(3)
        ]);
    }

    public function adminIndex()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blog.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }

    public function adminShow(Blog $blog)
    {
        return view('admin.blog.show', compact('blog'));
    }

    public function update($id)
    {
        $blog = Blog::find($id);


        $attributes = request()->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:5',
            'categories' => 'min:3|nullable',
            'tags' => 'min:3|nullable'
        ]);

        $attributes = $this->handleCategoriesAndTags($attributes, $request = request(), $blog);

        if(request()->hasFile('image')){
            if ($blog->image_name != 'default*.jpg'){
                Storage::delete("\public\uploads\\{$blog->image_name}");
            }
        }

        $attributes = $this->UploadImage($attributes);

        $blog->update($attributes);

        return back()->with('success', 'Successfuly updated');
    }
    
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'categories' => 'min:3|nullable',
            'tags' => 'min:3|nullable'
        ]);

        $attributes['author_id'] = auth()->id();
        
        $attributes = $this->handleCategoriesAndTags($attributes, $request);

        $attributes = $this->UploadImage($attributes);

        Blog::create($attributes);

        $this->checkCategoriesAndTags();

        return redirect('/admin/blog');
    }

    public function destroy(Blog $blog)
    {
        $this->handleCategoriesAndTags(null, request(), $blog);

        if ($blog->image_name != 'default*.jpg'){
            Storage::delete("\public\uploads\\{$blog->image_name}");
        }

        $blog->delete();

        $this->checkCategoriesAndTags();

        return redirect('/admin/blog')->with('success', 'Blogsuccessfuly deleted');
    }

    public function handleCategoriesAndTags($attributes = null, $request, $blog = null) {
        $attributes['categories'] = explode(', ', $request->categories);
        $attributes['tags'] = explode(', ', $request->tags);

        //Check if Categories and Tags that were given in the request should be created or not
        foreach($attributes['categories'] as $category) {
            if (!Category::where('name', $category)->get()->count()) {
                Category::create(['name' => $category]);
            };
        };

        foreach($attributes['tags'] as $tag) {
            if (!Tag::where('name', $tag)->get()->count()) {
                Tag::create(['name' => $tag]);
            };
        };

        if ($attributes['categories'] == [""]) {
            $attributes['categories'] = [];
        }
        if ($attributes['tags'] == [""]) {
            $attributes['tags'] = [];
        }        
        
        return $attributes;
    }

    public function checkCategoriesAndTags()
    {
        //Check if all Categories and Tags are referenced or should be deleted
        foreach(Category::all() as $cat) {
            if ($cat->blogs()->count() == 0){
                $cat->delete();
            }
        }
        
        foreach(Tag::all() as $tag) {
            if ($tag->blogs()->count() == 0){
                $tag->delete();
            }
        }
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