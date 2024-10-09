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
    monarchs: [{ data: "monarch" }, { data: "action" }],
    reign_periods: [
        { data: "reign_period_from" },
        { data: "reign_period_to" },
        { data: "action" },
    ],
    mintage_years: [{ data: "mintage_year" }, { data: "action" }],
    avers: [{ data: "avers" }, { data: "action" }],
    revers: [{ data: "revers" }, { data: "action" }],
    coin_edges: [{ data: "coin_edge" }, { data: "action" }],
    currencies: [
        { data: "name" },
        { data: "code" },
        { date: "symbol" },
        { data: "action" },
    ],
    centuries: [{ data: "century" }, { data: "action" }],
    metals: [{ data: "metal" }, { data: "action" }],
    qualities: [{ data: "quality" }, { data: "action" }],
    prices_by_krause: [{ data: "price_by_krause" }, { data: "action" }],
};

var getColumns = function (action) {
    action = action.replaceAll("-", "_");

    return columns[action];
};
