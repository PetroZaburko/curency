<div class="modal fade" id="logoutModalWindow" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-message-info">
            </div>
            <div class="modal-body" id="modalBodyHeader">
            </div>
            <div class="modal-footer">
                <button id="deleteCancelButton" type="button" class="btn btn-primary" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                    @lang('header.no')
                </button>
                <button id="deleteConfirmButton" type="button" class="btn btn-danger ">
                    <i class="fas fa-check"></i>
                    @lang('header.yes')
                </button>
            </div>
        </div>
    </div>
</div>


<header class="row my-2">
    <div class="col-2">
        <div class="authUser">
            @lang('header.hello'),
            <span id="authUserName" class="font-weight-bold">
                @guest()
                    @lang('header.guest')
                @else
                    {{Auth::user()->name}}
                @endguest
            </span>
        </div>
    </div>
    <div class="col-6">
        <div class="message-info">
            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::pull('error') }}</div>
            @elseif(Session::has('success'))
                <div class="alert alert-success">{{ Session::pull('success') }}</div>
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="float-right">
            @guest()
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-globe"></i>
                        @lang('header.language')
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach(config('languages') as $key => $value)
                            <a class="dropdown-item" href="{{ route('locale.guest.save', ['locale' => $key]) }}">{{ $value }}</a>
                        @endforeach
                    </div>
                </div>
                <button type="button" class="btn btn-light" onclick="location.href = '{{route('login')}}';">
                    <i class="fas fa-sign-in-alt"></i>
                    @lang('auth.login')
                </button>
                <button type="button" class="btn btn-light" onclick="location.href = '{{route('register')}}';">
                    <i class="fas fa-user-plus"></i>
                    @lang('auth.register')
                </button>
            @else
                <button id="logout" type="button" class="btn btn-light " data-toggle="modal" data-target="#logoutModalWindow">
                    <i class="fas fa-sign-out-alt"></i>
                    @lang('auth.logout')
                </button>
                <button type="button" class="btn btn-light" onclick="location.href = '{{route('profile')}}';">
                    <i class="fas fa-user-cog"></i>
                    @lang('header.profile')
                </button>
            @endguest
        </div>
    </div>
</header>
