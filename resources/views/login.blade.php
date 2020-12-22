<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
            color: white;
        }

        html, body {
            height: 100%;
        }
        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        a.btn{
            color: white !important;
        }

        hr{
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .socialite-icon{
            width: 15px;
            margin: 0 5px;
        }

    </style>
</head>
<body class="bg-dark">
    <main class="form-signin">
        <section>
            <div class="socialite-buttons d-flex justify-content-between mb-3">
                <a href="{{ route('app.social.login', ['provider' => 'facebook']) }}" class="btn btn-outline-secondary">
                    <span style="display: flex; justify-content: center;"><img class="socialite-icon" src="{{ asset('images/facebook.svg') }}" alt=""> Facebook Login</span>
                </a>
                <a href="{{ route('app.social.login', ['provider' => 'google']) }}" class="btn btn-outline-secondary">
                    <span style="display: flex; justify-content: center;"><img class="socialite-icon" src="{{ asset('images/search.svg') }}" alt=""> Google Login</span>
                </a>
            </div>
            @if ($errors->all())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
            @elseif (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form id="form-login" action="{{ route('app.login.authenticate') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="oieusouweverton@hotmail.com" {{-- Only test --}}>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <hr>
                <div class="d-flex justify-content-around">
                    <a href="{{ route('app.forgotpassword') }}">Esqueceu a senha?</a>
                    <a href="{{ route('app.register') }}">Registre-se</a>
                </div>
            </form>
        </section>
    </main>
    
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>