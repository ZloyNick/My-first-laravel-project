@include('head')
<body>

<div class="jumbotron">
    <h1 class="display-3" align="center">Приветствуем Вас!</h1>
    <p class="lead" align="center">
        Добро пожаловать на сервис регистрации парковочных талонов.
        <br/>
        Здесь Вы можете легко и быстро зарегистрировать свой талон.
    </p>
    <hr class="my-4">
    <h1 align="center">Хотите <a href="#start" style="color: forestgreen">зарегистрировать талон?</a></h1>
</div>

<div class="form-group">

    <form action="/generate" id="register-form" onsubmit="check()" method="post">

        <!--Обязательный этап-->
        @csrf

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="userAcception">
            <!--Эту фичу надо самим доработать-->
            <label class="custom-control-label" for="userAcception">Я согласен принять пользовательское соглашение</label>
        </div>

        <button type="submit" class="btn btn-success" id="start">
            Зарегистрировать талон
        </button>

    </form>

</div>

<script>
    function check()
    {
        let box = document.getElementById("userAcception");
        if(!box.checked)
        {
            alert('Вы должны быть согласны с пользовательским соглашением!');
            event.preventDefault();
        }
    }
</script>

</body>
</html>
