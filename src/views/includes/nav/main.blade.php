<li{!! Miscellaneous::setCurrentOpenPage(['wineries-winery']) !!}>
    <a href="javascript:void(0)"><i class="fa fa-tint"></i>{{ trans('spas::pulsar.package_name') }}</a>
    <ul class="sub-menu">
        @if(session('userAcl')->allows('wineries-winery', 'access'))
            <li{!! Miscellaneous::setCurrentPage('wineries-winery') !!}><a href="{{ route('spa', [session('baseLang')->id_001]) }}"><i class="fa fa-tint"></i>{{ trans_choice('spas::pulsar.spa', 2) }}</a></li>
        @endif
    </ul>
</li>