<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\View\View;

class PublicCourseController extends Controller
{
    // Affiche la liste des cours pour le public
    public function index(): View
    {
        $courses = Course::all();
        return view('public.courses', compact('courses'));
    }
}
