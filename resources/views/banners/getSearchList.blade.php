@if(count($banners)>0)
    @foreach($banners->chunk(4) as $ban)
        <div class="row">
            @foreach($ban as $banner)
                <div class="col-sm-3 col-xs-6 gallery-image">
                    <a href="{{ route('banners.showbanner',[$banner->city,$banner->id,str_replace(' ','-',$banner->title)]) }}">
                        <div class="card card-profile">
                            <div class="card-image">
                                <img class="img"
                                     src="/@if(count($banner->photos)>0){{ $banner->photos->first()->thumbnail_path }}@endif">
                            </div>

                            <div class="content">
                                <div class="row">
                                    <h4 class="card-title">{{$banner->title}}</h4>
                                    <hr>
                                </div>
                                <div class="row">
                                    <span class="fa fa-clock-o"></span>&nbsp; {{  $banner->created_at->diffForHumans() }}
                                    | <span class="fa fa-map-marker"></span> &nbsp;{{ $banner->city }}
                                </div>
                                <div class="row">
                                    <span class="fa fa-money"></span>&nbsp;{{ \App\Banner::getPrice($banner) }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endforeach
@else
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body" align="center">
                    متاسفانه آگهی با عنوان <b> {{ $search }} </b> یافت نشد!
                </div>
            </div>
        </div>
    </div>
@endif
