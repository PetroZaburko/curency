@extends('main')
@section('content')
    <div class="text-center">
        <h4>
            @lang('main.your_keys')
        </h4>
    </div>
    <div>
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col">@lang('main.name')</th>
                    <th scope="col">@lang('main.progress')</th>
                    <th scope="col">@lang('main.usage')</th>
                    <th scope="col">@lang('main.created')</th>
                    <th scope="col">@lang('main.last_used')</th>
                    <th scope="col">@lang('main.actions')</th>
                </tr>
            </thead>
            <tbody>
            @foreach($tokens as $token)
                <tr>
                    <td>{{$token->name}}</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: {{ $token->usage * 100 / $token->tariff->requests }}%" aria-valuenow="{{ $token->usage }}" aria-valuemin="0" aria-valuemax="{{ $token->tariff->requests }}"></div>
                        </div>
                    </td>
                    <td>{{$token->usage . ' - ' . $token->tariff->requests}}</td>
                    <td>{{$token->created}}</td>
                    <td>{{$token->last_used}}</td>
                    <td>
                        <button type="button" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <button type="button" class="btn btn-primary" onclick="location.href = '{{route('regenerate', $token->id)}}';">
                            <i class="fas fa-sync"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
