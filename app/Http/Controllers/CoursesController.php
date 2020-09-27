<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CoursesController extends Controller
{
    //
    public function index()
    {
        $courses =Course::with('user')->select('courses.*',DB::raw(
            '(select count(distinct(user_id))from completions inner join episodes on completions.episode_id = episodes.id where episodes.course_id = courses.id)as participants'
        ))->withCount('episodes')->latest()->get();
       // dd($courses);
        return Inertia::render('Courses/Index',[
            'courses' => $courses
        ]);
    }

    public function show(int $id)
    {
        $course = Course::where('id',$id)->with('episodes')->first();
        $watched = auth()->user()->episodes;
        return Inertia::render('Courses/Show',[
            'course' => $course,
            'watched'=>$watched
        ]);
    }
    public function toggleProgress(Request $request)
    {
        # code...
         $id =  $request->input('episodeid');
         $user = auth()->user();

         $user->episodes()->toggle($id);

         return $user->episodes;


    }

}
