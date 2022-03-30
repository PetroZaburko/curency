@extends('main')
@section('content')


    <script>
        let rates = '{!! $rates !!}';
        let locale = '@lang('main.locale')';
    </script>
    <script src="{{ asset('js/currency.js') }}"></script>

    <div>
        @lang('main.last_updated') {{': ' . $date }}
    </div>
    <table id="currency_table">
        <thead>
            <tr>
                <th data-sortable="true" data-field="iso_code">@lang('main.iso_code')</th>
                <th data-sortable="true" data-field="name">@lang('main.name')</th>
                <th data-sortable="true" data-field="currency_code">@lang('main.cur_code')</th>
                <th data-sortable="true" data-field="rate">@lang('main.rate')</th>
{{--                <th data-field="date">Date</th>--}}
            </tr>
        </thead>
    </table>
@endsection
