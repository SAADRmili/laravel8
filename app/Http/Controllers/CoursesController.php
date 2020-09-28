<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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


    public function store(Request $request)
    {
        # code...
        // dd($request->all());
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'episodes'=>['required','array'],
            'episodes.*.title'=>'required',
            'episodes.*.description'=>'required',
            'episodes.*.video_url'=>'required',
        ]);
      $course = Course::create($request->all());
    foreach($request->input('episodes') as $episode)
    {
        $episode['course_id']= $course->id;
        Episode::create($episode);
    }
        return  Redirect::route('dashboard')->with('success','Felicitation, la formation a bien ete mise en ligne.');
    }

}
