<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Course::all();

        return Inertia::render('Courses/Index', [
            'cursos' => $cursos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Courses/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $curso = new Course();
        $curso->name = $request->name;
        $curso->stage = $request->stage;
        $curso->description = $request->description;
        $curso->visible = $request->visible;
        $curso->save();
        return redirect()->route('cursos.index');
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
    public function edit(Course $curso)
    {
        return Inertia::render('Courses/Edit', [
            'curso' => $curso,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $curso)
    {
        $curso->name = $request->name;
        $curso->stage = $request->stage;
        $curso->description = $request->description;
        $curso->visible = $request->visible;
        $curso->save();
        return redirect()->route('cursos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $curso)
    {
        $curso->delete();
        return redirect()->route('cursos.index');
    }

    public function json(){
        $cursos = Course::all();
        dd($cursos->toJson());
        return response()->json($cursos);
    }
}
