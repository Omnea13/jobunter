<?php

Route::get('/', 'HomeController@index');
Route::get('login', 'HomeController@getLogin')->name('login');
Route::post('login', 'HomeController@login');
Route::post('register', 'HomeController@register');

Route::group(['middleware' => 'auth'], function(){

	Route::put('social_media', 'CompanyController@socialMedia');
	
	/*=======================================
	=            Admin Dashboard            =
	=======================================*/
	Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function(){
		Route::get('/', 'AdminController@dashboard');
		/* Admins */
		Route::get('admins', 'AdminController@getAllAdmins');
		/* JobSeekers */
		Route::get('jobseekers', 'AdminController@getAllJobSeeker');
		/* Companies */
		Route::get('companies', 'AdminController@getcompany');
		/* Examiners */
		Route::get('examiners', 'AdminController@getExaminers');

		Route::post('addNewUser', 'AdminController@addNewUser');
		Route::get('editUser', 'AdminController@editUser');
		Route::put('updateUser', 'AdminController@updateUser');
		Route::delete('deleteUser', 'AdminController@deleteUser');

        Route::get('courses', 'CourseController@index');
        Route::post('addNewCourse','CourseController@addNewCourse');
        Route::get('editCourse', 'CourseController@editCourse');
        Route::put('updateCourse','CourseController@updateCourse');
        Route::delete('deleteCourse','CourseController@deleteCourse');

        Route::get('categories', 'CategoryController@index');
        Route::post('addNewCategory','CategoryController@addNewCategory');
        Route::get('editCategory', 'CategoryController@editCategory');
        Route::put('updateCategory','CategoryController@updateCategory');
        Route::delete('deleteCategory','CategoryController@deleteCategory');

        Route::get('settings', 'AdminController@getSettings');
        Route::post('settings/paypal', 'AdminController@postSettingsPaypal');
        Route::post('settings/questions', 'AdminController@postSettingsQuestions');
	});
	/*=====  End of Admin Dashboard  ======*/

	/*==========================================
	=            Examiner Dashboard            =
	==========================================*/
	Route::group(['prefix' => 'examiner', 'middleware' => ['examiner']], function() {
	    Route::get('/', 'ExaminerController@index');

	    Route::get('exams', 'ExaminerController@getExams');
	    Route::post('addNewCategory', 'ExaminerController@addNewCategory');
	    Route::get('editCategory', 'ExaminerController@editCategory');
	    Route::put('updateCategory', 'ExaminerController@updateCategory');
	    Route::delete('deleteCategory', 'ExaminerController@deleteCategory');

		Route::post('addExam', 'ExaminerController@addExam');
		Route::get('edit-exam/{id}', 'ExaminerController@editExam');
		Route::put('edit-exam', 'ExaminerController@updateExam');
		Route::delete('deleteExam', 'ExaminerController@deleteExam');
	});
	/*=====  End of Examiner Dashboard  ======*/
	

	/*=========================================
	=            JobSeeker Profile            =
	=========================================*/
	Route::group(['prefix' => 'jobseeker', 'middleware'=> ['jobseeker']], function(){
		Route::get('/', 'JobSeekerController@index');
		Route::put('jobseeker_info', 'JobSeekerController@jobseekerInfo');
		Route::post('add-education', 'JobSeekerController@addEducation');
		Route::get('edit-education', 'JobSeekerController@editEducation');
		Route::post('edit-education', 'JobSeekerController@updateEducation');
		Route::post('add-experience', 'JobSeekerController@addExperience');
		Route::get('edit-experience', 'JobSeekerController@editExperience');
		Route::post('edit-experience', 'JobSeekerController@updateExperience');
		Route::post('add-certificate', 'JobSeekerController@addCertificate');
		Route::get('edit-certificate', 'JobSeekerController@editCertificate');
		Route::post('edit-certificate', 'JobSeekerController@updateCertificate');

		Route::post('take-exam', 'JobSeekerController@takeExam');
		Route::post('submit-answers', 'JobSeekerController@submitAnswers');

		Route::get('courses', 'JobSeekerController@getCategory')->name('course.courseDetails');
		Route::get('courses/{name}', 'JobSeekerController@getCourse');

		Route::get('jobs', 'JobSeekerController@getAvailableJobs');
		Route::get('jobs/search', 'JobSeekerController@getSearchJobs');
		Route::get('jobs/details/{id}', 'JobSeekerController@getJobDetails');
		Route::get('company/{id}', 'JobSeekerController@getCompany');

		/**
		 * TEST NOTIFICATION
		*/
		Route::get('interest/{id}', function($job_id){
			$user = \Auth::user();
			$company_id = App\Job::find($job_id)->user_id;
			$user->notify(new App\Notifications\Interest($user->id,$company_id, $job_id, 'interest'));
			return back();
		});

		Route::get('jobs/interests', function(){
			return Auth::user()->notifications;
		});

		Route::get('notifications', function(){
			$user = \Auth::user();
			foreach ($user->notifications as $notification) {
				var_dump($notification->data['from_id']);
			}
		});
	});
	/*=====  End of JobSeeker Profile  ======*/
	

	/*=======================================
	=            Company Profile            =
	=======================================*/
	Route::group(['prefix' => 'company', 'middleware' => ['company','renewpay']], function(){
		Route::get('/', 'CompanyController@index');
		Route::put('company_info', 'CompanyController@companyInfo');
		Route::put('company_about', 'CompanyController@companyAbout');
		Route::post('company_location', 'CompanyController@companyLocation');
		// Route::post('companyLogo', 'CompanyController@companyLogo');
		Route::patch('company-cover', 'CompanyController@companyCover');

		Route::get('checkout/upgrade', 'CompanyController@upgrade');
		Route::get('checkout/check', 'CompanyController@paypalCheck');
		Route::get('checkout/success', 'CompanyController@paypalDone');
		Route::get('checkout/cancel', 'CompanyController@paypalCancel');
		
		Route::get('jobseekers', 'CompanyController@getJobSeekers');
		Route::get('jobseekers/{id}', 'CompanyController@getJobSeekerProfile');

		Route::get('payments', 'CompanyController@getPaymentList');

		Route::get('jobs/new', 'JobController@getNewJob');
		Route::post('jobs/new', 'JobController@postNewJob');
		Route::put('editjob', 'JobController@postEditJob');
		Route::delete('deleteJob', 'JobController@deleteJob');

		Route::get('jobs/{id}', 'JobController@jobDetails');
		Route::get('jobs/{id}/edit', 'JobController@getEditJob');

		Route::get('notifications', function(){
			$notifications = App\Notification::all();
			foreach ($notifications as $notification) {

			}
		});
	});
	/*=====  End of Company Profile  ======*/
	
	Route::get('logout', 'HomeController@logout')->name('logout');
});

Route::get('renew', 'CompanyController@getPaypalRenew');
Route::get('checkout/renew', 'CompanyController@getPaypalPay');
Route::get('checkout/check', 'CompanyController@getPaypalRenewCheck');