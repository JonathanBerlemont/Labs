<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Project;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Service::paginate(9);

        $projects = Project::take(6)->get()->chunk(3);

        $first_projects = $projects[0];
        $second_projects = $projects[1];

        $projects_show = Project::take(3)->get();

        return view('services.index', compact('services', 'first_projects', 'second_projects', 'projects_show'));
    }
    public function adminIndex()
    {
        $services = Service::latest()->get();

        return view('admin.services.index', compact('services'));
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

        $service = Service::find($id);
        return view('admin.services.show', compact('service', 'icons'));
    }

    public function update($id)
    {
        $service = Service::find($id);

        $attributes = request()->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:5',
            'icon_class' => 'required'
        ]);

        $service->update($attributes);

        return back()->with('success', 'Successfuly updated');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:5',
            'icon_class' => 'required'
        ]);

        $service = Service::create($attributes);

        return redirect("/admin/services/{$service->id}")->with('success', "{$service->title} successfuly created");
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

        return view('admin.services.create', compact('icons'));
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        $title = $service->title;
        $service->delete();

        return redirect('/admin/services')->with('success', "{$title} successfuly deleted");
    }
}
