let heightScrollDatatable =  $(window).height() - $('.topbar').outerHeight(true) - $('thead').outerHeight(true) - $('.dataTables_paginate.paging_simple_numbers').parents('.row').outerHeight(true) - 155;
$(function () {
    $(document).on('click', '.btn-filter-data-table', function () {
        $(this).parent().find('.list-filter-column-select').toggleClass('d-none');
    })

    $(document).on('click', '.filter-column-select-item', function (e) {
        e.preventDefault();
        let column = table.column($(this).attr('data-cv-idx'));
        column.visible(!column.visible());
        $(this).find('input').prop('checked', !$(this).find('input').is(':checked'));
    });

    $(document).on('mouseover', '.new-table-row-group tbody td', function () {
        $('.active-row-focus').removeClass('active-row-focus');
        let x = $(this).parents('tr').index();
        for (let i = x; i >= 0; i--) {
            if ($(this).parents('tbody tr:eq(' + i + ')').find('td').hasClass('d-none')) {
                $(this).parents('tr').addClass('active-row-focus');
                break;
            }
        }
    });
})

async function renderOptionFilterDatatable(id, table) {
    let option = '';
    await id.find('thead tr:first th').each(function (e, i) {
        let check = (table.columns(e).visible()) ? 'checked' : '';
        if ($(this).text() != '') {
            option += `<li class="filter-column-select-item" data-cv-idx="${e}">
                            <div class="checkbox-zoom zoom-primary p-1 m-0 ">
                                <label>
                                    <input type="checkbox" value="" ${check} name="check-visible">
                                    <span class="cr">
                                        <i class="cr-icon fa fa-check txt-primary"></i>
                                    </span>
                                    <span>${$(this).text()}</span>
                                </label>
                            </div>
                        </li>`;
        }
    })
    return option;
}

async function renderToolBarDatatable(data) {
    let toolbar = '';
    for await(const v of data) {
        toolbar += `<label class="mb-1 mr-1 d-flex align-items-center ${v.class}"><button type="button" onclick="${v.function}()" class="btn-tool-data-table "><i class='${v.icon}'></i></button><span class="mr-1" style="margin-bottom: 3px !important;">${v.title}</span></label>`;
    }
    return toolbar;
}

async function DatatableTemplate(id, data_table, column, scroll_Y, fixed_left, fixed_right, option = []) {
    let length = parseInt($('#data-table-length').val());
    let table = await id.DataTable({
        destroy: true,
        responsive: false,
        processing: true,
        language: {
            emptyTable: `<div class='empty-datatable-custom' style="background-color: #fff !important; text-align: center">
                           <img style="width: 200px" src='../images/img.png'>
                         </div>`,
            search: "",
            searchPlaceholder: "Tìm kiếm",
            lengthMenu: " _MENU_ ",
            paginate: {
                "first": '<em class="fa fa-angle-double-right"></em>',
                "last": '<em class="fa fa-angle-double-left"></em>',
                "next": '<em class="fa fa-angle-right"></em>',
                "previous": '<em class="fa fa-angle-left"></em>'
            },
            info: " trong tổng số _TOTAL_",
            infoEmpty: " trong tổng số _TOTAL_",
            zeroRecords: `<div class='empty-datatable-custom' style="background-color: #fff !important;">
                                    <img style="width: 200px" src="../images/img.png">
                                 </div>`,
            infoFiltered: "",

        },
        serverSide: false,
        ordering: false,
        data: data_table,
        columns: column,
        scrollY: scroll_Y,
        scrollX: true,
        scrollXInner: "100%",
        autoWidth: true,
        scrollCollapse: true,
        pageLength: 50,
        lengthMenu: [
            [50, 100],
            [50 ,100]
        ],
        buttons : [],
        fixedColumns: {
            leftColumns: fixed_left,
            rightColumns: fixed_right,
        },
        dom: "<'row'<'pl-0 col-sm-1 col-md-2 col-lg-3 d-flex justify-content-start'f<'p-0 m-0'B>><'col-sm-11 col-md-10 col-lg-9 d-flex justify-content-end pr-0'<'toolbar-button-datatable'>>>" +
            "<'row'<'col-12 px-0'tr>>" +
            "<'row'<'mt-3 p-0 d-flex col-4'l<'p-0'>i><'col-8 px-0'p>>",
        drawCallback: async function () {
            $("#" + id.attr('id') + "_wrapper .toolbar-button-datatable").html(await renderToolBarDatatable(option));
            if(id.find('img').length > 0){
                id.find('img').Lazy();
            }
            $('#' + id.attr('id') + '_wrapper').parent().find('.select-filter-dataTable').attr('style', 'display:flex !important ; right: ' + ($('#' + id.attr('id') + '_wrapper .toolbar-button-datatable').width() + 24) + 'px !important');
            let api = this.api();
            api.columns.adjust();
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                container: 'body',
                html: true
            });
        },
        "initComplete": async function render() {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                container: 'body',
                html: true
            });
        },
    });
    id.on('draw.dt', function () {
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover',
            container: 'body',
            html: true
        });
        $('#' + id.attr('id') + '_wrapper').parent().find('.select-filter-dataTable').attr('style', 'display:flex !important ; right: ' + ($('#' + id.attr('id') + '_wrapper .toolbar-button-datatable').width() + 24) + 'px !important');
        if(id.parents('.modal').attr('id') !== undefined){
            id.find('.js-example-basic-single').select2({
                dropdownParent: $('#' + id.parents('.modal').attr('id')),
            });
        }else {
            id.find('.js-example-basic-single').select2();
        }
    });

    table.on('page.dt', function () {
        $(table.table().node()).parent().scrollTop(0);
    });

    return table;
}
