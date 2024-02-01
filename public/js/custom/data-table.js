"use strict";

$(function () {
    var dt_table = $(".datatable"),
        detailUrl = baseUrl + "edit/";

    if (dt_table.length) {
        $(".datatable thead tr").clone(true).appendTo(".datatable thead");
        $(".datatable thead tr:eq(1) th").each(function (i) {
            if (i < 4) {
                var title = $(this).text();
                $(this).html(
                    '<input type="text" class="form-control" placeholder="Search ' +
                        title +
                        '" />'
                );

                $("input", this).on("keyup change", function () {
                    if (dt.column(i).search() !== this.value) {
                        dt.column(i).search(this.value).draw();
                    }
                });
            } else {
                $(this).html("");
            }
        });

        var countriesJson;
        fetch(assetsPath + "json/countries.json")
            .then((response) => response.json())
            .then((json) => (countriesJson = json));

        var columns;
        fetch(assetsPath + "json/columns.json")
            .then((response) => response.json())
            .then((json) => (columns = json->dbNames));

        var dt = dt_table.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: baseUrl + "data-table",
                data: {
                    input: $("#input").val(),
                },
            },
            columns: [
                { data: "country" },
                { data: "currency" },
                { data: "symbol" },
                { data: "numerical_value" },
                { data: "action" },
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (data, type, full, meta) {
                        var output = "";

                        for (let i = 0; i < countriesJson.length; i++) {
                            if (full["country"] == countriesJson[i].name) {
                                output +=
                                    '<div class="d-flex justify-content-start align-items-center user-name">';
                                output += '<div class="me-3">';
                                output +=
                                    '<img src="' +
                                    assetsPath +
                                    "img/flags/" +
                                    countriesJson[i].alpha3.toLowerCase() +
                                    '.svg" alt="' +
                                    countriesJson[i].name +
                                    ' Flag" class="rounded-circle" height=32 width=32>';
                                output +=
                                    '</div><div class="d-flex flex-column">';
                                output += data + "</div></div>";
                            }
                        }

                        return output;
                    },
                },
                {
                    targets: -1,
                    title: "Actions",
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="d-flex align-items-center">' +
                            `<button class="btn btn-sm btn-icon edit-record" data-id="${full["id"]}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-target="#offcanvasAddUser" title="Preview"><i class="mdi mdi-eye-outline mdi-20px mx-1"></i></button>` +
                            '<a href="' +
                            detailUrl +
                            full["id"] +
                            '" data-bs-toggle="tooltip" class="text-body" data-bs-placement="top" title="Edit"><i class="mdi mdi-pencil-outline mdi-20px mx-1"></i></a>' +
                            `<button class="btn btn-sm btn-icon delete-record" data-id="${full["id"]}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="mdi mdi-delete-outline mdi-20px mx-1"></i></button>` +
                            "</div>"
                        );
                    },
                },
            ],
            orderCellsTop: true,
            dom:
                '<"row mx-2"' +
                '<"col-md-2"<"me-3"l>>' +
                '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
                ">t" +
                '<"row mx-2"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                ">",
            buttons: [
                {
                    extend: "collection",
                    className: "btn btn-label-primary dropdown-toggle mx-3",
                    text: '<i class="mdi mdi-export-variant me-sm-1"></i>Export',
                    buttons: [
                        {
                            extend: "print",
                            title: "Users",
                            text: '<i class="mdi mdi-printer-outline me-1" ></i>Print',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [2, 3],
                                // prevent avatar to be print
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList !== undefined &&
                                                item.classList.contains(
                                                    "user-name"
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.textContent;
                                            } else result = result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                            customize: function (win) {
                                //customize print view for dark
                                $(win.document.body)
                                    .css("color", config.colors.headingColor)
                                    .css(
                                        "border-color",
                                        config.colors.borderColor
                                    )
                                    .css(
                                        "background-color",
                                        config.colors.body
                                    );
                                $(win.document.body)
                                    .find("table")
                                    .addClass("compact")
                                    .css("color", "inherit")
                                    .css("border-color", "inherit")
                                    .css("background-color", "inherit");
                            },
                        },
                        {
                            extend: "csv",
                            title: "Users",
                            text: '<i class="mdi mdi-file-document-outline me-1" ></i>Csv',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [2, 3],
                                // prevent avatar to be print
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList.contains(
                                                    "user-name"
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.textContent;
                                            } else result = result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                        },
                        {
                            extend: "excel",
                            title: "Users",
                            text: '<i class="mdi mdi-file-excel-outline me-1" ></i>Excel',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [2, 3],
                                // prevent avatar to be display
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList.contains(
                                                    "user-name"
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.textContent;
                                            } else result = result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                        },
                        {
                            extend: "pdf",
                            title: "Users",
                            text: '<i class="mdi mdi-file-pdf-box me-1"></i>Pdf',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [2, 3],
                                // prevent avatar to be display
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList.contains(
                                                    "user-name"
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.textContent;
                                            } else result = result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                        },
                        {
                            extend: "copy",
                            title: "Users",
                            text: '<i class="mdi mdi-content-copy me-1" ></i>Copy',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [2, 3],
                                // prevent avatar to be copy
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList.contains(
                                                    "user-name"
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.textContent;
                                            } else result = result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                        },
                    ],
                },
                {
                    text: '<i class="mdi mdi-plus me-0 me-sm-2"></i><span class="d-none d-sm-inline-block">Add New Coin</span>',
                    className: "add-new btn btn-primary",
                    attr: {
                        "data-bs-toggle": "offcanvas",
                        "data-bs-target": "#offcanvasAddCoin",
                    },
                },
            ],
        });
    }

    dt_table.on("draw.dt", function () {
        var tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                boundary: document.body,
            });
        });
    });
});
