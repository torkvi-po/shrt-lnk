<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Shrt-Lnk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="form-row">
            <div class="col">
                <input type="text" class="form-control" id="url" aria-describedby="urlHelp" placeholder="Введите адрес страницы">
                <small id="urlHelp" class="form-text text-muted">Введите полный адрес страницы, который вы хотите уменьшить</small>
            </div>
            <div class="col">
                <button id="make" class="btn btn-primary">Сократить</button>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col">
        <div class="row justify-content-center">
            <h2>Последние добавленные адреса:</h2>
        </div>
        <div class="row justify-content-center">
            <div id="result" style="height: 300px;">
                @include('results')
            </div>
        </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="form-row">
            <div class="col">
                <input type="number" class="form-control" id="number" aria-describedby="numberHelp" placeholder="Кол-во" value="1" min="1" max="255">
                <small id="urlHelp" class="form-text text-muted">Для проверки введите количество генерируемых адресов от 1 до 255</small>
            </div>
            <div class="col">
                <button id="generate" class="btn btn-primary">Сгенерировать для проверки</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#make').click(function() {
            let url = $('#url').val();
            if (url) {
                $.ajax({
                    url: '/~make',
                    method: 'POST',
                    data: {url: url},
                    success: function (response) {
                        $('#result').html(response);
                    },
                    error: function (error) {
                        alert('Ошибка адреса!');
                        $('#url').focus();
                    }
                });
            } else {
                alert('Введите адрес страницы, которую надо сократить!');
                $('#url').focus();
            }
        });

        $('#generate').click(function() {
            let number = $('#number').val();
            if(number && number<=255) {
                $.ajax({
                    url: '/~generate',
                    method: 'POST',
                    data: {number:number},
                    success: function(response) {
                        $('#result').html(response);
                    },
                    error: function(error) {
                        alert('Неправильное число!');
                        $('#number').focus();
                    }
                });
            } else {
                alert('Введите количество от 1 до 255!');
                $('#number').focus();
            }
        })

    });
</script>

</body>
</html>
