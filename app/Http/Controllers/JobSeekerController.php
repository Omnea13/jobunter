<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certificate;
use App\Experience;
use App\JobSeeker;
use App\Education;
use App\Category;
use App\UserExam;
use App\Setting;
use App\Course;
use App\Skill;
use App\User;
use App\Exam;
use App\Job;
use Helper;
use Auth;
use DB;

class JobSeekerController extends Controller
{
    public function index()
    {
        $educations   = Education::where('user_id', Auth::id())->get();
        $experiences  = Experience::where('user_id', Auth::id())->get();
        $certificates = Certificate::where('user_id', Auth::id())->get();
        $skills       = Skill::where('user_id', Auth::id())->get();
        $categories   = Category::all();

        /**
            TODO:
            - return Recommended Courses depends on failure status in any exam
         */
        $recommendedCourses = [];
        $ids = DB::table('exam_user')
                ->where('user_id', '=', Auth::id())
                ->where('result', '<', 85)
                ->distinct()
                ->get();
        foreach ($ids as $key => $value) {
            $courses = Course::Where('category_id', '=', $value->category_id)->get();
        }
        return view('jobseeker.index', compact('educations', 'experiences', 'certificates', 'categories', 'skills', 'courses'));
    }

    public function jobseekerInfo(Request $request)
    {
        $check_query = JobSeeker::where('user_id', '=', Auth::id())->first();

        if ($check_query) {
            $jobseekerInfo = $check_query;
        } else {
            $jobseekerInfo = new JobSeeker;
            $jobseekerInfo->user_id = Auth::id();
        }

        if ($request->avatar) {
            $jobseekerInfo->avatar = Helper::uploadImage('avatar', 'jobseekers');
        }

        $jobseekerInfo->phone         = $request->jobseeker_phone;
        $jobseekerInfo->date_of_birth = $request->date_of_birth;
        $jobseekerInfo->gender        = $request->jobseeker_gender;
        $jobseekerInfo->country       = $request->jobseeker_country;
        $jobseekerInfo->city          = $request->jobseeker_city;
        $jobseekerInfo->summary       = $request->summary;
        $jobseekerInfo->save();
    }

    public function addEducation(Request $request)
    {
        $this->validate($request, [
            'school' => 'required|string|max:255',
            'major'  => 'required|string|max:255',
        ]);

        $education              = new Education;
        $education->user_id     = Auth::id();
        $education->school      = $request['school'];
        $education->major       = $request['major'];
        $education->minor       = $request['minor'];
        $education->grade       = $request['grade'];
        $education->description = $request['description'];
        $education->start_date  = $request['start-date'];
        $education->end_date    = $request['end-date'];

        if($education->save()) {
            return response()->json(['success' => true, 'url' => 'jobseeker']);
        }
    }

    public function editEducation(Request $request)
    {
        $education = Education::find($request['id']);
        return response()->json($education, 200);
    }

    public function updateEducation(Request $request)
    {
        $this->validate($request, [
            'school' => 'required|string|max:255',
            'major'  => 'required|string|max:255',
        ]);

        $education              = Education::find($request['id']);
        $education->school      = $request['school'];
        $education->major       = $request['major'];
        $education->minor       = $request['minor'];
        $education->grade       = $request['grade'];
        $education->description = $request['description'];
        $education->start_date  = $request['start-date'];
        $education->end_date    = $request['end-date'];

        if($education->save()) {
            return response()->json(['success' => true, 'url' => 'jobseeker']);
        }
    }

    public function addExperience(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'type'  => 'required',
            // 'date'  => 'required',
        ]);

        $experience               = new Experience;
        $experience->user_id      = Auth::id();
        $experience->title        = $request['title'];
        $experience->type         = $request['type'];
        $experience->company_name = $request['company-name'];
        $experience->start_date   = $request['start-date'];
        $experience->end_date     = $request['end-date'];
        $experience->url          = $request['url'];
        $experience->description  = $request['description'];

        if($experience->save()) {
            return response()->json(['success' => true, 'url' => 'jobseeker']);
        }
    }

    public function editExperience(Request $request)
    {
        $experience = Experience::find($request['id']);
        return response()->json($experience, 200);
    }

    public function updateExperience(Request $request)
    {
        $this->validate($request, [
            'title'       => 'required|string|max:255',
            'type'        => 'required',
            'start-date'  => 'required',
        ]);

        $experience               = Experience::find($request['id']);
        $experience->title        = $request['title'];
        $experience->type         = $request['type'];
        $experience->company_name = $request['company-name'];
        $experience->start_date   = $request['start-date'];
        $experience->end_date     = $request['end-date'];
        $experience->url          = $request['url'];
        $experience->description  = $request['description'];

        if($experience->save()) {
            return response()->json(['success' => true, 'url' => 'jobseeker']);
        }
    }

    public function addCertificate(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|string|max:255',
            'organization'  => 'required|string|max:255',
        ]);

        $certificate               = new Certificate;
        $certificate->user_id      = Auth::id();
        $certificate->name         = $request['name'];
        $certificate->certificate  = Helper::uploadImage('certificate','jobseekers/certificate');
        $certificate->organization = $request['organization'];
        $certificate->start_date   = $request['start-date'];
        $certificate->end_date     = $request['end-date'];
        $certificate->url          = $request['url'];
        $certificate->description  = $request['description'];

        if($certificate->save()) {
            return response()->json(['success' => true, 'url' => 'jobseeker']);
        }
    }

    public function editCertificate(Request $request)
    {
        $certificate = Certificate::find($request['id']);
        return response()->json($certificate, 200);
    }

    public function updateCertificate(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|string|max:255',
            'organization'  => 'required|string|max:255',
        ]);

        $certificate               = Certificate::find($request['id']);
        $certificate->name         = $request['name'];
        
        if ($request->certificate) {
            $certificate->certificate  = Helper::uploadImage('certificate', 'jobseekers/certificate');
        }
        
        $certificate->organization = $request['organization'];
        $certificate->start_date   = $request['start-date'];
        $certificate->url          = $request['url'];
        $certificate->description  = $request['description'];

        if($certificate->save()) {
            return response()->json(['success' => true, 'url' => 'jobseeker']);
        }
    }

    public function takeExam(Request $request)
    {
        $numOfQuestions = Setting::find(1)->num_of_questions;

        $exam              = new UserExam;
        $exam->user_id     = Auth::id();
        $exam->category_id = $request->category;
        if ($exam->save()) {
            // get custom exam questions and send him/her to exam page
            // you have eaxm_category [id]
            $questions['beginner']     = Exam::where('category_id', '=', $request->category)
                                            ->where('level', '=', 'beginner')
                                            ->inRandomOrder()
                                            ->take($numOfQuestions)->get();

            $questions['intermediate'] = Exam::where('category_id', '=', $request->category)
                                            ->where('level', '=', 'intermediate')
                                            ->inRandomOrder()
                                            ->take($numOfQuestions)->get();

            $questions['advanced']     = Exam::where('category_id', '=', $request->category)
                                            ->where('level', '=', 'advanced')
                                            ->inRandomOrder()
                                            ->take($numOfQuestions)->get();

            // return to view with questions
            return view('jobseeker.exam')->with(['questions' => $questions, 'exam' => $exam]);
        }
    }

    public function submitAnswers(Request $request)
    {
        $numOfQuestions = (Setting::find(1)->num_of_questions)*3;
        
        $takenExam          = UserExam::find($request->exam_id);
        $takenExam->answers = json_encode($request->except(['exam_id', '_token']));
        if($takenExam->save()) {
            $userAnswers = json_decode(UserExam::find($takenExam->id)->answers);
            $result = 0;
            foreach ($userAnswers as $key => $userAnswer) {
                $correctAnswer = Exam::find($key)->answer;
                if ($correctAnswer == $userAnswer) {
                    $result += (1/$numOfQuestions)*100;
                }
            }

            /* Update result in table [exam_user] from 0 to $result*/
            $takenExam->result = $result;
            $takenExam->save();

            /**
                [$result]:
                - if >= 85% show success message, add to current user skills
                - else show faild message, sent him/her to recommendation courses in selected field
             */
            $skill              = new Skill;
            $skill->user_id     = Auth::id();
            $skill->category_id = $takenExam->category_id;
            $skill->percentage  = $result;
            if ($result >= 85) {
                $skill->public      = true;
            } else {
                $skill->public      = false;
            }
            $skill->save();
            
            $category = Category::find($skill->category_id)->name;
            
            if ($result >= 85) {
                return view('jobseeker.exams.success', compact('category'));
            } else {
                return view('jobseeker.exams.failed', compact('category'));
            }
        }
    }

    public function getCategory()
    {
        $categories = Category::all();
        return view('jobseeker.courses.index', compact('categories'));
    }

    public function getCourse($name)
    {
        $category = Category::where('name', '=', $name)->first();
        $courses  = Course::Where('category_id', '=', $category->id)->get();
        return view('jobseeker.courses.detail', compact('courses', 'category'));
    }

    public function getAvailableJobs()
    {
        /**
         * get [jobseeker] success skills, then show him jobs 
         * which match this skills
         */
        $ids = Skill::Where('user_id', '=', Auth::id())->where('percentage', '>=', 85)->distinct()->get(['category_id']);

        $jobs   = Job::all();
        $availableJobs = [];
        foreach ($jobs as $job) {
            $skills = explode(",", $job->skills);
            foreach ($skills as $skill) {
                foreach ($ids as $id) {
                    $category = Category::find($id)->name;
                    if ($category == $skill) {
                        $availableJobs[] = $job;
                    }
                }
            }
        }

        return view('jobseeker.jobs.index', compact('availableJobs'));
    }

    public function getJobDetails($id)
    {
        $job = Job::find($id);
        $skills = explode(",", $job->skills);
        return view('jobseeker.jobs.jobdetails', compact('job', 'skills'));
    }

    public function getCompany($id)
    {
        $user = User::find($id);
        $jobs  = $user->jobs;
        return view('jobseeker.companies.index', compact('user', 'jobs'));
    }

    public function getSearchJobs(Request $request)
    {
        $name = $request->name;
        $jobs = Job::where("name", 'LIKE', '%' . $name . '%')->paginate(10);

        if (count($jobs) > 0) {
            return response()->json($jobs, 200);
        } else {
            return response()->json("No jobs found", 401);
        }
    }
}