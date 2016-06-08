@extends('pulsar::layouts.index', ['newTrans' => 'new'])

@section('head')
    @parent
    <!-- wineries::winery.index -->
    <script>
        $(document).ready(function() {
            if ($.fn.dataTable)
            {
                $('.datatable-pulsar').dataTable({
                    "displayStart": {{ $offset }},
                    "columnDefs": [
                        { "sortable": false, "targets": [6,7]},
                        { "class": "checkbox-column", "targets": [6]},
                        { "class": "align-center", "targets": [5,7]}
                    ],
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "{{ route('jsonData' . ucfirst($routeSuffix), [session('baseLang')->id_001]) }}",
                        "type": "POST",
                        "headers": {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    }
                }).fnSetFilteringDelay();
            }
        });
    </script>
    <!-- /.wineries::winery.index -->
@stop

@section('tHead')
    <!-- wineries::winery.index -->
    <tr>
        <th data-hide="phone,tablet">ID.</th>
        <th data-hide="phone,tablet">{{ trans_choice('pulsar::pulsar.language', 1) }}</th>
        <th data-hide="phone,tablet">{{ trans_choice('pulsar::pulsar.country', 1) }}</th>
        <th data-hide="phone,tablet">{{ trans_choice('pulsar::pulsar.territorial_area', 1) }}</th>
        <th data-class="expand">{{ trans_choice('wineries::pulsar.winery', 1) }}</th>
        <th>{{ trans_choice('pulsar::pulsar.active', 1) }}</th>
        <th class="checkbox-column"><input type="checkbox" class="uniform"></th>
        <th>{{ trans_choice('pulsar::pulsar.action', 2) }}</th>
    </tr>
    <!-- /.wineries::winery.index -->
@stop