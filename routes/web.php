<?php

use App\Http\Controllers\BallotController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\DiscoverController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Mail\NacMail;
use Illuminate\Routing\ViewController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//                                          MAIN SITE WORK

//                                  user login and registration  
Route::get('/login', [LoginController::class, 'loginView'])->name('loginView');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/user/register', [LoginController::class, 'UserRegisterView'])->name('UserRegisterView');
Route::post('/user/register', [LoginController::class, 'UserRegister'])->name('UserRegister');
Route::get('/user/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/user/global-search', [LoginController::class, 'globalSearch'])->name('globalSearch')->middleware('CheckUser');
// business registration
Route::get('/register', [BusinessController::class, 'registerBusinessForm'])->name('registerBusinessForm');
Route::post('/register', [BusinessController::class, 'registerBusiness'])->name('registerBusiness');


//                                     landing page
Route::get('/', [LoginController::class, 'landingPage'])->name('landingPage');


//                                  user dashboard (home page)
Route::get('/home', [LoginController::class, 'home'])->name('home')->middleware('CheckUser');
Route::get('/creator/registration', [LoginController::class, 'registerCreatorForm'])->name('userCreatorForm')->middleware('CheckUser');
Route::post('/creator/registration', [LoginController::class, 'registerCreator'])->name('userCreator')->middleware('CheckUser');
Route::get('/business/register', [LoginController::class, 'businessRegisterForm'])->name('businessRegisterForm')->middleware('CheckUser');
Route::post('/business/register', [LoginController::class, 'businessRegister'])->name('businessRegister')->middleware('CheckUser');
Route::get('/businesses/list', [LoginController::class, 'BusinessList'])->name('BusinessList')->middleware('CheckUser');

//                                  live
Route::get('/live', [LoginController::class, 'nacLive'])->name('nacLive');
// if couldnot encrypt id using jquerry redict to this with id=
Route::get('/redicrectToWatch', [LoginController::class, 'redicrectToWatch'])->name('redicrectToWatch')->middleware('CheckUser');
//                                  DISCOVER
Route::get('/universe', [DiscoverController::class, 'view'])->name('view');
Route::get('/searchpropery', [DiscoverController::class, 'searchpropery'])->name('searchpropery');
Route::get('/searchtvshow', [DiscoverController::class, 'searchtvshow'])->name('searchtvshow');
Route::post('/universe', [DiscoverController::class, 'emailData'])->name('emailData');
Route::post('/universes', [DiscoverController::class, 'homeLoanData'])->name('homeOwner');
Route::get('/business/view-all', [DiscoverController::class, 'getAllBusiness'])->name('getAllBusiness');
Route::get('properties/view-all', [DiscoverController::class, 'allProperties'])->name('allProperties');
//get all busienss coordinates in discover page

Route::get('/getBusinessCoords', [BusinessController::class, 'getBusiness'])->name('getBusiness')->middleware('CheckUser');



//                                  CREATE VIDEOS
Route::get('/upload/video', [VideoController::class, 'uploadForm'])->name('uploadForm')->middleware('CheckUser');
Route::post('/upload/video', [VideoController::class, 'upload'])->name('upload')->middleware('CheckUser');
Route::get('/user/video/edit', [VideoController::class, 'editForm'])->name('editForm')->middleware('CheckUser');
Route::post('/user/video/edit', [VideoController::class, 'edit'])->name('edit')->middleware('CheckUser');
Route::get('/video/list', [VideoController::class, 'VideoList'])->name('VideoList')->middleware('CheckUser');

// user hsitory 
Route::get('/user/history/add', [VideoController::class, 'historyAdd'])->name('historyAdd')->middleware('CheckUser');

                            // manage activited likes/votes
Route::get('/manageLikes', [VideoController::class, 'manageLikes'])->name('manageLikes')->middleware('CheckUser');
Route::get('/manageVotes', [VideoController::class, 'manageVotes'])->name('manageVotes')->middleware('CheckUser');
Route::get('/manageVotes', [VideoController::class, 'manageVotes'])->name('manageVotes')->middleware('CheckUser');
Route::post('/remove/vote', [VideoController::class, 'removeVote'])->name('removeVote')->middleware('CheckUser');
Route::post('/setForrevote', [VideoController::class, 'setForrevote'])->name('setForrevote')->middleware('CheckUser');

//                              USER PROFILE WORK
Route::get('/user/profile', [ProfileController::class, 'viewProfile'])->name('viewProfile')->middleware('CheckUser');
Route::post('/user/update', [ProfileController::class, 'update'])->name('update')->middleware('CheckUser');

//top 100 videos lists
Route::get('/video/top-100', [VideoController::class, 'top100'])->name('top100')->middleware('CheckUser');

//users liked videos  lists
Route::get('/user/video/liked', [VideoController::class, 'likedVideos'])->name('likedVideos')->middleware('CheckUser');

//BALLOT
Route::get('/ballot', [BallotController::class, 'view'])->name('view')->middleware('CheckUser');
Route::post('/ballot/questions', [BallotController::class, 'submitQuestions'])->name('submitQuestions')->middleware('CheckUser');
Route::post('/ballot/questions/resubmit', [BallotController::class, 'resubmitQuestions'])->name('resubmitQuestions')->middleware('CheckUser');

//                              ADMIN PANNEL
// ADMIN VALIDAION
Route::get('/admin/login', [LoginController::class, 'adminLoginForm'])->name('adminLoginForm');
Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('adminLogin');
Route::get('admin/logout', [LoginController::class, 'adminLogout'])->name('adminLogout');

Route::get('/admin/dashboard', [LoginController::class, 'dashbaord'])->name('dashbaord')->middleware('AdminUser');
// users
Route::get('admin/users/', [UserController::class, 'list'])->name('list')->middleware('AdminUser');
Route::post('/admin/user/delete', [UserController::class, 'delete'])->name('delete')->middleware('AdminUser');
Route::get('admin/users/view/', [UserController::class, 'view'])->name('view')->middleware('AdminUser');
Route::post('admin/users/add', [UserController::class, 'add'])->name('add')->middleware('AdminUser');
Route::post('admin/users/update', [UserController::class, 'update'])->name('update')->middleware('AdminUser');
// business
Route::get('admin/business/', [BusinessController::class, 'list'])->name('list')->middleware('AdminUser');
Route::post('/admin/business/delete', [BusinessController::class, 'delete'])->name('delete')->middleware('AdminUser');
Route::get('admin/business/view/', [BusinessController::class, 'view'])->name('view')->middleware('AdminUser');
Route::post('admin/business/add', [BusinessController::class, 'add'])->name('add')->middleware('AdminUser');
Route::post('admin/business/update', [BusinessController::class, 'update'])->name('update')->middleware('AdminUser');
Route::get('admin/business/change-status', [BusinessController::class, 'statusChange'])->name('statusChange')->middleware('AdminUser');

//Videos
Route::get('admin/videos/', [VideoController::class, 'adminList'])->name('adminList')->middleware('AdminUser');
Route::post('/admin/video/delete', [VideoController::class, 'adminDelete'])->name('adminDelete')->middleware('AdminUser');
Route::get('/admin/video/change-status', [VideoController::class, 'changeStatus'])->name('changeStatus')->middleware('AdminUser');
Route::get('/admin/video/likes', [VideoController::class, 'getVideoLikesList'])->name('getVideoLikesList')->middleware('AdminUser');
Route::post('/admin/video/update/button', [VideoController::class, 'updateButton'])->name('updateButton')->middleware('AdminUser');





Route::get('/terms-condtions', function () {
    return view('comingsoon');
});
Route::get('/coming-soon', function () {
    return view('comingsoon');
});
Route::get('/affiliations', function () {
    return view('affiliations');
});


// zillow data parsing to database
Route::get('admin/zillow/add', [LoginController::class, 'zillowDataForm'])->name('zillowDataForm')->middleware('AdminUser');
Route::post('zillow/data/add', [LoginController::class, 'zillowDataadd'])->name('zillowDataadd')->middleware('AdminUser');
