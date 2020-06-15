<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Регистрация парковочного места</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.0/cosmo/bootstrap.min.css" type="text/css">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <p class="navbar-brand" href="#head" id="head">Parking Service</p>
    </nav>

</head>
<body>



<div class="jumbotron">
    <h1 class="display-3" align="center">Мы рады, что Вы воспользовались нашим сервисом!</h1>
    <p class="lead" align="center">
        Вы зарегистрировали талон с UUID <p align="center" style="background-color: whitesmoke; color: green">{{ $_COOKIE['uuid'] }}</p>
        <br/>
            <a href="/quit"><button type="button" class="btn btn-danger" style="position: center">Завершить парковку</button></a>
        <br/>
        <p align="center">
            Обращаем Ваше внимание, что по истечении одного часа, за каждую минуту простоя Вам начисляется штраф в размере 15 рублей.
            <br/>
            <?php

            $time = intval($_COOKIE['uuid-time']);
            $timeDiff = time()-$time;
            $minutes = $timeDiff / 60;
            printf("Текущий штраф: %s рублей.<br>У Вас осталось %s минут%s", $timeDiff < 0 ? 0 : abs($minutes) * 15, $timeDiff < 0 ? abs(intval($minutes)) : 0,
                ($diff = $minutes % 10) < 5 ? "" : ($minutes == 1 ? "а" : "ы")
            );
            ?>
        </p>
        <br/>
    </p>
    <hr class="my-4">
    <p style="text-align: center">Ваш QR-Код:
    <br/>
    <img
        src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{$_COOKIE['uuid']}}"
        width="256px"
        height="256px"
        title="QR код"
    >
    </p>
</div>
</body>
</html>
