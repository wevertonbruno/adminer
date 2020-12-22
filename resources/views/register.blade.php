<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
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
        
        .socialite-icon{
            width: 15px;
            margin: 0 5px;
        }

        button{
            color: white !important;
        }

        hr{
            border-top: 1px solid rgba(255, 255, 255, 0.1);
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
            @endif
            <form id="form-login" action="{{ route('app.register.create') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nome Completo">
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                </div>
                <button type="submit" class="btn btn-primary w-100">Registrar</button>
                <hr>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('app.login') }}">Já possui uma conta? Faça login.</a>
                </div>
            </form>
        </section>
    </main>
    
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>