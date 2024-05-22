<!-- 
    ERNIE MASTURA BINTI BAKRI (CB21161)
    DENTAL APPOINTMENT SYSTEM
    Admin Login Page
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
            <div class="card-header text-center">{{ __('Admin Login') }}</div>

                <div class="card-body ">
                <form  action="{{ route('adminLogin') }}" method="POST">

                    @csrf

                    <div class="row mb-3">
                        <label for="adminEmail" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                        <div class="col-md-6">
                        <input id="adminEmail" type="email" class="form-control @error('adminEmail') is-invalid @enderror" name="adminEmail" required autocomplete="email" autofocus>
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
                    
                </div>

            </div>
        </div>
    </div>
</div>

</html>

