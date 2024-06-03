<!-- 
    ERNIE MASTURA BINTI BAKRI (CB21161)
    DENTAL APPOINTMENT SYSTEM
    Login Page
 -->

<!DOCTYPE html>
<html lang="en">

<head>
    
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
            <div class="card-header text-center">{{ __('Login') }}</div>

                <div class="card-body ">
                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('error')}}
                    </div>
                    @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="userEmail" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                        <div class="col-md-6">
                        <input id="userEmail" type="email" class="form-control @error('userEmail') is-invalid @enderror" name="userEmail" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    

                    <div class="row justify-content-center">
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>

                    <div class="row justify-content-center mb-0">
                        <div class="col-md-6 text-center">
                            <a class="btn btn-link" href="{{ route('register') }}">
                                {{ __('Create Account') }}
                            </a>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</div>

</html>

