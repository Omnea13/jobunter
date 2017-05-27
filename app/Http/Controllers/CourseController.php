<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $categories = Category::all();
        $active = 'course';
        return view('course.index',compact('courses', 'active','categories'));
    }


    public function addNewCourse(Request $request)
    {
        $course              = new Course;
        $course->name        = $request->name;
        $course->description = $request->description;
        $course->link        = $request->link;
        $course->category_id = $request->category;
        $course->image       = Helper::uploadImage('image', 'courses');
        $course->save();

        if($course->save()) {
            return response()->json(['success' => true]);
        }
    }

    public function editCourse(Request $id)
    {
        $course = Course::find($id);
        return response()->json($course, 200);
    }

    public function updateCourse(Request $request)
    {
       $course              = Course::find($request->id);
       $course->name        = $request->name;
       $course->description = $request->description;
       $course->link        = $request->link;
       $course->category_id = $request->category;

        if ($request->image)
        {
            $course->image = Helper::uploadImage('image','courses');
        }

       $course->save();

        if($course->save()) {
            return response()->json(['success' => true]);
        }

    }

    public function deleteCourse(Request $id)
    {
        Course::find($id)->delete();
    }


}
