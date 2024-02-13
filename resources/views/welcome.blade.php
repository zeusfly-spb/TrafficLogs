<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TrafficLogs</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            .container {
                display: flex;
                justify-content: center;
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
                margin: 20px auto;
                border: 2px solid black;
                margin-right: .3em;
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
    </head>
    <body>
    <div class="container">
        <div class="position">
            <div class="traffic-light">
                <div class="light red"></div>
                <div class="light yellow"></div>
                <div class="light green"></div>
            </div>
            <button>Вперед</button>
        </div>
    </div>
    </body>
</html>
