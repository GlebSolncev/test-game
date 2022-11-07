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
    <div class="row"><p>Balance: <b id="balance">{{ $link->games->sum('bonus') / 100 }}</b></p></div>
    <div class="col-md-3">
        <button id="history">History</button>
        <div class="history-data"></div>
    </div>
    <div class="col-md-6">
        <form action="{{ route('profile.new-link', [$slug]) }}">
            <input type="submit" value="New link">
        </form>
        <div class="links">
            <ul>
            @foreach($links as $mlink)
                <li>
                    <div class="col-md-4"><a href="{{ route('profile.detail', [$mlink->slug]) }}">{{ $mlink->id }} ) {{ $mlink->slug }} </a></div>
                    <div class="col-md-4">Balance: {{ $mlink->games->sum('bonus')/100 }}</div>
                    <div class="col-md-4">
                         | <a href="{{ route('profile.delete', [$mlink->slug]) }}">
                            Deactivate
                        </a>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
    <div class="col-md-3">
        <button id="play">Im feeling lucky</button>
        <div class="game-data"></div>
    </div>
</div>

<script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script>
    $(document).ready(function(){
      $("button#history").click(function(){
        $.get("{{ route('api.v1.game.history', $slug) }}", function(data, status){
            $(".history-data").html("");
            for (i = 0; i < data.length; ++i) {
                $(".history-data").append("<p>"+data[i].type+" Number: "+data[i].number+" Points: "+(data[i].bonus/100)+"</p>");
            }
        });
      });

      $("button#play").click(function(){
        $.post("{{ route('api.v1.game.play', $slug) }}", function(data, status){
            $(".game-data").html("");
            $(".game-data").html("<p>"+data.type+" - "+data.number+" - "+(data.bonus/data.number)+"% Bonus: "+data.bonus/100+"</p>");
            $("#balance").text(data.balance/100)
        });
      });
});

</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!-- Button trigger modal -->
</body>


</html>