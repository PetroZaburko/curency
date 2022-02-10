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
                    No
                </button>
                <button id="deleteConfirmButton" type="button" class="btn btn-danger ">
                    <i class="fas fa-check"></i>
                    Yes
                </button>
            </div>
        </div>
    </div>
</div>


<header class="row my-2">
    <div class="col-2">
        <div class="authUser">
            Hello,
            <span id="authUserName" class="font-weight-bold">
                @guest()
                    Guest
                @else
                    {{Auth::user()->name}}
                @endguest
            </span>
        </div>
    </div>
    <div class="col-7">
        <div class="message-info">
            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::pull('error') }}</div>
            @endif
        </div>
    </div>
    <div class="col-3">
        <div class="float-right">
            @guest()
                <button type="button" class="btn btn-light" onclick="location.href = '{{route('login')}}';">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </button>
                <button type="button" class="btn btn-light" onclick="location.href = '{{route('register')}}';">
                    <i class="fas fa-user-plus"></i>
                    Register
                </button>
            @else
                <button id="logout" type="button" class="btn btn-light " data-toggle="modal" data-target="#logoutModalWindow">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
                <button type="button" class="btn btn-light" onclick="location.href = '{{route('profile')}}';">
                    <i class="fas fa-user-cog"></i>
                    Profile
                </button>
            @endguest
        </div>
    </div>
</header>
