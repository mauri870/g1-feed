<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Notícias</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h3>Atualizado pela última vez em {{ \Carbon\Carbon::parse($xml->channel->lastBuildDate)->format('d:m:Y H:m:s') }}</h3>
    @foreach($categories as $category=>$value)
        @if($actualCategory == $value)
            <a href="{{ route('home.category',$value) }}"><button class="btn btn-success"><span class="glyphicon glyphicon-zoom-in"></span> {{ $category }}</button></a>
        @else
            <a href="{{ route('home.category',$value) }}"><button class="btn btn-info"><span class="glyphicon glyphicon-zoom-in"></span> {{ $category }}</button></a>
        @endif
    @endforeach
    <br><br><br>
    @foreach($xml->channel->item as $item)
        <div class="well">
        <div class="media">
            <a class="pull-left" href="#">
            </a>
            <div class="media-body">
                <a target="_blank" href="{{ $item->link }}"><h4 class="media-heading">{{ $item->title }}</h4></a>
                <p class="text-right"><span class="label label-info">{{ $item->category }}</span></p>
                <p>{!! $item->description !!}</p>
                <ul class="list-inline list-unstyled">
                    <li><span><i class="glyphicon glyphicon-calendar"></i> {{ \Carbon\Carbon::parse($item->pubDate)->format('d:m:Y H:m:s') }}</span></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
</body>
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</html>