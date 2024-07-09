<?php

namespace App\Http\Controllers;

use App\Business;
use App\Lead;
use App\Mail\NacLead;
use App\Mail\NacMail;
use App\RealEstate;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class DiscoverController extends Controller
{
    public function view(Request $req)
    {
        $Video='';
        $videoID = $req->query('locate');
        $Video=Video::where('is_approved','=','Yes')->find($videoID);
        $Business = array();
        //$Business=Business::where('is_approved','=','Yes')->limit(6)->latest()->get();
        $Videos=Video::leftJoin('generes','videos.genere_id','generes.id')->where('is_approved','=','Yes')->select('videos.*','generes.title as genere')->get();
        $properties=RealEstate::limit(6)->latest()->get();
        // echo json_encode('hello');exit;
        return view('MainSite.Content.Discover.index',compact("properties","Business",'Videos','Video'));
    }
    public function searchpropery(Request $request){
        if($request->ajax())
        {
            $output="";
            if (is_numeric($request->search)){  
                $properties=RealEstate::where('price','LIKE','%'.$request->search."%")->limit(6)->latest()->get();
            }else{
                $properties=RealEstate::where('cityName','LIKE','%'.$request->search."%")->limit(6)->latest()->get();
            }
            if($properties)
            {
                foreach ($properties as $key => $product) {
                    $output.= '<div class="card mx-2" style="width: 18rem;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title font-weight-bold">'.$product->name.'</h5>
                                        <p class="card-text m-0"><span class="font-weight-bold mr-1">City:</span>'.$product->cityName.'</p>
                                        <p class="card-text m-0"><span class="font-weight-bold mr-1">Price:</span>'.$product->price.'</p>
                                    </div>
                                </div>';
                }
                return Response($output);
            }

        }

    }
    public function searchtvshow(Request $request){
        if($request->ajax())
        {
            $output="";
               $Video=Video::where('is_approved','=','Yes')->get();
                $Videos = Video::leftJoin('generes', 'videos.genere_id', 'generes.id')
                ->where('is_approved', '=', 'Yes')
                ->where(function ($query) use ($request) {
                    $query->where('videos.video_title', 'LIKE', '%' . $request->search . '%')
                          ->orWhere('generes.title', 'LIKE', '%' . $request->search . '%');
                })
                ->select('videos.*', 'generes.title as genere')
                ->get();
            // $Video=Video::where('is_approved','=','Yes')->get();
            // $Videos=Video::leftJoin('generes','videos.genere_id','generes.id')->where('is_approved','=','Yes')->select('videos.*','generes.title as genere')->where('videos.video_title','LIKE','%'.$request->search."%")->get();
            if($Videos)
            {
                foreach ($Videos as $key => $product)
                {
                    $encryptedUrl = Crypt::encryptString($product->id);
                    $output.= '<div class="card mx-2" style="width: 18rem;">'.
                                    '<img src="' . asset('Data/Thumbnail/' . $product->thumbnail) . '" class="card-img-top" alt="">' .
                                    '<div class="card-body d-flex flex-column">'.
                                        '<h5 class="card-title font-weight-bold mb-0">'.substr($product->video_title, 0, 20).'</h5>'.
                                        '<p class="card-text mt-0"><span class="font-weight-bold mr-1">Genre:</span>'.$product->genere.'</p>'.
                                        '<div class="mt-auto">
                                            <a href="' . url('live?watch=' . $encryptedUrl) . '" class="btn btn-primary">Watch</a>
                                        </div>
                                    </div>
                                </div>';
                }
                return Response($output);
            }
        }
    }
    public function getAllBusiness() {
        $Business=Business::where('is_approved','=','Yes')->latest()->get();
        return view('MainSite.Content.Discover.viewAll',compact("Business"));
    }
    public function allProperties() {
        $properties=RealEstate::latest()->get();  
        return view('MainSite.Content.Discover.viewAll',compact("properties"));
    }

    public function emailData(Request $req){
        $mailData = [
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'subject' => $req->input('phone'),
            'bodyMessage' => $req->input('message'),
        ];
        $leadMail = new Lead;
        $leadMail->lead_name = $req->name;
        $leadMail->user_id = session('user')->id;
        $leadMail->lead_email = $req->email;
        $leadMail->lead_phoneNo = $req->phone;
        $leadMail->lead_message = $req->message;
        $leadMail->save();
        Mail::to('newathenscreative@gmail.com')->send(new NacLead($mailData));
    
        return back()->with('success', 'Thanks for contacting us, will get back to you soon!');
        // ashley.cricadda@gmail.com
        
    }

    public function homeLoanData(Request $req){
        $subject = "HOI LEAD";
        $mailData = [
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'subject' => $subject,
            'bodyMessage' => $req->input('message'),
        ];
        $leadMail = new Lead;
        $leadMail->user_id = session('user')->id;
        $leadMail->lead_name = $req->name;
        $leadMail->lead_email = $req->email;
        $leadMail->lead_phoneNo = $req->phone;
        $leadMail->lead_message = $req->message;
        $leadMail->save();
        Mail::to('newathenscreative@gmail.com')->send(new NacLead($mailData));
    
        return back()->with('success', 'Thanks for contacting us, will get back to you soon!');
    }

}
