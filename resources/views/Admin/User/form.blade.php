@extends('Admin.index', ['title' => 'People'])
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h5>Add User</h5>
        </div>
    </div>
    <section class="content">
        <div class="card">

            <div class="card-body">
                <form action="{{ isset($user)?url('/admin/users/update') :url('/admin/users/add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <input type="hidden" value="{{isset($user)?$user->id:''}}" name="user_id">
                                <label>Select Role<span style="color:red">*</span></label>
                                <select name="role" class="form-control">
                                    <option value="0">Select Role</option>
                                    @foreach ($roles as $item)
                                        <option @if (isset($user) && $item->id == $user->role_id) selected @endif
                                            style="text-transform: capitalize" value="{{ $item->id }}">
                                            {{ $item->title }}</option>
                                    @endforeach

                                    <!--  <option value="6">Karigar</option> -->
                                </select>
                                <span class="text-danger">
                                    @error('role')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label>First Name<span style="color:red">*</span></label>
                                <input
                                   value="{{isset($user)?$user->first_name:old('firstname')}}"
                                type="text" name="firstname"  placeholder="John"
                                    class="form-control" data-validation="required">
                                <span class="text-danger">
                                    @error('firstname')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input 
                                
                                type="text" name="lastname" value="{{isset($user)?$user->last_name:old('lastname')}}" id="lastname"
                                    placeholder="Wick" data-errortext="This is dealer's username!" class="form-control"
                                    data-validation="required">
                                <span class="text-danger">
                                    @error('lastname')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label>Username <span style="color:red">*</span></label>
                                <input type="text" name="username" value="{{isset($user)?$user->user_name:old('username')}}" id="username"
                                    placeholder="Please provide username" class="form-control">
                                <span class="text-danger">
                                    @error('username')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>


                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label>Email<span style="color:red">*</span></label>
                                <input maxlength="15" type="text" name="email" value="{{isset($user)?$user->email:old('email')}}"
                                    placeholder="johnwick@killer.com" class="form-control" data-validation="required">
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label>Phone<span style="color:red">*</span></label>
                                <input type="text" name="phone" value="{{isset($user)?$user->phone:old('phone')}}" id="address"
                                    placeholder="+001 900019001" data-errortext="This is dealer's username!"
                                    class="form-control" data-validation="required">
                                <span class="text-danger">
                                    @error('phone')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label>Password<span style="color:red">*</span></label>
                                <input type="text" name="password" value="" id="password"
                                    placeholder="Please provide password" class="form-control" data-validation="required">
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label>Confirm Password <span style="color:red">*</span></label>
                                <input type="password" name="confirmPassword" value="" id="confirmPassword"
                                    placeholder="comfirm password" data-errortext="This is dealer's username!"
                                    class="form-control" data-validation="required">
                                <span class="text-danger">
                                    @error('confirmPassword')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <button type="submit" class="btn btn-info btn-sm">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
