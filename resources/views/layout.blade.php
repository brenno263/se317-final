<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SE 317 Final</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #2d3748;
        }
    </style>
</head>
<body class="antialiased bg-dark">
@include('navbar')
<div class="bg-light container p-3 border-top border-bottom border-primary border-5 ">
    @yield('content')
</div>
<div class="container p-3 bg-secondary" style="position: relative" id="footer">
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci alias commodi consequatur cupiditate deserunt est exercitationem explicabo magni minus, nam numquam officia quae quam quo ratione recusandae repudiandae veritatis!</p>
    <script>
        window.onload = () => {
            //This adds a rounded bottom to the footer IF it's not pressed up against the bottom of the window.
            let footer = document.getElementById('footer');
            let setBottom = () => {
                let docHeight = document.body.scrollHeight;
                let windowHeight = window.innerHeight;
                if (docHeight < windowHeight) {
                    footer.classList.add('rounded-bottom');
                } else {
                    footer.classList.remove('rounded-bottom');
                }
            }
            setBottom()
            window.onresize = setBottom;
        }
    </script>
</div>
</body>
</html>
