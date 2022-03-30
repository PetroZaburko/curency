@extends('main')
@section('content')
    <div class="text-center">
        <h4>
            @lang('main.ch_language')
        </h4>
        <div class="col-4">
            <form action="{{route('locale.auth.save')}}" method="post">
                @csrf
                <div class="from-group">
                    <div class="input-group">
                        <select class="form-control" name="locale">
                            @foreach($languages as $key => $value)
                                <option value="{{ $key }}" {{ auth()->user()->locale == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">
                                @lang('main.save')
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @endsection
