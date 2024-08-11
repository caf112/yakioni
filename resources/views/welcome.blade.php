<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>焼きおに</title>
        <!-- Styles -->
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-color: #f7fafc; /* Light gray background */
            }

            .content {
                text-align: center;
                font-size: 5em; /* Larger font size */
                color: #333; /* Dark text color */
            }

            .button {
                background-color: #F5DEB3; /* Green */
                border: none;
                color: black;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
                border-radius: 4px;
            }

            .image {
                max-width: 100%; /* Ensure the image is responsive */
                height: auto;
                width: 700px; /* Set a specific width for the image */
                border-radius: 10px; /* Rounded corners for the image */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add a slight shadow */
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-c min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <img src="/yakioni.png" alt="Description of image" class="image">
            @if (Route::has('login'))
                <div class="content"> <!-- Move .content class here -->
                    @auth
                        <a href="{{ url('/home') }}" class="button">ホーム</a>
                    @else
                        <a href="{{ route('login') }}" class="button">ログイン</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="button">会員登録</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </body>
</html>
