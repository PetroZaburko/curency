@include('head')

<style>
    @page{margin: 10px;}
</style>

<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div>
                {{' Last updated at:  ' . $date }}
            </div>
            <table class="table table-sm">
                <thead class="thead-light">
                    <tr>
                        <th>ISO code</th>
                        <th>Name</th>
                        <th>Currency Code</th>
                        <th>Rate</th>
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

