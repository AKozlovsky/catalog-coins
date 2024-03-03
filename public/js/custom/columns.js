var columns = {
    continents: [
        { data: "country" },
        { data: "currency" },
        { data: "symbol" },
        { data: "numerical_value" },
        { data: "action" },
    ],
    countries: [
        { data: "currency" },
        { data: "symbol" },
        { data: "numerical_value" },
        { data: "action" },
    ],
};

var getColumns = function (action) {
    return columns[action];
};
