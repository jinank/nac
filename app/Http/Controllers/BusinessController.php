<?php

namespace App\Http\Controllers;

use App\Business;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BusinessController extends Controller
{
  public function getBusiness()
  {
    $Business = Business::get();
    return $Business;
  }
  //              ADMIN
  public function list()
  {
    $Businesses = Business::orderBy('id', 'desc')->paginate(20);
    return view('Admin.Business.list', compact('Businesses'));
  }
  public function delete(Request $req)
  {
    $User = Business::find($req->deleteId);
    $User->delete();
    return redirect('/admin/business/')->with(['msg-success' => 'Business has been deleted']);
  }
  public function view(Request $req)
  {
    $business_id = $req->query('item');


    if ($business_id) {
      $Business = Business::find($business_id);
      return view('Admin.Business.form', compact('Business'));
    }
    return view('Admin.Business.form');
  }
  public function add(Request $req)
  {
    $req->validate([
      'address' => 'required',
      'phone' => 'required',
      'email' => 'required',
      'name' => 'required',
    ]);
    $Business = new Business();
    $Business->name = $req->name;
    $Business->email = $req->email;
    $Business->contact = $req->phone;
    $Business->address = $req->address;
    $Business->website = $req->website;
    $Business->about = $req->about;
    $Business->raw_location = 'null';
    $Business->save();
    return redirect('/admin/business')->with(['msg-success' => 'Business has been added']);
  }
  function update(Request $req)
  {
    $req->validate([
      'address' => 'required',
      'phone' => 'required',

      'email' => 'required',
      'name' => 'required',

    ]);
    $Business = Business::find($req->id);
    $Business->name = $req->name;
    $Business->email = $req->email;
    $Business->contact = $req->phone;
    $Business->address = $req->address;
    $Business->raw_location = 'null';
    $Business->save();
    $Business->update();
    return redirect('/admin/business')->with(['msg-success' => "Business has been added"]);
  }

  function statusChange(Request $req)
  {
      $business=Business::find($req->id);
      $status=$business->is_approved=="Yes"?"No":"Yes";
      $business->is_approved=$status;
      $business->update();
      return  $status;
  }


  // for normal user

  public function registerBusinessForm()
  {
    return view('MainSite.Register.business');
  }
  public function registerBusiness(Request $req)
  {

    $req->validate([
        'address' => 'required',
        'name' => ['required', 'unique:businesses,name', 'regex:/^[A-Za-z\s]+$/'],
        'email' => ['required', 'unique:businesses,email', 'email'],
        'website' => ['url', 'nullable'],
    ],[
        'name' => 'The name should only contain alphabetic characters.',
        'email.email' => 'The email must be a valid email address.',
        'website.url' => 'The website must be a valid URL.',
    ]);
    $Business = new Business();
    $Business->name = $req->name;
    $Business->email = $req->email;
    $Business->contact = $req->phone;
    $Business->address = $req->address;
    $Business->raw_location = $req->location_details;
    $Business->lat = $req->location_lat;
    $Business->long = $req->location_long;
    $Business->website = $req->website;
    $Business->about = $req->about;
    $Business->save();
    if($req->type=='yes')
    {
      return redirect('user/register')->with(['msg-success' => 'Your business is registered with us',]);
    }
    else
    {
      return redirect()->back()->with(['msg-success' => 'Your business is registered with us']);
    }
  }

}
