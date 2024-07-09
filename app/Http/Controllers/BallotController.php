<?php

namespace App\Http\Controllers;

use App\Question;
use App\Response;
use App\SelectedForVote;
use App\User;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class BallotController extends Controller
{
    public function view()
    {
        $previousResonses=[];
        $polling_questions = Question::get();
        $currentUser = User::where('id', '=', session('user')->id)->first();
        $selected_for_votes = \App\Video::join('selected_for_votes', 'videos.id', '=', 'selected_for_votes.video_id')
            ->where('selected_for_votes.user_id', $currentUser->id)
            ->join('generes', 'videos.genere_id', '=', 'generes.id')
            ->orderBy('videos.id', 'desc')
            ->select('videos.*', "videos.id as video_id", 'generes.title as genere_name')
            ->first();
            if($selected_for_votes)
            {
                // if this video is resubmitting the response then give previous responses as well
                $previousResonses=Response::where('user_id','=',$currentUser->id)->where('video_id','=',$selected_for_votes->video_id)->get();
            }

        $votedVidoes = \App\Video::join('votes', 'videos.id', '=', 'votes.video_id')
            ->where('votes.user_id', $currentUser->id)
            ->join('generes', 'videos.genere_id', '=', 'generes.id')
            ->orderBy('videos.id', 'desc')
            ->select('videos.*',"videos.id as video_id" ,'generes.title as genere_name')
            ->get();
        $topLikedVideos = \App\Video::join('likes', 'videos.id', '=', 'likes.video_id')
            ->where('likes.user_id', $currentUser->id)
            ->join('generes', 'videos.genere_id', '=', 'generes.id')
            ->orderBy('videos.id', 'desc')
            ->limit(4)
            ->select('videos.*',"videos.id as video_id" ,'generes.title as genere_name')
            ->get();
        $Allvideos = \App\Video::join('generes', 'videos.genere_id', '=', 'generes.id')
        ->orderBy('videos.id', 'desc')
        ->select('videos.*',"videos.id as video_id" ,'generes.title as genere_name')
        ->get();
        
        
        $historyVideoIds = DB::table('video_histories')
            ->where('user_id', $currentUser->id)
            ->pluck('video_id')
            ->toArray();
        
        $history = $Allvideos->whereIn('id', $historyVideoIds)->take(4);
        $videos = $history;
        return view('MainSite.Content.Ballot.index', compact('previousResonses','history','selected_for_votes', 'polling_questions','votedVidoes','topLikedVideos','videos'));
    }

    public function submitQuestions(Request $request)
    {
        $video_id=Crypt::decryptString($request->video);
        $currentUser = User::where('id', '=', session('user')->id)->first();
        $polling_questions = Question::get();
        foreach ($polling_questions as $key => $item) {
            $reponse = new Response();
            $reponse->question_id = $item->id;
            $reponse->response_type = $request[$item->id];
            $reponse->user_id = $currentUser->id;
            $reponse->video_id = $video_id;
            $reponse->save();
        }
        $vote = new Vote();
        $vote->user_id = $currentUser->id;
        $vote->video_id = $video_id;
        $vote->save();
        $selected_for_votes = SelectedForVote::where('video_id', '=', $video_id)->where('user_id', '=', $currentUser->id)->first();
        $result = $selected_for_votes->delete();
        if ($result) {

            return redirect('/ballot')->with(['msg-success' => "You have successfully voted for the video"]);
        }
    }
  public function resubmitQuestions(Request $request)
  {
      $video_id= Crypt::decryptString($request->video);
      $currentUser = User::where('id', '=', session('user')->id)->first();
      $oldResponses=Response::where('user_id','=',$currentUser->id)->where('video_id','=',$video_id)->get();
      $selected_for_votes = SelectedForVote::where('video_id', '=', $video_id)->where('user_id', '=', $currentUser->id)->first();

      foreach ($oldResponses as $key => $value) {
        $value->delete();
      }
        $polling_questions = Question::get();
        foreach ($polling_questions as $key => $item) {
            $reponse = new Response();
            $reponse->question_id = $item->id;
            $reponse->response_type = $request[$item->id];
            $reponse->user_id = $currentUser->id;
            $reponse->video_id = $video_id;
            $reponse->save();
        }
        $result = $selected_for_votes->delete();
        if ($result) {

            return redirect('/ballot')->with(['msg-success' => "You have successfully resubmitted  your video"]);
        }
        
  }
}
