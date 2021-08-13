@extends('layouts.app')

@section('content')
    @include('shared.organic-breadcrumb', ['name' => 'Login/Register', 'breadcrumb' => 'Login/Register'])

    <!--================Login Box Area =================-->
    <section class="login_box_area section_gap">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid" src="img/login.jpg" alt="">
                        <div class="hover">
                            <h4>New to our website?</h4>
                            <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                            <a class="primary-btn" href="{{ route('login') }}">Create an Account</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <h3>Log in to enter</h3>
                        <form class="row login_form" action="{{ route('auth.register') }}" method="post" id="contactForm" novalidate="novalidate">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" value="{{ old('username') }}" id="name" name="username" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                                @error('username') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name" placeholder="Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'">
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" value="{{ old('phone') }}" id="phone" name="phone" placeholder="Phone" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone'">
                                @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" value="{{ old('address') }}" id="address" name="address" placeholder="Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'">
                                @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="primary-btn">Register</button>
                                <a href="#">Forgot Password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Login Box Area =================-->
@endsection
