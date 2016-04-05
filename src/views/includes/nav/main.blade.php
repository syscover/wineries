<li{!! Miscellaneous::setCurrentOpenPage(['wineries-winery']) !!}>
    <a href="javascript:void(0)"><i class="fa fa-glass"></i>{{ trans('wineries::pulsar.package_name') }}</a>
    <ul class="sub-menu">
        @if(session('userAcl')->allows('wineries-winery', 'access'))
            <li{!! Miscellaneous::setCurrentPage('wineries-winery') !!}><a href="{{ route('winery', [session('baseLang')->id_001]) }}"><i class="fa fa-glass"></i>{{ trans_choice('wineries::pulsar.winery', 2) }}</a></li>
        @endif
    </ul>
</li>