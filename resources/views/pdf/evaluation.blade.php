<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                {{ $data->company->name }} <br>
                {{ $data->company->location }} <br>
                {{ $data->company->email }} <br>
                {{ $data->company->contact }} <br>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
</body>
</html>