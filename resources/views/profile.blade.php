@extends('main')
@section('content')
    <div class="text-center">
        <h4>
            @lang('main.settings')
        </h4>
    </div>
    <div class="col-4 ml-5">
        <div class="list-group ">
            <button type="button" class="list-group-item list-group-item-action">
                <i class="fas fa-user-edit"></i>
                @lang('main.ch_info')
            </button>
            <button type="button" class="list-group-item list-group-item-action">
                <i class="fas fa-lock"></i>
                @lang('main.ch_password')
            </button>
            <button type="button" class="list-group-item list-group-item-action" onclick="location.href = '{{route('locale.show')}}';">
                <i class="fas fa-globe"></i>
                @lang('main.ch_language')
            </button>
            <button type="button" class="list-group-item list-group-item-action" onclick="location.href = '{{route('pdf')}}';">
                <i class="fas fa-file-pdf"></i>
                @lang('main.convert_pdf')
            </button>
            <button type="button" class="list-group-item list-group-item-action" onclick="location.href = '{{route('xlsx')}}';">
                <i class="fas fa-file-excel"></i>
                @lang('main.convert_xlsx')
            </button>
            <button type="button" class="list-group-item list-group-item-action" onclick="location.href = '{{route('tokens')}}';">
                <i class="fas fa-key"></i>
                @lang('main.api_key')
            </button>
        </div>
    </div>
@endsection
