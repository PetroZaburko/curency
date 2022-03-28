@extends('main')
@section('content')
    <div class="text-center">
        <h4>
            All Settings
        </h4>
    </div>
    <div class="col-4 ml-5">
        <div class="list-group ">
            <button type="button" class="list-group-item list-group-item-action">
                <i class="fas fa-user-edit"></i>
                Change info
            </button>
            <button type="button" class="list-group-item list-group-item-action">
                <i class="fas fa-lock"></i>
                Change password
            </button>
            <button type="button" class="list-group-item list-group-item-action" onclick="location.href = '{{route('pdf')}}';">
                <i class="fas fa-file-pdf"></i>
                Convert to PDF
            </button>
            <button type="button" class="list-group-item list-group-item-action" onclick="location.href = '{{route('tokens')}}';">
                <i class="fas fa-key"></i>
                Api key
            </button>
        </div>
    </div>
@endsection
