@extends('layouts.app')

@section('content')
    @include('shared.organic-breadcrumb', ['name' => 'Reset Password', 'breadcrumb' => 'Reset Password'])

    <!--================Login Box Area =================-->
    <section class="login_box_area section_gap">
        <div class="container">
            @if(session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid" src="/img/login.jpg" alt="">
                        <div class="hover">
                            <h4>New to our website?</h4>
                            <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                            <a class="primary-btn" href="{{ route('register') }}">Create an Account</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <h3>Reset Password</h3>
                        <form class="row login_form" action="{{ route('password.resetPassword', ['email' => request('email'), 'signature' => request('signature')]) }}" method="post" id="contactForm" novalidate="novalidate">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" value="{{ old('password') }}" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" value="{{ old('password_confirmation') }}" id="password_confirmation" name="password_confirmation" placeholder="Password Confirmation" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password Confirmation'">
                                @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="primary-btn">Reset Forgot</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Login Box Area =================-->
@endsection
