<div class="row my-3">
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                {{ $banner1Title }}
            </div>
            <div class="card-body">
                <ul>
                    @foreach($banner1Links as $link)
                    <li>
                        <a href="{{ route($link['url']) }}">{{ $link['title'] }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 mt-3 mt-md-0">
        <div class="card">
            <div class="card-header">
                {{ $banner2Title }}
            </div>
            <div class="card-body">
                <ul>
                    @foreach($banner2Links as $link)
                    <li>
                        <a href="{{ route($link['url']) }}">{{ $link['title'] }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>