<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AssignSubjectToClassController;
use App\Http\Controllers\AssignTeacherToClassController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\FeeHeadController;
use App\Http\Controllers\FeeStructureController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\thirdPartyApi;
use App\Http\Controllers\userController;
use App\Models\Announcement;
use App\Models\Classes;
use App\Models\FeeHead;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;
use Monolog\Handler\RotatingFileHandler;
use PhpParser\Node\Expr\Assign;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Student 
Route::group(['prefix' => 'student'], function () {

    Route::group(['middleware' => 'student.guest'], function () {
        Route::get('/login', [userController::class, 'index'])->name('student.login');
        Route::post('/login', [userController::class, 'authenticate'])->name('student.authenticate');
    });

    Route::group(['middleware' => 'student.auth'], function () {
        Route::get('/dashboard', [userController::class, 'dashboard'])->name('student.dashboard');
        Route::get('/logout', [userController::class, 'logout'])->name('student.logout');
        Route::get('/change-password', [userController::class, 'changePassword'])->name('student.changePassword');
        Route::put('/update-password', [userController::class, 'updatePassword'])->name('student.updatePassword');
    });
});


// Teacher 
Route::group(['prefix' => 'teacher'], function () {
    Route::group(['middleware' => 'teacher.guest'], function () {
        Route::get('/login', [TeacherController::class, 'teacherLogin'])->name('teacher.login');
        Route::post('/login', [TeacherController::class, 'teacherAuthenticate'])->name('teacher.authenticate');
    });

    Route::group(['middleware' => 'teacher.auth'], function () {
        Route::get('/dashboard', [TeacherController::class, 'teacherDashboard'])->name('teacher.dashboard');
        Route::get('/logout', [TeacherController::class, 'teacherLogout'])->name('teacher.logout');
        Route::get('/change-password', [TeacherController::class, 'changePassword'])->name('teacher.changePassword');
        Route::put('/update-password', [TeacherController::class, 'updatePassword'])->name('teacher.updatePassword');
    });
});


Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminController::class, 'index'])->name('admin.login');
        Route::post('/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
        Route::get('/register', [AdminController::class, 'register'])->name('admin.register');
        // google authentication 
        Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('redirect.google');
        Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallBack'])->name('redirect.callback');
        // facebook authentication 
        Route::get('/auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('redirect.facebook');
        Route::get('/auth/facebook/callback', [FacebookController::class, 'handleFacebookCallBack']);
    });
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('form', [AdminController::class, 'form'])->name('admin.form');
        Route::get('table', [AdminController::class, 'table'])->name('admin.table');

        // Academic year routes 
        Route::get('/academic-year/create', [AcademicYearController::class, 'index'])->name('academic-year.create');
        Route::post('/academic-year/store', [AcademicYearController::class, 'store'])->name('academic-year.store');
        Route::get('/academic-year/read', [AcademicYearController::class, 'read'])->name('academic-year.read');
        Route::get('/academic-year/delete{id}', [AcademicYearController::class, 'delete'])->name('academic-year.delete');
        Route::get('/academic-year/edit/{id}', [AcademicYearController::class, 'edit'])->name('academic-year.edit');
        Route::put('/academic-year/update/{id}', [AcademicYearController::class, 'update'])->name('academic-year.update');

        // Classes Management routes 
        Route::get('/class/create', [ClassesController::class, 'index'])->name('class.create');
        Route::post('/class/store', [ClassesController::class, 'store'])->name('class.store');
        Route::get('/class/read', [ClassesController::class, 'read'])->name('class.read');
        Route::get('/class/edit/{id}', [ClassesController::class, 'edit'])->name('class.edit');
        Route::put('/class/update/{id}', [ClassesController::class, 'update'])->name('class.update');
        Route::get('/class/delete/{id}', [ClassesController::class, 'delete'])->name('class.delete');

        // Fee Head Management routes 
        Route::get('/fee-head/create', [FeeHeadController::class, 'index'])->name('fee-head.create');
        Route::post('/fee-head/store', [FeeHeadController::class, 'store'])->name('fee-head.store');
        Route::get('/fee-head/read', [FeeHeadController::class, 'read'])->name('fee-head.read');
        Route::get('/fee-head/edit/{id}', [FeeHeadController::class, 'edit'])->name('fee-head.edit');
        Route::put('/fee-head/update/{id}', [FeeHeadController::class, 'update'])->name('fee-head.update');
        Route::get('/fee-head/delete/{id}', [FeeHeadController::class, 'delete'])->name('fee-head.delete');

        // Fee Structure routes 
        Route::get('/fee-structure/create', [FeeStructureController::class, 'index'])->name('fee-structure.create');
        Route::post('/fee-structure/store', [FeeStructureController::class, 'store'])->name('fee-structure.store');
        Route::get('/fee-structure/read', [FeeStructureController::class, 'read'])->name('fee-structure.read');
        Route::get('/fee-structure/delete/{id}', [FeeStructureController::class, 'delete'])->name('fee-structure.delete');
        Route::get('/fee-structure/edit/{id}', [FeeStructureController::class, 'edit'])->name('fee-structure.edit');
        Route::put('/fee-structure/update/{id}', [FeeStructureController::class, 'update'])->name('fee-structure.update');

        // Student Management routes
        Route::get('/student/create', [StudentController::class, 'index'])->name('student.create');
        Route::post('/student/store', [StudentController::class, 'store'])->name('student.store');
        Route::get('/student/read', [StudentController::class, 'read'])->name('student.read');
        Route::get('/student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
        Route::put('/student/update/{id}', [StudentController::class, 'update'])->name('student.update');
        Route::get('/student/delete/{id}', [StudentController::class, 'delete'])->name('student.delete');

        // Subject Management routes
        Route::get('/subject/create', [SubjectController::class, 'index'])->name('subject.create');
        Route::post('/subject/store', [SubjectController::class, 'store'])->name('subject.store');
        Route::get('/subject/read', [SubjectController::class, 'read'])->name('subject.read');
        Route::get('/subject/edit/{id}', [SubjectController::class, 'edit'])->name('subject.edit');
        Route::put('/subject/update/{id}', [SubjectController::class, 'update'])->name('subject.update');
        Route::get('/subject/delete/{id}', [SubjectController::class, 'delete'])->name('subject.delete');

        // AssignSubjects to Class 
        Route::get('/assign-subject/create', [AssignSubjectToClassController::class, 'index'])->name('assign-subject.create');
        Route::post('/assign-subject/store', [AssignSubjectToClassController::class, 'store'])->name('assign-subject.store');
        Route::get('/assign-subject/read', [AssignSubjectToClassController::class, 'read'])->name('assign-subject.read');
        Route::get('/assign-subject/edit/{id}', [AssignSubjectToClassController::class, 'edit'])->name('assign-subject.edit');
        Route::put('/assign-subject/update/{id}', [AssignSubjectToClassController::class, 'update'])->name('assign-subject.update');
        Route::get('/assign-subject/delete/{id}', [AssignSubjectToClassController::class, 'delete'])->name('assign-subject.delete');

        // Assign Subject and Class to Teacher
        Route::get('/assign-teacher/create', [AssignTeacherToClassController::class, 'index'])->name('assign-teacher.create');
        Route::post('/assign-teacher/store', [AssignTeacherToClassController::class, 'store'])->name('assign-teacher.store');
        Route::get('/assign-teacher/read', [AssignTeacherToClassController::class, 'read'])->name('assign-teacher.read');
        Route::get('/assign-teacher/edit/{id}', [AssignTeacherToClassController::class, 'edit'])->name('assign-teacher.edit');
        Route::put('/assign-teacher/update/{id}', [AssignTeacherToClassController::class, 'update'])->name('assign-teacher.update');
        Route::get('/assign-teacher/delete/{id}', [AssignTeacherToClassController::class, 'delete'])->name('assign-teacher.delete');
        Route::get('findSubject', [AssignTeacherToClassController::class, 'findSubject'])->name('findSubject');
        // 
        // Teacher Management routes
        Route::get('/teacher/create', [TeacherController::class, 'index'])->name('teacher.create');
        Route::post('/teacher/store', [TeacherController::class, 'store'])->name('teacher.store');
        Route::get('/teacher/read', [TeacherController::class, 'read'])->name('teacher.read');
        Route::get('/teacher/edit/{id}', [TeacherController::class, 'edit'])->name('teacher.edit');
        Route::put('/teacher/update/{id}', [TeacherController::class, 'update'])->name('teacher.update');
        Route::get('/teacher/delete/{id}', [TeacherController::class, 'delete'])->name('teacher.delete');

        // Announcement
        Route::get('/announcement/create', [AnnouncementController::class, 'index'])->name('announcement.create');
        Route::post('/announcement/store', [AnnouncementController::class, 'store'])->name('announcement.store');
        Route::get('/announcement/read', [AnnouncementController::class, 'read'])->name('announcement.read');
        Route::get('/announcement/edit/{id}', [AnnouncementController::class, 'edit'])->name('announcement.edit');
        Route::put('/announcement/update/{id}', [AnnouncementController::class, 'update'])->name('announcement.update');
        Route::get('/announcement/delete/{id}', [AnnouncementController::class, 'delete'])->name('announcement.delete');


        // Third party api 
        Route::get('third-party-api', [thirdPartyApi::class, 'getApiData'])->name('third.api');
    });
});
