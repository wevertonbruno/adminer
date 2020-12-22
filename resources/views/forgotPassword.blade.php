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
            <form id="form" action="{{ route('app.forgotpassword.do') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <p>Forneça o nome de usuário ou o endereço de email usados ao inscrever-se.</p>
                    <p>Enviaremos um email que permitirá que você redefina a sua senha.</p>
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="">
                </div>
                <button type="submit" class="btn btn-primary w-100">Enviar</button>
                <hr>
                <div class="d-flex justify-content-around">
                    <a href="{{ route('app.login') }}">Login</a>
                    <a href="{{ route('app.register') }}">Registre-se</a>
                </div>
            </form>
        </section>
    </main>
    
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>