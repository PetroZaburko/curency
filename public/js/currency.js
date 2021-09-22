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
});
