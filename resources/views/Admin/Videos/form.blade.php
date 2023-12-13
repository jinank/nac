@extends('Admin.index', ['title' => 'Business'])
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h5>Add User</h5>
        </div>
    </div>
    <section class="content">
        <div class="card">

            <div class="card-body">
                <form action="{{ isset($Business) ? url('/admin/business/update') : url('/admin/business/add') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id"value="{{ isset($Business) ? $Business->id : '' }}">
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label>Business Name<span style="color:red">*</span></label>
                                <input value="{{ isset($Business) ? $Business->name : old('name') }}" type="text"
                                    name="name" placeholder="ABD Ltd." class="form-control" data-validation="required">
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email"
                                    value="{{ isset($Business) ? $Business->email : old('email') }}" id="lastname"
                                    placeholder="abc@gmail.com" data-errortext="This is dealer's username!"
                                    class="form-control" data-validation="required">
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label>contact<span style="color:red">*</span></label>
                                <input type="text" name="phone"
                                    value="{{ isset($Business) ? $Business->contact : old('contact') }}" id="username"
                                    placeholder="+02 0199991982" class="form-control">
                                <span class="text-danger">
                                    @error('contact')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>


                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label>Address<span style="color:red">*</span></label>
                                <input maxlength="15" type="text" name="address"
                                    value="{{ isset($Business) ? $Business->address : old('address') }}"
                                    placeholder="Address" class="form-control" data-validation="required">
                                <span class="text-danger">
                                    @error('address')
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
