<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Exam;
use Helper;
use Auth;

class ExaminerController extends Controller
{
    public function index()
    {
    	$active = 'dashboard';
    	return view('examiner.index', compact('active'));
    }

    public function getExams()
    {
    	$categories = Category::orderBy('created_at', 'DESC')->get();
    	$active     = 'exams';
    	return view('examiner.exams', compact('active', 'categories'));
    }

    public function addNewCategory(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|unique:categories,name'
    	]);

    	$category = new Category;
    	$category->name = strtoupper(str_slug($request->name, ''));
    	if ($request->category) {
            $Category->image = Helper::uploadImage('category', 'courses/category');
        }
        $category->save();
    }

    public function deleteCategory(Request $id)
    {
    	Category::find($id)->delete();
    }

    public function editCategory(Request $id)
    {
    	return Category::find($id);
    }

    public function updateCategory(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required'
    	]);

    	$category = Category::find($request->id);
    	$category->name = strtoupper(str_slug($request->name, ''));
        if ($request->category) {
            $category->image = Helper::uploadImage('category', 'courses/category');
        }
    	$category->save();
    }

    public function addExam(Request $request)
    {
        $exam = new Exam;
        $exam->question    = Helper::uploadImage('question', 'questions');
        $exam->choices     = json_encode($request->choices);
        $exam->answer      = $request->answer;
        $exam->level       = $request->level;
        $exam->user_id     = Auth::id();
        $exam->category_id = $request->category;
        $exam->save();
    }

    public function editExam($id)
    {
        $active     = 'edit exam';
        $exam       = Exam::find($id);
        $categories = Category::all();
        return view('examiner.edit-exam', compact('active', 'exam', 'categories'));
    }

    public function updateExam(Request $request)
    {
        $exam = Exam::find($request->id);
        if($request->question) {
            $exam->question = Helper::uploadImage('question', 'questions');
        }
        $exam->choices     = json_encode($request->choices);
        $exam->level       = $request->level;
        $exam->answer      = $request->answer;
        $exam->category_id = $request->category;
        $exam->user_id     = Auth::id();
        $exam->save();
    }

    public function deleteExam(Request $id)
    {
        Exam::find($id)->delete();   
    }
}
