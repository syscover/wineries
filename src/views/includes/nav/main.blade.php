<li{!! is_current_resource(['wineries-winery']) !!}>
    <a href="javascript:void(0)"><i class="fa fa-glass"></i>{{ trans('wineries::pulsar.package_name') }}</a>
    <ul class="sub-menu">
        @if(is_allowed('wineries-winery', 'access'))
            <li{!! is_current_resource('wineries-winery') !!}><a href="{{ route('winery', [base_lang2()->id_001]) }}"><i class="fa fa-glass"></i>{{ trans_choice('wineries::pulsar.winery', 2) }}</a></li>
        @endif
    </ul>
</li>