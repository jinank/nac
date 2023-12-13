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
