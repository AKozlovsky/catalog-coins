"use strict";

$(function () {
    var dt_table = $(".datatable");

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

        var dt = dt_table.DataTable({
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
                            '<a href="" data-bs-toggle="tooltip" class="text-body" data-bs-placement="top" title="Preview"><i class="mdi mdi-eye-outline mdi-20px mx-1"></i></a>' +
                            "</div>"
                        );
                    },
                },
            ],
            orderCellsTop: true,
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
