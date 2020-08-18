@extends('layouts.admin')
@section('content-header')
<div class="container-fluid admin-user-index">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Change Password</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{url('admin/userprofile')}}">user profile</a></li>
            <li class="breadcrumb-item active"><a href="{{url('admin/changepass')}}">change password</a></li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
@section('content')
    <div class="col-sm-12">
        @if($users)
            <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>
            <div class="col-md-12 p-0">
            <input id="name" type="text" class="form-control" readonly value="{{$users->name}}">
            </div>
            <label for="name" class="col-form-label text-md-right">{{ __('Username') }}</label>
            <div class="col-md-12 p-0">
            <input id="name" type="text" class="form-control" readonly value="{{$users->username}}">
            </div>
            <label for="name" class="col-form-label text-md-right">{{ __('Role') }}</label>
            <div class="col-md-12 p-0">
            <input id="name" type="text" class="form-control" readonly value="{{$role}}">
            </div>
            <label for="name" class="col-form-label text-md-right">{{ __('Status') }}</label>
            <div class="col-md-12 p-0">
            <input id="name" type="text" class="form-control" readonly value="{{$users->is_active==1?'Active':'In Active'}}">
            </div>
        @endif
        <div class="pt-2">
            <button class="showChangePass btn btn-primary p-1">Change password</button>
        </div>
        
        <div class="form-div" style="display: none;">
            <form action="{{route('change.password')}}" method="post" role="form" class="form-horizontal">
                {{csrf_field()}}
                    <div class="form-group{{ $errors->has('old') ? ' has-error' : '' }}">
                        <label for="password">Current Password</label>
                        <div>
                            <input id="password" type="password" class="form-control" name="old" id="old">
                            @if ($errors->has('old'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('old') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">New Password</label>
                        <div>
                            <input id="password" type="password" class="form-control" name="password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
    
                    <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                        <label for="new_password">Confirm New Password</label>
                        <div>
                            <input id="new_password" type="password" class="form-control" name="new_password">
                            @if ($errors->has('new-password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('new-password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary form-control">Save</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
<script>
$(document).ready(function(){
    $(".showChangePass").click(function(){
        $(".form-div").slideToggle("slow",function(){
        });
    });
});
</script>
@endsection

