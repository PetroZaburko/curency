@include('head')

<style type="text/css">
    @page {
        margin: 10px;
        }
    @font-face {
        font-family: 'dejavu-sans';
        src: url("{{ asset('/fonts/dejavu-sans.ttf') }}");
    }
    body {
        font-family: 'dejavu-sans';
    }
</style>

<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div>
                @lang('main.last_updated') {{': ' . $date }}
            </div>
            <table class="table table-sm">
                <thead class="thead-light">
                    <tr>
                        <th>@lang('main.iso_code')</th>
                        <th>@lang('main.name')</th>
                        <th>@lang('main.cur_code')</th>
                        <th>@lang('main.rate')</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($rates as $rate)
                    <tr>
                        <td>{{ $rate->iso_code }}</td>
                        <td>{{ $rate->name }}</td>
                        <td>{{ $rate->currency_code }}</td>
                        <td>{{ $rate->rate }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

