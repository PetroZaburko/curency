$(function () {

    $('#currency_table').bootstrapTable({
        data: JSON.parse(rates),
        pagination: true,
        search: true,
        pageList: [10, 15, 30, 50, 'All'],
        pageSize: '10',
        classes: "table table-hover",
        theadClasses: 'thead-light',
        sortable: true,
        sortClass: 'table-active',
        paginationHAlign: 'left',
        paginationDetailHAlign: 'right'
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        cache: false,
        dataType: 'json'
    });

    $('#logout').click(function () {
        $('#modalLongTitle').html('Exit system !!!');
        $('#modalBodyHeader').html('Do you really want to Logout? Are you sure?');
        $('#deleteConfirmButton').unbind("click");
        $('#deleteConfirmButton').click( function () {
            logOutSystem();
            return false;
        });
    });

    function logOutSystem() {
        $.ajax({
            type: 'POST',
            url: logout,
            success: function (response) {
                $('#logoutModalWindow').modal('hide');
                if(response.status === 200) {
                    location.reload();
                }
            },
            error: function (response) {
                $('#logoutModalWindow').modal('hide');
                if(response.status === 200) {
                    location.reload();
                }
                // console.log(response);
            }

        })
    }



});

