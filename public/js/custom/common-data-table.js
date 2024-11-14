function detail(full, detailUrl) {
    return (
        '<div class="d-flex align-items-center">' +
        addButtonPreview(full) +
        addButtonEdit(full, detailUrl) +
        addButtonDelete(full) +
        "</div>"
    );
}

function addButtonPreview(data) {
    return (
        `<button class="btn btn-sm btn-icon edit-record" data-id="${data["id"]}" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#preview-${data["id"]}" title="Preview">
        <i class="mdi mdi-eye-outline mdi-20px mx-1"></i>
        </button>` + setModal(data)
    );
}

function addButtonEdit(data, detailUrl) {
    return (
        '<a href="' +
        detailUrl +
        data["id"] +
        '" data-bs-toggle="tooltip" class="text-body" data-bs-placement="top" title="Edit"><i class="mdi mdi-pencil-outline mdi-20px mx-1"></i></a>'
    );
}

function addButtonDelete(data) {
    return `<button class="btn btn-sm btn-icon delete-record" data-id="${data["id"]}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
    <i class="mdi mdi-delete-outline mdi-20px mx-1"></i>
    </button>`;
}

function setModal(data) {
    return (
        `<div class="modal fade" id="preview-${data["id"]}" tabindex="-1" aria-hidden="true">
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
        addTabs(data) +
        `<div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center me-4 gap-3 mb-4">
                    <div class="avatar-initial bg-label-primary rounded">
                        <i class='mdi mdi-earth mdi-24px'></i>
                    </div>
                    <p class="mb-0 card-title">${data["country"]}</p>
                    <div class="avatar-initial bg-label-primary rounded">
                        <i class='mdi mdi-cash-multiple mdi-24px'></i>
                    </div>
                    <p class="mb-0 card-title">${data["numerical_value"]}<span> ${data["symbol"]}</span></p>
                </div>
                <div class="tab-content">` +
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
    if (data["photos"].length > 0) {
        return (
            `<div class="tab-pane fade show active" id="navs-pills-top-home-${data["id"]}" role="tabpanel">` +
            loadPhotos(data) +
            `</div>`
        );
    }
}

function addDetailsTab(data) {
    return `
    <div class="tab-pane fade" id="navs-pills-top-details-${data["id"]}" role="tabpanel">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-center me-4 gap-3">
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <span class="fw-medium text-heading me-2">Currency:</span>
                        <span><i>${data["currency"]}</i></span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-medium text-heading me-2">Monarch:</span>
                        <span><i>${data["monarch"]}</i></span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-medium text-heading me-2">Reign Period From:</span>
                        <span><i>${data["reign_period_from"]}</i></span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-medium text-heading me-2">Reign Period To:</span>
                        <span><i>${data["reign_period_to"]}</i></span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-medium text-heading me-2">Mintage Year:</span>
                        <span><i>${data["mintage_year"]}</i></span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-medium text-heading me-2">Avers:</span>
                        <span><i>${data["avers"]}</i></span>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center me-4 gap-3">
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <span class="fw-medium text-heading me-2">Revers:</span>
                        <span><i>${data["revers"]}</i></span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-medium text-heading me-2">Coin Edge:</span>
                        <span><i>${data["coin_edge"]}</i></span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-medium text-heading me-2">Century:</span>
                        <span><i>${data["century"]}</i></span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-medium text-heading me-2">Metal:</span>
                        <span><i>${data["metal"]}</i></span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-medium text-heading me-2">Quality:</span>
                        <span><i>${data["quality"]}</i></span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-medium text-heading me-2">Krause Price:</span>
                        <span><i>${data["price_by_krause"]}</i></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    `;
}

function loadPhotos(data) {
    var content = `<div id="carouselExample" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">`;

    data.photos.forEach((element, index) => {
        if (index == 0) {
            content += `<div class="carousel-item active">`;
        } else {
            content += `<div class="carousel-item">`;
        }

        content +=
            `<img class="d-block w-100" src="` +
            assetsPath +
            `photos/` +
            element.filename;

        content += `" alt="` + index + ` slide" /></div>`;
    });

    content += `</div>
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>`;

    return content;
}
