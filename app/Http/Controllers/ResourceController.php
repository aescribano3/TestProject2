<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Resource;
use App\Models\Course;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recursos = Resource::all();

        return Inertia::render('Resources/Index', [
            'recursos' => $recursos
        ]);
    }
    
    public function indexId(Course $curso)
    {
        dd($curso);
        //$recursos = Course::resources()->get();
        $recursos = Resource::where('courseId', $curso->id)->get();
    
        return Inertia::render('Resources/Index', [
            'recursos' => $recursos,
            'curso' => $curso
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cursos = Course::all();
        return Inertia::render('Resources/Create', [
            'cursos' => $cursos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $recurso = new Resource();
        $recurso->title = $request->title;
        $recurso->content = $request->content;
        $recurso->courseId = $request->courseId;
        $recurso->visible = $request->visible;
        $recurso->save();
        return redirect()->route('recursos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $recurso)
    {
        $cursos = Course::all();
        return Inertia::render('Resources/Edit', [
            'recurso' => $recurso,
            'cursos' => $cursos
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $recurso)
    {
        $recurso->title = $request->title;
        $recurso->content = $request->content;
        $recurso->courseId = $request->courseId;
        $recurso->visible = $request->visible;
        $recurso->save();
        return redirect()->route('recursos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $recurso)
    {
        $recurso->delete();
        return redirect()->route('recursos.index');
    }
}
