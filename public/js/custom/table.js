$(function () {
    var dt = $(".datatable");
    dt.DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: baseUrl + "list-by-continent",
            data: {
                continent: $("#continent").val(),
            },
        },
        columns: [
            { data: "country" },
            { data: "currency" },
            { data: "symbol" },
            { data: "numerical_value" },
        ],
    });
});
