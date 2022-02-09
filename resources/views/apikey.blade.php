@extends('main')
@section('content')
    <div class="text-center">
        <h4>
            Your api keys
        </h4>
    </div>
    <div>
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Key</th>
                    <th scope="col">Usage</th>
                    <th scope="col">Created</th>
                    <th scope="col">Last used</th>
                    <th scope="col">Deactive</th>
                </tr>
            </thead>
            <tbody>
            @foreach($tokens as $token)
                <tr>
                    <td>{{$token->name}}</td>
                    <td>{{$token->token}}</td>
                    <td>{{$token->usage . ' - ' . $token->tariff->requests}}</td>
                    <td>{{$token->createdFormat()}}</td>
                    <td>{{$token->lastUsedFormat()}}</td>
                    <td>
                        <button type="button" class="btn btn-danger">
                            <i class="fas fa-minus-circle"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
