<!DOCTYPE html>
<html lang="pt-BR">
<body>
    <section style="max-width:60%; text-align:center;">
        <div style="margin:10px auto; max-width:520px; justify-content:center; flex-wrap:wrap;">
            <img scr="https://i.imgur.com/heBEPdY.png" srcset="./images/origin-markup.svg" alt="Taxi Out Logo" style="height:40px; width:40px;">
        </div>
        <div style="box-shadow:0 0 6px #5559; line-height:1.5; padding:30px; flex-wrap:wrap;">
            <h1 style="font-size:26px; font-weight:500; margin: 0 0 5px; color:#f37350; display:block; width:100%;">@yield('title')</h1>
            <div style="margin-top:5px; width:100%; align-items:center">
                @yield('content')
            </div>
        </div>
    </section>
</body>
</html>