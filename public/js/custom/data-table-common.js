function detail(full, detailUrl, action) {
    var html = '<div class="d-flex align-items-center">';

    if (action != "currencies") {
        html += setButtonPreview(full);
    }

    html += setButtonEdit(full, detailUrl) + setButtonDelete(full) + "</div>";

    return html;
}

function setButtonPreview(data) {
    return (
        `<button class="btn btn-sm btn-icon edit-record" data-id="${data["id"]}" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#preview-${data["id"]}" title="Preview">
        <i class="mdi mdi-eye-outline mdi-20px mx-1"></i>
        </button>` + setModalPreview(data)
    );
}

function setButtonEdit(data, detailUrl) {
    return (
        '<a href="' +
        detailUrl +
        data["id"] +
        '" data-bs-toggle="tooltip" class="text-body" data-bs-placement="top" title="Edit"><i class="mdi mdi-pencil-outline mdi-20px mx-1"></i></a>'
    );
}

function setButtonDelete(data) {
    return (
        `<button class="btn btn-sm btn-icon delete-record" data-id="${data["id"]}" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#delete-${data["id"]}" title="Delete">
    <i class="mdi mdi-delete-outline mdi-20px mx-1"></i>
    </button>` + setModalDelete(data)
    );
}

function setModalPreview(data) {
    return (
        `<div class="modal fade" id="preview-${data["id"]}" tabindex="-1">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content p-md-5">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="nav-align-top">` +
        addTabs(data) +
        `<div class="d-flex align-items-center me-4 gap-3 mb-4">
            <span class="avatar-initial bg-label-primary rounded">
                <i class='mdi mdi-earth mdi-24px'></i>
            </span>
            <p class="mb-0 card-title">${data["country"]}</p>
                <span class="avatar-initial bg-label-primary rounded">
                    <i class='mdi mdi-cash-multiple mdi-24px'></i>
                </span>
            <p class="mb-0 card-title">${data["numerical_value"]}<span> ${data["symbol"]}</span></p>
        </div>` +
        `<div class="card shadow-none">
            <div class="card-body p-0">
                <div class="tab-content p-0">` +
        addHomeTab(data) +
        addDetailsTab(data) +
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

function addTabs(data) {
    return `
        <ul class="nav nav-pills mb-3" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home-${data["id"]}" aria-controls="navs-pills-top-home-${data["id"]}" aria-selected="true">Home</button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-details-${data["id"]}" aria-controls="navs-pills-top-details-${data["id"]}" aria-selected="false">Details</button>
            </li>
        </ul>`;
}

function addHomeTab(data) {
    var result = `<div class="tab-pane fade show active" id="navs-pills-top-home-${data["id"]}" role="tabpanel">`;

    if (data.photos != undefined) {
        if (data.photos.length > 0) {
            result += loadPhotos(data);
        } else {
            result += "No photos";
        }
    }

    result += `</div>`;

    return result;
}

function addDetailsTab(data) {
    return `
    <div class="tab-pane fade" id="navs-pills-top-details-${data["id"]}" role="tabpanel">
        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-around">
            <table>
                <tr class="border-bottom">
                    <td class="d-flex me-4 gap-2 mt-4">
                        <i class="mdi mdi-currency-usd"></i>
                        <small class="text-muted" style="width: 150px">Currency</small>
                        <p>${data["currency"]}</p>
                    </td>
                </tr>
                <tr class="border-bottom">
                    <td class="d-flex me-4 gap-2 mt-4">
                        <i class="mdi mdi-crown"></i>
                        <small class="text-muted" style="width: 150px">Monarch</small>
                        <p>${data["monarch"]}</p>
                    </td>
                </tr>
                <tr class="border-bottom">
                    <td class="d-flex me-4 gap-2 mt-4">
                        <i class="mdi mdi-sort-clock-ascending"></i>
                        <small class="text-muted" style="width: 150px">Reign Period From</small>
                        <p>${data["reign_period_from"]}</p>
                    </td>
                </tr>
                <tr class="border-bottom">
                    <td class="d-flex me-4 gap-2 mt-4">
                        <i class="mdi mdi-sort-clock-descending"></i>
                        <small class="text-muted" style="width: 150px">Reign Period To</small>
                        <p>${data["reign_period_to"]}</p>
                    </td>
                </tr>
                <tr class="border-bottom">
                    <td class="d-flex me-4 gap-2 mt-4">
                        <i class="mdi mdi-wrench-clock"></i>
                        <small class="text-muted" style="width: 150px">Mintage Year</small>
                        <p>${data["mintage_year"]}</p>
                    </td>
                </tr>
                <tr class="border-bottom">
                    <td class="d-flex me-4 gap-2 mt-4">
                        <i class="mdi mdi-hand-coin"></i>
                        <small class="text-muted" style="width: 150px">Avers</small>
                        <p>${data["avers"]}</p>
                    </td>
                </tr>
            </table>
            <table>
                <tr class="border-bottom">
                    <td class="d-flex me-4 gap-2 mt-4">
                        <i class="mdi mdi-hand-coin-outline"></i>
                        <small class="text-muted" style="width: 150px">Revers</small>
                        <p>${data["revers"]}</p>
                    </td>
                </tr>
                <tr class="border-bottom">
                    <td class="d-flex me-4 gap-2 mt-4">
                        <i class="mdi mdi-nut"></i>
                        <small class="text-muted" style="width: 150px">Coin Edge</small>
                        <p>${data["coin_edge"]}</p>
                    </td>
                </tr>
                <tr class="border-bottom">
                    <td class="d-flex me-4 gap-2 mt-4">
                        <i class="mdi mdi-timer-sand-complete"></i>
                        <small class="text-muted" style="width: 150px">Century</small>
                        <p>${data["century"]}</p>
                    </td>
                </tr>
                <tr class="border-bottom">
                    <td class="d-flex me-4 gap-2 mt-4">
                        <i class="mdi mdi-wheel-barrow"></i>
                        <small class="text-muted" style="width: 150px">Metal</small>
                        <p>${data["metal"]}</p>
                    </td>
                </tr>
                <tr class="border-bottom">
                    <td class="d-flex me-4 gap-2 mt-4">
                        <i class="mdi mdi-magnify"></i>
                        <small class="text-muted" style="width: 150px">Quality</small>
                        <p>${data["quality"]}</p>
                    </td>
                </tr>
                <tr class="border-bottom">
                    <td class="d-flex me-4 gap-2 mt-4">
                        <i class="mdi mdi-bank"></i>
                        <small class="text-muted" style="width: 150px">Krause Price</small>
                        <p>${data["price_by_krause"]}</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    `;
}

function loadPhotos(data) {
    var content = `<div id="photo-${data["id"]}" class="carousel carousel-dark slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#photo-${data["id"]}" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#photo-${data["id"]}" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#photo-${data["id"]}" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">`;

    data.photos.forEach((element, index) => {
        if (index == 0) {
            content += `<div class="carousel-item active" style="text-align: -webkit-center;">`;
        } else {
            content += `<div class="carousel-item" style="text-align: -webkit-center;">`;
        }

        content +=
            `<img class="d-block w-60 h-60" data-id="photo-` +
            element.filename +
            `" src="` +
            uploadsPath +
            `/` +
            element.filename +
            `" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#photo-${element.filename}"`;

        content += `" alt="` + index + ` slide" /></div>`;
    });

    content += `</div>
                <a class="carousel-control-prev" href="#photo-${data["id"]}" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#photo-${data["id"]}" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>`;

    return content;
}

function setModalDelete(data) {
    return `<div class="modal fade" id="delete-${data["id"]}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="delete-record" onclick="deleteRecord(${data["id"]})">Delete</button>
                </div>
            </div>
        </div>
    </div>`;
}

function deleteRecord(id) {
    $("#delete-" + id).modal("hide");
    var url = `${baseUrl}`;

    if ($("#action").val() == "currencies") {
        url += "delete-currency/";
    } else {
        url += "delete/";
    }

    $.ajax({
        url: url + id,
        type: "DELETE",
        data: {
            id: id,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function () {
            Swal.fire({
                icon: "success",
                title: `Successfully!`,
                text: "Record has been deleted",
                customClass: {
                    confirmButton: "btn btn-success",
                },
            }).then(function () {
                if (["continents", "countries"].includes($("#action").val())) {
                    $(".datatable").DataTable().ajax.reload();
                } else {
                    window.location = `${baseUrl}` + $("#action").val();
                }
            });
        },
        error: function (err) {
            Swal.fire({
                title: "Error!",
                text: err,
                icon: "error",
                customClass: {
                    confirmButton: "btn btn-success",
                },
            });
        },
    });
}
