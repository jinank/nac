<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function viewProfile()
    { 
        $currentUser=User::where('id','=',session('user')->id)->first();
        $topLikedVideos = \App\Video::join('likes', 'videos.id', '=', 'likes.video_id')
                        ->where('videos.is_approved','=','Yes')
                        ->where('likes.user_id', $currentUser->id)
                        ->join('generes', 'videos.genere_id', '=', 'generes.id')
                        ->orderBy('videos.id', 'desc')
                        ->limit(6)
                        ->select('videos.*',"videos.id as video_id" ,'generes.title as genere_name')
                        ->get();
        $votedVidoes = \App\Video::join('votes', 'videos.id', '=', 'votes.video_id')
                        ->where('votes.user_id', $currentUser->id)
                        ->where('videos.is_approved','=','Yes')
                        ->join('generes', 'videos.genere_id', '=', 'generes.id')
                        ->orderBy('videos.id', 'desc')
                        ->limit(6)
                        ->select('videos.*',"videos.id as video_id" ,'generes.title as genere_name')
                        ->get();
        $yourVideos = \App\Video::where('user_id', $currentUser->id)
                        ->join('generes', 'videos.genere_id', '=', 'generes.id')
                        ->orderBy('videos.id', 'desc')
                        ->where('videos.is_approved','=','Yes')
                        ->select('videos.*',"videos.id as video_id" ,'generes.title as genere_name')
                        ->get();                
                    
        return view('MainSite.Content.Profile.view',compact('topLikedVideos','votedVidoes','yourVideos','currentUser'));
    }
    public function update(Request $req)
    {
       $currentUser=User::where('id','=',session('user')->id)->first();
       $timestamp = time();
       $req->validate([
           'first_name'=>'required',
           'last_name'=>'required',
           'user_name'=>'required',
           'phone'=>'required',
           'email'=>'required',
           'zipcode'=>'required',
           
        ]);
           
        if ($req->file('image')) {
            $thumnailRequest = $req->file('image');
            $originalThumnail = $thumnailRequest->getClientOriginalName();
            $Thumbnailfilename = $timestamp . '_' . $originalThumnail;
            $uploaded = $thumnailRequest->move(public_path('Data/User/Profile'), $Thumbnailfilename);
            $currentUser->image = $Thumbnailfilename;
        }
        $currentUser->first_name=$req->first_name;
        $currentUser->last_name=$req->last_name;
        $currentUser->user_name =$req->user_name;
        $currentUser->phone=$req->phone;
        $currentUser->email =$req->email;
        if($req->password)
        {
            $currentUser->password=Hash::make($req->password);
        }

        $currentUser->zip_code=$req->zipcode;
        $currentUser->lat=$req->lat;
        $currentUser->long=$req->long;
        $currentUser->update();
        return redirect('/user/profile')->with(['success'=>"Profile has been updated"]);

    }
}
