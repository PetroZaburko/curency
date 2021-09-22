@extends('main')
@section('content')
    <div class="message-info">
        @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::pull('error') }}</div>
        @endif
    </div>
    <table id="currency_table">
        <thead>
            <tr>
                <th data-sortable="true" data-field="_id">ID</th>
                <th data-sortable="true" data-field="name">Name</th>
                <th data-sortable="true" data-field="code">Country Code</th>
                <th data-sortable="true" data-field="rate">Rate</th>
                <th data-field="date">Date</th>
            </tr>
        </thead>
    </table>
@endsection
