<?php

namespace App\Http\Controllers;

use App\Business;
use App\Creator;
use App\Like;
use App\Mail\CreatorMail;
use App\NewBusiness;
use App\RealEstate;
use App\User;
use App\Video;
use App\VideoHistory as AppVideoHistory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use VideoHistory;

class LoginController extends Controller
{

    //                                  MAIN SITE WORK

    //                                  login work
    public function loginView()
    {
        return view('MainSite.Login.index');
    }
    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', '=', $req->email)
            ->first();
        if ($user) {
            if (Hash::check($req->password, $user->password)) {
                session()->put('user', $user);
                return redirect('/');
            } else {
                return redirect('/login')->with(['msg-error-password' => 'Invalid password']);
            }
        } else {
            return redirect('/login')->with(['msg-error-username' => "Username doesn't exists"]);
        }
    }

    //                                 register as user
    public function UserRegisterView(Request $req)
    {
        return view('MainSite.Register.index');
    }
    public function UserRegister(Request $req)
    {
        $timestamp = time();
        $req->validate([
            "first_name" => 'required|regex:/^[a-zA-Z]+$/',
            "last_name" => 'required|regex:/^[a-zA-Z]+$/',
            "user_name" => 'required|unique:users,user_name',
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed',
            "phone" => 'required',
            "zip_code" => 'required|regex:/^[0-9]+$/',
            'image' => 'mimes:png,jpeg,jpg',
        ],[
            'first_name.regex' => 'The first name should only contain alphabetic characters.',
            'last_name.regex' => 'The last name should only contain alphabetic characters.',
            'zip_code.regex' => 'The zip code should only contain numeric digits.',
        ]);
        $user = new User();

        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->user_name = $req->user_name;
        $user->phone = $req->phone;
        $user->image = $req->image;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->zip_code = $req->zip_code;
        $user->lat = $req->lat;
        $user->long = $req->long;
        if ($req->image) {
            $thumnailRequest = $req->file('image');
            $originalThumnail = $thumnailRequest->getClientOriginalName();
            $Thumbnailfilename = $timestamp . '_' . $originalThumnail;
            $uploaded = $thumnailRequest->move(public_path('Data/User/Profile'), $Thumbnailfilename);
            $user->image = $Thumbnailfilename;
        }
        $result = $user->save();
        if ($result) {
            session()->put('user', $user);
            if ($req->type == 'yes') {
                return redirect('/register')->with(['msg-success' => 'You have registered as creator']);
            } else {
                return redirect('/login')->with(['msg-success' => 'You have registered as creator']);
            }
        } else {
            return redirect('user/register')->with(['msg-errror' => 'Something went wrong please try again']);
        }
    }
    public function logout()
    {
        session()->remove('user');
        return redirect('/');
    }
    public function landingPage()
    {

        return view('MainSite.Content.LandingPage.index');
    }

    //                  ADMIN auth
    public function adminLoginForm()
    {
        return view('Admin.Auth.login');
    }
    public function adminLogin(Request $req)
    {
        $req->validate(['email' => 'required', 'password' => 'required']);
        $user = User::where('role_id', '=', 1)->where('email', '=', $req->email)
            ->first();
        if ($user) {
            if (Hash::check($req->password, $user->password)) {
                session()->put('admin', $user);
                return redirect('/admin/users');
            } else {
                return redirect('/admin/login')->with(['msg-error-password' => 'Invalid password']);
            }
        } else {
            return redirect('/admin/login')->with(['msg-error-username' => "Username doesn't exists"]);
        }
    }
    public function adminLogout()
    {
        session()->remove('admin');
        return redirect('/admin/login');
    }
    //      landing pages

    public function nacLive(Request $req)
    {
        $querry = $req->query('watch');
        $id = '';
        if ($querry) {
            $id = Crypt::decryptString($querry);
            $oneVideo = Video::where('is_approved', '=', 'Yes')->with('likes')->with('votes')->find($id);
            if(session()->has('user')){
                $is_history = AppVideoHistory::where("user_id", '=', session('user')->id)->where('video_id', '=', $id)->first();
                if (!$is_history) {
                    $history = new AppVideoHistory();
                    $history->user_id = session('user')->id;
                    $history->video_id = $id;
                    $history->save();
                }
            }
        } else {
            $oneVideo = Video::where('is_approved', '=', 'Yes')->with('likes')->with('votes')->inRandomOrder()->first();
        }
        $moreVideos = [];
        $user = [];
        if ($oneVideo) {
            $user = User::find($oneVideo->user_id);
            $moreVideos = Video::where('is_approved', '=', 'Yes')
                ->where('id', '!=', $oneVideo->id)
                ->where('genere_id', '=', $oneVideo->genere_id)
                ->with('likes')->with('votes')
                ->get();
        }

        return view('MainSite.Content.Live.index', compact('oneVideo', 'moreVideos', 'user', 'id'));
    }
    // if couldnot encrypt id using jquerry redicrt to this url
    public function redicrectToWatch(Request $req)
    {
        $id = $req->query('id');
        $encryptedUrl = Crypt::encryptString($id);
        return redirect('live?watch=' . $encryptedUrl);
    }
    public function home()
    {
        $videos = Video::where('is_approved', '=', 'Yes')->with('likes')->with('votes')->with('genere')->inRandomOrder()->limit(20)
            ->get();
        return view('MainSite.Content.Home.index', compact('videos'));
    }
    // public function show()
    // {
    //     $videos = Video::where('is_approved', '=', 'Yes')->with('likes')->with('votes')->with('genere')->inRandomOrder()->limit(20)
    //         ->get();
    //     return view('MainSite.Content.Home.show', compact('videos'));
    // }
    public function globalSearch(Request $req)
    {
        $searchTerm = $req->searchInput;
        if (!$searchTerm) {
            $videos = collect(); // create an empty collection
        } else {
            $videos = Video::with('likes')
                ->with('votes')
                ->with('genere')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('video_title', 'LIKE', '%' . $searchTerm . '%');
                })
                ->where('is_approved', '=', 'Yes')
                ->inRandomOrder()
                ->get();
        }
        return view('MainSite.Content.GlobalSearch.index', compact('videos'));
    }
    // dashboard
    public function dashbaord()
    {
        $users = User::get()->count();
        $business = Business::get()->count();
        $videos = Video::where('is_approved', '=', 'Yes')->get()->count();
        return view('Admin.Dashboard.index', compact('users', 'business', 'videos'));
    }


    // zillow data parsing route

    public function zillowDataForm()
    {
        return view('welcome');
    }
    public function zillowDataadd(Request $req)
    {
        $data = json_decode($req->data, true);
        foreach ($data as $item) {
            $realEstate = new RealEstate();
            $realEstate->jsonData = json_encode($item);
            $realEstate->lat = $item['latitude'] ?? 0;
            $realEstate->long = $item['longitude'] ?? 0;
            $realEstate->cityName = $item['city'];
            $realEstate->price = $item['price'];
            $realEstate->status = $item['homeStatus'];
            $realEstate->save();
        }
        return redirect()->back()->with(['msg-success' => 'Addedd successfully']);
    }

    public function registerCreatorForm()
    {
        return view('MainSite.Creator.creator');
    }
    public function registerCreator(Request $req)
    {

        $timestamp = time();
        $req->validate([
            "title" => 'required',
            "name" => 'required',
            "genre" => 'required',
            "zip_code" => 'required|numeric',
            // 'image' => 'mimes:png,jpeg,jpg',
            'tags' => 'required'
        ]);
        $user =  session('user')->id;
        $creator = new Creator();
        $creator->title = $req->title;
        $creator->name = $req->name;
        $creator->genre = $req->genre;
        $creator->tags = $req->tags;
        $creator->image = $req->image;
        $creator->zip_code = $req->zip_code;
        $creator->description = $req->description;
        $creator->user_id = $user;
        if ($req->hasFile('image')) {
            $thumnailRequest = $req->file('image');
            $originalThumnail = $thumnailRequest->getClientOriginalName();
            $Thumbnailfilename = $timestamp . '_' . $originalThumnail;
            $uploaded = $thumnailRequest->move(public_path('Data/User/Profile'), $Thumbnailfilename);
            $creator->image = $Thumbnailfilename;
        }
        $result = $creator->save();
        if ($result) {
            $user =  session('user');
            $mailData = [

                'bodyMessage' => 'Thank you for registering. We will let you know once it is approved',
            ];
            // dd($mailData);
            Mail::to($user->email)->send(new CreatorMail($mailData));
            return redirect('/upload/video')->with(['msg-success' => 'You have registered as creator']);
        } else {
            return redirect('creator/registration')->with(['msg-errror' => 'Something went wrong please try again']);
        }
    }

    public function businessRegisterForm()
    {
        return view('MainSite.Business.business');
    }

    public function businessRegister(Request $req)
    {
        $req->validate([
            "name" => 'required',
            "address" => 'required',
            "website" => 'required',
            "phone_number" => 'required'
        ]);
        $business = new NewBusiness();
        $business->name = $req->name;
        $business->description = $req->description;
        $business->is_approved = $req->is_approved ? 'Yes' : 'No';
        $business->website = $req->website;
        $business->phone_number = $req->phone_number;
        $business->address = $req->address;
        $result = $business->save();
        if ($result) {
            return redirect('/home')->with(['msg-success' => 'You have registered as business']);
        } else {
            return redirect('business/register')->with(['msg-errror' => 'Something went wrong please try again']);
        }
    }
}
