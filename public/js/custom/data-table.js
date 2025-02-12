"use strict";

$(function () {
    var dt;
    var titleFromInput =
        $("#input").val().substring(0, 1).toUpperCase() +
        $("#input").val().substring(1);
    var dt_table = $(".datatable"),
        controllers = ["continents", "countries"],
        controllers2 = [
            "monarchs",
            "reign-periods",
            "mintage-years",
            "avers",
            "revers",
            "coin-edges",
            "currencies",
            "centuries",
            "metals",
            "qualities",
            "prices-by-krause",
        ],
        controllers3 = ["reign-periods"];

    if ($("#action").val() == "currencies") {
        var detailUrl = baseUrl + "edit-currency/";
    } else {
        var detailUrl = baseUrl + "edit/";
    }

    if (dt_table.length) {
        $(".datatable thead tr").clone(true).appendTo(".datatable thead");
        $(".datatable thead tr:eq(1) th").each(function (i) {
            if (
                i + 1 < $(".datatable thead tr:eq(1) th").length &&
                controllers.includes($("#action").val())
            ) {
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

        var countries = [];
        $.getJSON(assetsPath + "json/countries.json", function (data) {
            $.each(data, function (key, value) {
                countries.push(value);
            });

            dt = dt_table.DataTable({
                processing: controllers2.includes($("#action").val())
                    ? false
                    : true,
                serverSide: controllers2.includes($("#action").val())
                    ? false
                    : true,
                ajax: controllers2.includes($("#action").val())
                    ? false
                    : {
                          url: baseUrl + "data-table",
                          data: {
                              input: $("#input").val(),
                          },
                      },
                columns: getColumns($("#action").val()),
                columnDefs: [
                    {
                        targets: 0,
                        render: function (data, type, full, meta) {
                            var output = "";

                            if (controllers.includes($("#action").val())) {
                                for (let i = 0; i < countries.length; i++) {
                                    if (
                                        $("#action").val() == "continents" &&
                                        full["country"] == countries[i].name
                                    ) {
                                        output +=
                                            '<div class="d-flex justify-content-start align-items-center country-name">';
                                        output += '<div class="me-3">';
                                        output +=
                                            '<img src="' +
                                            countries[i].flag_url +
                                            '" alt="' +
                                            countries[i].name +
                                            ' Flag" class="rounded-circle" height=32 width=32>';
                                        output +=
                                            '</div><div class="d-flex flex-column">';
                                        output += data + "</div></div>";
                                    } else if (
                                        full["country"] == countries[i].name
                                    ) {
                                        output += data;
                                    }
                                }
                            } else {
                                output += data;
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
                            return detail(full, detailUrl, $("#action").val());
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
                                title: titleFromInput,
                                text: '<i class="mdi mdi-printer-outline me-1" ></i>Print',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: [0, 1, 2, 3],
                                    // prevent avatar to be print
                                    format: {
                                        body: function (inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var result = "";
                                            if (!isNaN(inner)) {
                                                result += inner;
                                            } else {
                                                var el = $.parseHTML(inner);
                                                $.each(
                                                    el,
                                                    function (index, item) {
                                                        if (
                                                            item.classList !==
                                                            undefined
                                                        ) {
                                                            result +=
                                                                item.lastChild
                                                                    .textContent;
                                                        } else
                                                            result +=
                                                                item.textContent;
                                                    }
                                                );
                                            }

                                            return result;
                                        },
                                    },
                                },
                                customize: function (win) {
                                    //customize print view for dark
                                    $(win.document.body)
                                        .css(
                                            "color",
                                            config.colors.headingColor
                                        )
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
                                title: titleFromInput,
                                text: '<i class="mdi mdi-file-document-outline me-1" ></i>Csv',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: [0, 1, 2, 3],
                                    // prevent avatar to be print
                                    format: {
                                        body: function (inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var result = "";
                                            if (!isNaN(inner)) {
                                                result += inner;
                                            } else {
                                                var el = $.parseHTML(inner);
                                                $.each(
                                                    el,
                                                    function (index, item) {
                                                        if (
                                                            item.classList !==
                                                            undefined
                                                        ) {
                                                            result +=
                                                                item.lastChild
                                                                    .textContent;
                                                        } else
                                                            result +=
                                                                item.textContent;
                                                    }
                                                );
                                            }

                                            return result;
                                        },
                                    },
                                },
                            },
                            {
                                extend: "excel",
                                title: titleFromInput,
                                text: '<i class="mdi mdi-file-excel-outline me-1" ></i>Excel',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: [0, 1, 2, 3],
                                    // prevent avatar to be display
                                    format: {
                                        body: function (inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var result = "";
                                            if (!isNaN(inner)) {
                                                result += inner;
                                            } else {
                                                var el = $.parseHTML(inner);
                                                $.each(
                                                    el,
                                                    function (index, item) {
                                                        if (
                                                            item.classList !==
                                                            undefined
                                                        ) {
                                                            result +=
                                                                item.lastChild
                                                                    .textContent;
                                                        } else
                                                            result +=
                                                                item.textContent;
                                                    }
                                                );
                                            }

                                            return result;
                                        },
                                    },
                                },
                            },
                            {
                                extend: "pdf",
                                title: titleFromInput,
                                text: '<i class="mdi mdi-file-pdf-box me-1"></i>Pdf',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: [0, 1, 2, 3],
                                    // prevent avatar to be display
                                    format: {
                                        body: function (inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var result = "";
                                            if (!isNaN(inner)) {
                                                result += inner;
                                            } else {
                                                var el = $.parseHTML(inner);
                                                $.each(
                                                    el,
                                                    function (index, item) {
                                                        if (
                                                            item.classList !==
                                                            undefined
                                                        ) {
                                                            result +=
                                                                item.lastChild
                                                                    .textContent;
                                                        } else
                                                            result +=
                                                                item.textContent;
                                                    }
                                                );
                                            }

                                            return result;
                                        },
                                    },
                                },
                            },
                            {
                                extend: "copy",
                                title: titleFromInput,
                                text: '<i class="mdi mdi-content-copy me-1" ></i>Copy',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: [0, 1, 2, 3],
                                    // prevent avatar to be copy
                                    format: {
                                        body: function (inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var result = "";
                                            if (!isNaN(inner)) {
                                                result += inner;
                                            } else {
                                                var el = $.parseHTML(inner);
                                                $.each(
                                                    el,
                                                    function (index, item) {
                                                        if (
                                                            item.classList !==
                                                            undefined
                                                        ) {
                                                            result +=
                                                                item.lastChild
                                                                    .textContent;
                                                        } else
                                                            result +=
                                                                item.textContent;
                                                    }
                                                );
                                            }

                                            return result;
                                        },
                                    },
                                },
                            },
                        ],
                    },
                    {
                        text: '<i class="mdi mdi-plus me-0 me-sm-2"></i><span class="d-none d-sm-inline-block">Add New Item</span>',
                        className: "add-new btn btn-primary",
                        attr: {
                            "data-bs-toggle": "offcanvas",
                            "data-bs-target": "#offcanvasAddCoin",
                            onclick: "location.href = '/add'",
                        },
                    },
                ],
                initComplete: function () {
                    if (controllers2.includes($("#action").val())) {
                        this.api()
                            .columns(0)
                            .every(function () {
                                var column = this,
                                    type = $("#type")
                                        .val()
                                        .replaceAll("_", " "),
                                    select = $(
                                        '<select class="form-select text-capitalize"><option value=""> Select ' +
                                            type.charAt(0).toUpperCase() +
                                            type.slice(1) +
                                            ($("#type").val() == "reign_period"
                                                ? " From"
                                                : "") +
                                            " </option></select>"
                                    )
                                        .appendTo(
                                            ".select_" +
                                                $("#type").val() +
                                                ($("#type").val() ==
                                                "reign_period"
                                                    ? "_from"
                                                    : "")
                                        )
                                        .on("change", function () {
                                            var val =
                                                $.fn.dataTable.util.escapeRegex(
                                                    $(this).val()
                                                );
                                            column
                                                .search(
                                                    val ? "^" + val + "$" : "",
                                                    true,
                                                    false
                                                )
                                                .draw();
                                        });

                                column
                                    .data()
                                    .unique()
                                    .sort()
                                    .each(function (d, j) {
                                        select.append(
                                            '<option value="' +
                                                d +
                                                '">' +
                                                d +
                                                "</option>"
                                        );
                                    });
                            });

                        if (controllers3.includes($("#action").val())) {
                            this.api()
                                .columns(1)
                                .every(function () {
                                    var column = this,
                                        type = $("#type")
                                            .val()
                                            .replaceAll("_", " "),
                                        select = $(
                                            '<select class="form-select text-capitalize"><option value=""> Select ' +
                                                type.charAt(0).toUpperCase() +
                                                type.slice(1) +
                                                ($("#type").val() ==
                                                "reign_period"
                                                    ? " To"
                                                    : "") +
                                                " </option></select>"
                                        )
                                            .appendTo(
                                                ".select_" +
                                                    $("#type").val() +
                                                    ($("#type").val() ==
                                                    "reign_period"
                                                        ? "_to"
                                                        : "")
                                            )
                                            .on("change", function () {
                                                var val =
                                                    $.fn.dataTable.util.escapeRegex(
                                                        $(this).val()
                                                    );
                                                column
                                                    .search(
                                                        val
                                                            ? "^" + val + "$"
                                                            : "",
                                                        true,
                                                        false
                                                    )
                                                    .draw();
                                            });

                                    column
                                        .data()
                                        .unique()
                                        .sort()
                                        .each(function (d, j) {
                                            select.append(
                                                '<option value="' +
                                                    d +
                                                    '">' +
                                                    d +
                                                    "</option>"
                                            );
                                        });
                                });
                        }
                    }
                },
            });
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
