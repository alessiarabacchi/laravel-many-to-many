<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'type_id' => 'nullable|exists:types,id'
    ]);

    $project = new \App\Models\Project($request->all());
    $project->save();

    return redirect()->route('projects.index');
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'type_id' => 'nullable|exists:types,id'
    ]);

    $project = \App\Models\Project::findOrFail($id);
    $project->update($request->all());

    return redirect()->route('projects.index');
}

public function create()
{
    $technologies = Technology::all();
    return view('projects.create', compact('technologies'));
}

public function edit(Project $project)
{
    $technologies = Technology::all();
    $selectedTechnologies = $project->technologies()->pluck('technology_id')->toArray();
    return view('projects.edit', compact('project', 'technologies', 'selectedTechnologies'));
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'technologies' => 'array',
        'technologies.*' => 'exists:technologies,id',
    ]);

    $project = Project::create($validatedData);
    $project->technologies()->attach($request->technologies);

    return redirect()->route('projects.index');
}

public function update(Request $request, Project $project)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'technologies' => 'array',
        'technologies.*' => 'exists:technologies,id',
    ]);

    $project->update($validatedData);
    $project->technologies()->sync($request->technologies);

    return redirect()->route('projects.index');
}


class ImageController extends Controller
{
    public function upload(Request $request)
    {
       
        if ($request->hasFile('image')) {
            
            $path = $request->file('image')->store('public/projects');
            $fileName = basename($path);
            
        }

    }

    public function moveImage()
    {
        
        $sourcePath = 'contours-blue-butterfly-smoke-black-background-fantastic-magic-background-unusual-nice_700453-1702-_.png'; 
        $destinationPath = 'public/projects/contours-blue-butterfly-smoke-black-background-fantastic-magic-background-unusual-nice_700453-1702-_.png'; 

        Storage::move($sourcePath, $destinationPath);
       
    }


}