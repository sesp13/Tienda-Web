<?php
/*
    Banners verticales, deben de estar encapsulados por una columna 
    para su correcto funcionamiento
    Se necesita
    TITULOS
    $banner1TitleV
    $banner2TitleV
    CONTENIDO
    $banner1VLinks
    $banner2VLinks
*/
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                {{ $banner1TitleV }}
            </div>
            <div class="card-body">
                <ul>
                    @foreach($banner1VLinks as $link)
                    <li>
                        <a href="{{ route($link['url']) }}">{{ $link['title'] }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                {{ $banner2TitleV }}
            </div>
            <div class="card-body">
                <ul>
                    @foreach($banner2VLinks as $link)
                    <li>
                        <a href="{{ route($link['url']) }}">{{ $link['title'] }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>