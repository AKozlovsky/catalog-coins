"use strict";

$(function () {
    var titleFromInput =
        $("#input").val().substring(0, 1).toUpperCase() +
        $("#input").val().substring(1);
    var dt_table = $(".datatable"),
        detailUrl = baseUrl + "edit/",
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

        var countriesJson;
        fetch(assetsPath + "json/countries.json")
            .then((response) => response.json())
            .then((json) => (countriesJson = json));

        var dt = dt_table.DataTable({
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
                            for (let i = 0; i < countriesJson.length; i++) {
                                if (
                                    $("#action").val() == "continents" &&
                                    full["country"] == countriesJson[i].name
                                ) {
                                    output +=
                                        '<div class="d-flex justify-content-start align-items-center country-name">';
                                    output += '<div class="me-3">';
                                    output +=
                                        '<img src="' +
                                        countriesJson[i].flag_url +
                                        '" alt="' +
                                        countriesJson[i].name +
                                        ' Flag" class="rounded-circle" height=32 width=32>';
                                    output +=
                                        '</div><div class="d-flex flex-column">';
                                    output += data + "</div></div>";
                                } else if (
                                    full["country"] == countriesJson[i].name
                                ) {
                                    output += data;
                                }
                            }
                        } else {
                            output = data;
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
                            addButtonPreview(full) +
                            addButtonEdit(full) +
                            addButtonDelete(full) +
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
                                            $.each(el, function (index, item) {
                                                if (
                                                    item.classList !== undefined
                                                ) {
                                                    result +=
                                                        item.lastChild
                                                            .textContent;
                                                } else result += item.textContent;
                                            });
                                        }

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
                                            $.each(el, function (index, item) {
                                                if (
                                                    item.classList !== undefined
                                                ) {
                                                    result +=
                                                        item.lastChild
                                                            .textContent;
                                                } else result += item.textContent;
                                            });
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
                                            $.each(el, function (index, item) {
                                                if (
                                                    item.classList !== undefined
                                                ) {
                                                    result +=
                                                        item.lastChild
                                                            .textContent;
                                                } else result += item.textContent;
                                            });
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
                                            $.each(el, function (index, item) {
                                                if (
                                                    item.classList !== undefined
                                                ) {
                                                    result +=
                                                        item.lastChild
                                                            .textContent;
                                                } else result += item.textContent;
                                            });
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
                                            $.each(el, function (index, item) {
                                                if (
                                                    item.classList !== undefined
                                                ) {
                                                    result +=
                                                        item.lastChild
                                                            .textContent;
                                                } else result += item.textContent;
                                            });
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
                                type = $("#type").val().replaceAll("_", " "),
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
                                            ($("#type").val() == "reign_period"
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
                                            ($("#type").val() == "reign_period"
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
                    }
                }
            },
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

    function addButtonPreview(full) {
        return (
            `<button class="btn btn-sm btn-icon edit-record" data-id="${full["id"]}" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#preview-${full["id"]}" title="Preview">
            <i class="mdi mdi-eye-outline mdi-20px mx-1"></i>
            </button>` + setModal(full)
        );
    }

    function addButtonEdit(full) {
        return (
            '<a href="' +
            detailUrl +
            full["id"] +
            '" data-bs-toggle="tooltip" class="text-body" data-bs-placement="top" title="Edit"><i class="mdi mdi-pencil-outline mdi-20px mx-1"></i></a>'
        );
    }

    function addButtonDelete(full) {
        return `<button class="btn btn-sm btn-icon delete-record" data-id="${full["id"]}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
        <i class="mdi mdi-delete-outline mdi-20px mx-1"></i>
        </button>`;
    }

    function setModal(full) {
        return (
            `<div class="modal fade" id="preview-${full["id"]}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Detail</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="nav-align-top">` +
            addTabsButtons(full) +
            `<div class="card">
                <div class="card-body">
                    <div class="tab-content">` +
            addHomeTab(full) +
            addDetailsTab(full) +
            `</div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>`
        );
    }

    function addTabsButtons(full) {
        return `
            <ul class="nav nav-pills mb-3" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home-${full["id"]}" aria-controls="navs-pills-top-home-${full["id"]}" aria-selected="true">Home</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-details-${full["id"]}" aria-controls="navs-pills-top-details-${full["id"]}" aria-selected="false">Details</button>
                </li>
            </ul>`;
    }

    function addHomeTab(full) {
        return (
            `<div class="tab-pane fade show active" id="navs-pills-top-home-${full["id"]}" role="tabpanel">
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="d-flex align-items-center me-4 gap-3">
                            <div class="avatar-initial bg-label-primary rounded">
                                <i class='mdi mdi-earth mdi-24px'></i>
                            </div>
                            <div>
                                <h4 class="mb-0">${full["country"]}</h4>
                            </div>
                        </div>
                        <div class="d-flex align-items-center me-4 gap-3">
                            <div class="avatar-initial bg-label-primary rounded">
                                <i class='mdi mdi-cash-multiple mdi-24px'></i>
                            </div>
                        <div>
                        <h4 class="mb-0">${full["numerical_value"]}<span> ${full["symbol"]}</span></h4>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center flex-column text-center">
                <img class="img-fluid rounded mb-3 mt-4" src="` +
            assetsPath +
            `/photos/${full["filename"]}" alt="Image" width="365"/>
            </div>
        </div>`
        );
    }

    function addDetailsTab(full) {
        return `
        <div class="tab-pane fade" id="navs-pills-top-details-${full["id"]}" role="tabpanel">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-center me-4 gap-3">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <span class="fw-medium text-heading me-2">Currency:</span>
                            <span><i>${full["currency"]}</i></span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium text-heading me-2">Monarch:</span>
                            <span><i>${full["monarch"]}</i></span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium text-heading me-2">Reign Period From:</span>
                            <span><i>${full["reign_period_from"]}</i></span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium text-heading me-2">Reign Period To:</span>
                            <span><i>${full["reign_period_to"]}</i></span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium text-heading me-2">Mintage Year:</span>
                            <span><i>${full["mintage_year"]}</i></span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium text-heading me-2">Avers:</span>
                            <span><i>${full["avers"]}</i></span>
                        </li>
                    </ul>
                </div>
                <div class="d-flex align-items-center me-4 gap-3">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <span class="fw-medium text-heading me-2">Revers:</span>
                            <span><i>${full["revers"]}</i></span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium text-heading me-2">Coin Edge:</span>
                            <span><i>${full["coin_edge"]}</i></span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium text-heading me-2">Century:</span>
                            <span><i>${full["century"]}</i></span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium text-heading me-2">Metal:</span>
                            <span><i>${full["metal"]}</i></span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium text-heading me-2">Quality:</span>
                            <span><i>${full["quality"]}</i></span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium text-heading me-2">Krause Price:</span>
                            <span><i>${full["price_by_krause"]}</i></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        `;
    }
});
