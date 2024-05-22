<!--
    ERNIE MASTURA BINTI BAKRI (CB21161)
    DENTAL APPOINTMENT SYSTEM
	Layout for Admin Interface
-->


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="/img/dental logo.png">
    

    <title>DENTAL APPOINTMENT SYSTEM</title>
    <style>
        body {
            opacity: 0;
        }

        .wrapper:before {
            background: #B2F1B8;
            content: " ";
            height: 264px;
            left: 0;
            position: absolute;
            top: 0;
            width: 100%
        }
		
		.sidebar-brand img {
			height: 140px; 
			width: auto; 
			margin-top: 5px; 
		}


    </style>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/modern.css') }}">


</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <a class="sidebar-brand" style="background: #B2F1B8;" href="{{ route('dentist.index') }}">
                <img src="/img/dental logo.png" >
            </a>
            <div class="sidebar-content">
                @if(auth()->check())
                    <div class="sidebar-user">
                        <span class="d-sm-inline d-none">{{ auth()->admin()->adminEmail }}</span><br>
                        <span class="d-sm-inline d-none">{{ __('Admin') }}</span>
                        <br>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">{{ __('Logout') }}</button>
                        </form>
                    </div>
                @endif
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
					<a class="sidebar-link" href="{{ route('admin.index') }}"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-house-door-fill" viewBox="0 0 16 16">
                                <path
                                    d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z" />
                            </svg> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.doctor') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-file-text-fill" viewBox="0 0 16 16">
                                <path
                                    d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z" />
                            </svg> <span class="align-middle">Doctor</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.patient') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-medical-fill" viewBox="0 0 16 16">
                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-3 2v.634l.549-.317a.5.5 0 1 1 .5.866L7 7l.549.317a.5.5 0 1 1-.5.866L6.5 7.866V8.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L5 7l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V5.5a.5.5 0 1 1 1 0m-2 4.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1m0 2h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1"/>
                            </svg>
                            <span class="align-middle">Patient</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.report') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                            </svg>
                            <span class="align-middle">Report</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="main">
            {{-- Yield --}}
            @yield('content')
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row text-muted">
                    <div class="col-8 text-start">
                    </div>
                    <div class="col-4 text-end">
                        <p class="mb-0">
                            &copy; 2024</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
