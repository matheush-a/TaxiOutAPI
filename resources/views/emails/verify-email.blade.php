@extends('emails.template')

@section('title', "Olá, {$user['name']}!")

@section('content')
    <p style="display:flex; justify-content:center; flex-wrap:wrap;">
    <pre style="width:100%">
        Você está recebendo esta mensagem porque houve um cadastro, com o seu e-mail, na plataforma do TaxiOut.
        Caso não tenha sido você apenas ignore.
        Caso tenha sido e queira validar o seu email, clique no link abaixo:
    </pre>
    <section style="width:100%; display:flex; justify-content:center; flex-wrap:wrap; margin-top:10px;">
        <a href="{{$link}}" style="background-color:#f37350; border-radius:6px; color:#fff; display:block; font-weight:700; padding:15px 60px; text-decoration:none; width:40%; text-align:center;">
            Validar meu e-mail
        </a>
    </section>
    </p>
@endsection