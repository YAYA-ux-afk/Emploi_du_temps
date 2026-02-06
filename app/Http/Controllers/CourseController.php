<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CourseController extends Controller
{
    // Affiche la liste des cours
    public function index(): View
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    // Affiche le formulaire de création
    public function create(): View
    {
        return view('courses.form');
    }

    // Enregistre un nouveau cours
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'room' => 'required|string|max:255',
        ]);

        $course = Course::create($validated);

        return redirect('/courses')->with('success', '✅ Cours créé avec succès')->with('alert_type', 'creation');
    }

    // Affiche le formulaire d'édition
    public function edit(Course $course): View
    {
        return view('courses.form', compact('course'));
    }

    // Met à jour un cours
    public function update(Request $request, Course $course): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'room' => 'required|string|max:255',
        ]);

        $course->update($validated);

        return redirect('/courses')->with('success', '✅ Cours modifié avec succès')->with('alert_type', 'modification');
    }

    // Supprime un cours
    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();
        return redirect('/courses')->with('success', '🗑️ Cours supprimé')->with('alert_type', 'deletion');
    }
}
