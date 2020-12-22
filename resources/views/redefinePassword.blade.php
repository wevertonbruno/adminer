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
            @if ($errors->all())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
            @elseif (Session::has('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form id="form" action="{{ route('password.request') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <p class="text-center">Redefinir senha</p>
                    <input type="email" class="form-control mb-3" id="email" name="email" placeholder="E-mail" value="">
                    <input type="password" name="password" id="pwd" class="form-control mb-3" placeholder="Senha">
                    <input type="password" name="password_confirmation" id="pwdcfm" class="form-control " placeholder="Senha de confirmação">
                    <input type="hidden" name="token" value="{{ $token }}">
                </div>
                <button type="submit" class="btn btn-primary w-100">Enviar</button>
                <hr>
            </form>
        </section>
    </main>
    
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>