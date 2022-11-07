<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-theme.css" rel="stylesheet">

</head>
<body>
<div class="container">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <form method="POST" action="{{ route('profile.register') }}">
        <div class="form-group">
            <label for="username">UserName</label>
            <input type="text" class="form-control" id="username" placeholder="Your username" name="username">
            <small id="username" class="form-text text-muted">Unqiue username</small>
        </div>
        <div class="form-group">
            <label for="phone-number">Phone Number</label>
            <input type="number" class="form-control" id="phone-number" placeholder="Your phone number" name="phone">
            <small id="phone" class="form-text text-muted">Unqiue phone</small>
        </div>
        @csrf
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissable margin5">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Errors:</strong> Please check below for errors
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="col-md-3"></div>
</div>

<script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!-- Button trigger modal -->
</body>


</html>