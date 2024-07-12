<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple Laravel 11 CRUD Application Tutorial</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrapicons@1.11.1/font/bootstrap-icons.css">
    <style>
        body{
            height: 100vh;
            width: 100vw;
            margin,padding: 0;
            overflow-x:hidden;
        }
        @if (Auth::check())
            body{
                background: #fafafa;
            }
        @endif
        textarea{
            border-radius: 10px;
            background-color: #fff;
            border: 0;
        }
        .comment{
            background-color: #fafafa;
            border: 1px solid rgba(0,0,0,.12);
            padding:10px 15px;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .comment p{
            margin-bottom: 5px;
        }
    </style>
</head>


<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col text-end">
                <div class="fs-6 d-flex flex-col justify-content-end">
                    @if (Auth::check())
                        <h5 class="m-0 align-self-center">Good Day, {{Auth::user()->name}}</h5>
                        @include('slugs.logout')
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                @if(!Auth::check())
                    @yield('auth-content')
                @else
                    @yield('page-content')
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bu
ndle.min.js"></script>
</body>

</html>