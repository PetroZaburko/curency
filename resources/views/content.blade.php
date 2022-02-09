@extends('main')
@section('content')


    <script>
        let rates = '{!! $rates !!}';
        let logout = '{!! route('logout')!!}';
    </script>
    <script src="{{ asset('js/currency.js') }}"></script>

{{--    <div class="message-info">--}}
{{--        @if (Session::has('error'))--}}
{{--            <div class="alert alert-danger">{{ Session::pull('error') }}</div>--}}
{{--        @endif--}}
{{--    </div>--}}

{{--    @include('header')--}}
    <div>
        {{' Last updated at:  ' . $date }}
    </div>
    <table id="currency_table">
        <thead>
            <tr>
                <th data-sortable="true" data-field="code">ISO code</th>
                <th data-sortable="true" data-field="name">Name</th>
                <th data-sortable="true" data-field="currency">Currency Code</th>
                <th data-sortable="true" data-field="rate">Rate</th>
{{--                <th data-field="date">Date</th>--}}
            </tr>
        </thead>
    </table>
@endsection
