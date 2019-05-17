<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

use Intervention\Image\Facades\Image;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function show($id)
    {
        $icons = [
            'flaticon-001-picture',
            'flaticon-002-caliper',
            'flaticon-003-energy-drink',
            'flaticon-004-build',
            'flaticon-005-thinking-1',
            'flaticon-006-prism',
            'flaticon-007-paint',
            'flaticon-008-team',
            'flaticon-009-idea-3',
            'flaticon-010-diamond',
            'flaticon-011-compass',
            'flaticon-012-cube',
            'flaticon-013-puzzle',
            'flaticon-014-magic-wand',
            'flaticon-015-book',
            'flaticon-016-vision',
            'flaticon-017-notebook',
            'flaticon-018-laptop-1',
            'flaticon-019-coffee-cup',
            'flaticon-020-creativity',
            'flaticon-021-thinking',
            'flaticon-022-branding',
            'flaticon-023-flask',
            'flaticon-024-idea-2',
            'flaticon-025-imagination',
            'flaticon-026-search',
            'flaticon-027-monitor',
            'flaticon-028-idea-1',
            'flaticon-029-sketchbook',
            'flaticon-030-computer',
            'flaticon-031-scheme',
            'flaticon-032-explorer',
            'flaticon-033-museum',
            'flaticon-034-cactus',
            'flaticon-035-smartphone',
            'flaticon-036-brainstorming',
            'flaticon-037-idea',
            'flaticon-038-graphic-tool-1',
            'flaticon-039-vector',
            'flaticon-040-rgb',
            'flaticon-041-graphic-tool',
            'flaticon-042-typography',
            'flaticon-043-sketch',
            'flaticon-044-paint-bucket',
            'flaticon-045-video-player',
            'flaticon-046-laptop',
            'flaticon-047-artificial-intelligence',
            'flaticon-048-abstract',
            'flaticon-049-projector',
            'flaticon-050-satellite',
        ];

        $project = Project::find($id);
        return view('admin.projects.show', compact('project', 'icons'));
    }

    public function update($id)
    {
        $project = Project::find($id);

        $attributes = request()->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:5',
            'icon_class' => 'required'
        ]);

        $attributes = $this->UploadImage($attributes);
        
        $project->update($attributes);
        

        return back()->with('success', "{$project->title} successfuly updated");
    }

    public function destroy($id)
    {
        $project = Project::find($id);

        $title = $project->title;

        $project->delete();

        return redirect('/admin/projects')->with('success', "{$title} successfuly deleted");
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'icon_class' => 'required'
        ]);

        $attributes = $this->UploadImage($attributes);

        $project = Project::create($attributes);

        return redirect("/admin/projects/{$project->id}")->with('success', "{$project->title} successfuly created");
    }

    public function create()
    {
        $icons = [
            'flaticon-001-picture',
            'flaticon-002-caliper',
            'flaticon-003-energy-drink',
            'flaticon-004-build',
            'flaticon-005-thinking-1',
            'flaticon-006-prism',
            'flaticon-007-paint',
            'flaticon-008-team',
            'flaticon-009-idea-3',
            'flaticon-010-diamond',
            'flaticon-011-compass',
            'flaticon-012-cube',
            'flaticon-013-puzzle',
            'flaticon-014-magic-wand',
            'flaticon-015-book',
            'flaticon-016-vision',
            'flaticon-017-notebook',
            'flaticon-018-laptop-1',
            'flaticon-019-coffee-cup',
            'flaticon-020-creativity',
            'flaticon-021-thinking',
            'flaticon-022-branding',
            'flaticon-023-flask',
            'flaticon-024-idea-2',
            'flaticon-025-imagination',
            'flaticon-026-search',
            'flaticon-027-monitor',
            'flaticon-028-idea-1',
            'flaticon-029-sketchbook',
            'flaticon-030-computer',
            'flaticon-031-scheme',
            'flaticon-032-explorer',
            'flaticon-033-museum',
            'flaticon-034-cactus',
            'flaticon-035-smartphone',
            'flaticon-036-brainstorming',
            'flaticon-037-idea',
            'flaticon-038-graphic-tool-1',
            'flaticon-039-vector',
            'flaticon-040-rgb',
            'flaticon-041-graphic-tool',
            'flaticon-042-typography',
            'flaticon-043-sketch',
            'flaticon-044-paint-bucket',
            'flaticon-045-video-player',
            'flaticon-046-laptop',
            'flaticon-047-artificial-intelligence',
            'flaticon-048-abstract',
            'flaticon-049-projector',
            'flaticon-050-satellite',
        ];
        return view('admin.projects.create', compact('icons'));
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