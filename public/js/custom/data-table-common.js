function detail(full, detailUrl) {
    return (
        '<div class="d-flex align-items-center">' +
        setButtonPreview(full) +
        setButtonEdit(full, detailUrl) +
        setButtonDelete(full) +
        "</div>"
    );
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
    return `<button class="btn btn-sm btn-icon delete-record" data-id="${data["id"]}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
    <i class="mdi mdi-delete-outline mdi-20px mx-1"></i>
    </button>`;
}

function setModalPreview(data) {
    return (
        `<div class="modal fade" id="preview-${data["id"]}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
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

    if (data["photos"].length > 0) {
        result += loadPhotos(data);
    } else {
        result += "No photos";
    }

    result += `</div>`;

    return result;
}

function addDetailsTab(data) {
    return `
    <div class="tab-pane fade" id="navs-pills-top-details-${data["id"]}" role="tabpanel">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Currency</th>
                        <th>Monarch</th>
                        <th>Reign Period From</th>
                        <th>Reign Period To</th>
                        <th>Mintage Year</th>
                        <th>Avers</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>${data["currency"]}</td>
                        <td>${data["monarch"]}</td>
                        <td>${data["reign_period_from"]}</td>
                        <td>${data["reign_period_to"]}</td>
                        <td>${data["mintage_year"]}</td>
                        <td>${data["avers"]}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Revers</th>
                        <th>Coin Edge</th>
                        <th>Century</th>
                        <th>Metal</th>
                        <th>Quality</th>
                        <th>Krause Price</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>${data["revers"]}</td>
                        <td>${data["coin_edge"]}</td>
                        <td>${data["century"]}</td>
                        <td>${data["metal"]}</td>
                        <td>${data["quality"]}</td>
                        <td>${data["price_by_krause"]}</td>
                    </tr>
                </tbody>
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
            assetsPath +
            `photos/` +
            element.filename +
            `" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#photo-${element.filename}"`;

        content += `" alt="` + index + ` slide" /></div>`;
    });

    content += `</div>
                <a class="carousel-control-prev" href="#photo-${data["id"]}" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#photo-${data["id"]}" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>`;

    return content;
}