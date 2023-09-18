$(function () {
    loadData();
})

async function loadData() {
    let method = "get",
        url = "asset.data",
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('body')]);
    dataTable(res.data[0].original.data);
}

async function dataTable(data) {
    let id = $("#table-asset"),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "5%"},
            {data: "image", name: "image", className: "text-center"},
            {data: "name", name: "name", className: "text-center"},
            {data: "time", name: "time", className: "text-center"},
            {data: "amount", name: "amount", className: "text-right"},
            {data: "description", name: "description", className: "text-left"},
        ],
        option = [
            {
                title: "Thêm mới",
                icon: "fa fa-plus text-primary",
                class: "",
                function: "openModalCreateAsset",
            },
        ];
    DatatableTemplate(id, data, columns, heightScrollDatatable, fixed_left, fixed_right, option);
}
