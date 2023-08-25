<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>FathScooter Management</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('img/fath_2.png') }}" type="image/x-icon" />
    <!-- Fonts and icons -->
    <script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.60/inputmask/jquery.inputmask.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{ asset('dist/fonts.min.css') }}']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <style>
        .h2{
            color:black !important;
        }

        .create{
            background-color:white;
            border-radius:5px;
            padding:5px;
        }

        .btn-primary{
            color: white !important;
        }
    </style>
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('dist/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/atlantis.min.css') }}">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('dist/demo.css') }}">
</head>
