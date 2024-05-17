<!-- 
    ERNIE MASTURA BINTI BAKRI (CB21161)
    DENTAL APPOINTMENT SYSTEM
    Login Page
 -->

 <!DOCTYPE html>
<html lang="en">

<head>
    <link href="css/style.css" rel="stylesheet">
	<link href="css/modern.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="/img/dental logo.png">

    <title>DENTAL APPOINTMENT SYSTEM</title>

    <script src="js/settings.js"></script>
    <script src="js/app.js"></script>

</head>

<body class="theme-blue">
    <div class="header-user">
        <div class="m-sm-4">
            <div class="text-center">
                <img src="/img/dental logo.png" class="img-fluid rounded-circle"
                    width="250" height="250" />
            </div>
        </div>
    </div>
</body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Create an Account') }}</div>

                <div class="card-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="userName" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="userName" type="text" class="form-control @error('userName') is-invalid @enderror" name="userName" value="{{ old('userName') }}" required autocomplete="name" autofocus>

                                @error('userName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="userIC" class="col-md-4 col-form-label text-md-end">{{ __('Identification Card') }}</label>

                            <div class="col-md-6">
                                <input id="userIC" type="text" class="form-control @error('userIC') is-invalid @enderror" name="userIC" value="{{ old('userIC') }}" required autocomplete="userIC" autofocus>

                                @error('userIC')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="userEmail" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="userEmail" type="email" class="form-control @error('userEmail') is-invalid @enderror" name="userEmail" value="{{ old('userEmail') }}" required autocomplete="email">

                                @error('userEmail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="userPhone" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="userPhone" type="text" class="form-control @error('userPhone') is-invalid @enderror" name="userPhone" required autocomplete="tel">

                                @error('userPhone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="userGender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
                            <div class="col-md-6">
                                <select id="userGender" class="form-control" name="userGender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>

                                @error('userGender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="userRole" class="col-md-4 col-form-label text-md-end">{{ __('User Role') }}</label>
                            <div class="col-md-6">
                                <select id="userRole" class="form-control" name="userRole" required>
                                    <option value="User">User</option>
                                    <option value="Dentist">Dentist</option>
                                </select>

                                @error('userRole')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="row justify-content-center mb-0">
                        <div class="col-md-6 text-center">
                            <a class="btn btn-link" href="{{ route('welcome') }}">
                                {{ __('Already has an account') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

