@extends('emails.template')

@section('title', "Olá, {$user['name']}!")

@section('content')
    <pre style="max-width:100%;">
        Você está recebendo esta mensagem pois houve um cadastro, com o seu e-mail, na plataforma do TaxiOut. 
        Caso não tenha sido você, apenas ignore. Caso queira validar o seu email, clique no botão abaixo:
    </pre>
    <div style="max-width:100%; align-items:center; justify-content:center; margin-top:10px; align-items:center; text-align:center">
        <a href="{{$link}}" style="background-color:#f37350; border-radius:6px; color:#fff; display:inline-block; font-weight:700; padding:15px 60px; text-decoration:none; width:40%; text-align:center;">
            Validar meu e-mail
        </a>
    </div>
@endsection