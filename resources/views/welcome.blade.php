<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TrafficLogs</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            .container {
                display: flex;
                flex-direction: column;
                align-items: center;
                height: 100vh;
            }
            .position {
                display: flex;
                flex-direction: row;
                align-items: center;
            }
            .traffic-light {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 200px;
                width: 100px;
                margin: 20px .3em;
                border: 2px solid black;
            }

            .light {
                height: 50px;
                width: 50px;
                border-radius: 50%;
                margin: 10px;
            }

            .red {
                background-color: red;
            }

            .yellow {
                background-color: yellow;
            }

            .green {
                background-color: green;
            }

        </style>
        @vite('resources/js/app.js')

    </head>
    <body>
    <div class="container">
        <div class="position">
            <div class="traffic-light">
                <div class="light red"></div>
                <div class="light yellow"></div>
                <div class="light green"></div>
            </div>
            <button id="forward">Вперед</button>
        </div>
        <table id="log_table"></table>
    </div>

    <script>
        /**
         * Запись логов в БД
         * @param message
         */
        function sendLog(message) {
            $.ajax({
                url: '/logs',
                type: 'POST',
                data: { message: message },
                success: function(response) {
                    $('#log_table').append('<tr><td>' + message + '</td></tr>');
                },
                error: function(xhr, status, error) {
                    console.error('Error adding log:', error);
                }
            });
        }
    </script>

    <script type="module">
        /**
         * Настройка отправки CSRF токена
         */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /**
         * Основной блок логики при загрузке страницы
         */
        $(document).ready(function() {
            const long_interval = 5000;
            const short_interval = 2000;
            const lights = ['green', 'yellow', 'red', 'yellow'];
            let currentIndex = 0;
            let timeout = long_interval;
            let action = setTimeout(switchLights, timeout);
            let message;

            /**
             * Переключение сигналов
             */
            function switchLights() {
                clearTimeout(action);
                $('.light').css('opacity', .1);
                $('.' + lights[currentIndex]).css('opacity', 1);
                timeout = [0, 2].includes(currentIndex) ? long_interval : short_interval;
                action = setTimeout(switchLights, timeout);
                currentIndex = (currentIndex + 1) % lights.length;
            }

            /**
             * Обработка нажатия на кнопку "Вперед"
             */
            $('#forward').click(function() {
                if (currentIndex - 1 === 2) {
                    message = 'Проезд на красный. Штраф!';
                } else if (currentIndex - 1 === 0) {
                    message = 'Проезд на зеленый!';
                } else if (currentIndex - 1 === 1) {
                    message = 'Успели на желтый!';
                } else {
                    message = 'Слишком рано начали движение!';
                }
                sendLog(message);
            });
        });
    </script>

    </body>
</html>
