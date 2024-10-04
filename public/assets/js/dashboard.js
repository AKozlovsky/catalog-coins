function initHorizontalBarChart(data) {
    var borderColor = config.colors.borderColor;
    var labelColor = config.colors.textMuted;
    var labels = getValues(data, 0);
    var values = getValues(data, 1);

    const horizontalBarChartEl = document.querySelector("#horizontalBarChart"),
        horizontalBarChartConfig = {
            chart: {
                height: 270,
                type: "bar",
                toolbar: {
                    show: false,
                },
            },
            plotOptions: {
                horizontal: true,
                barHeight: "70%",
                distributed: true,
                startingShape: "rounded",
                borderRadius: 7,
            },
            grid: {
                strokeDashArray: 10,
                borderColor: borderColor,
                xaxis: {
                    lines: {
                        show: true,
                    },
                },
                yaxis: {
                    lines: {
                        show: false,
                    },
                },
                padding: {
                    top: -35,
                    bottom: -12,
                },
            },
            colors: [
                config.colors.primary,
                config.colors.info,
                config.colors.success,
                config.colors.secondary,
                config.colors.danger,
                config.colors.warning,
            ],
            dataLabels: {
                enabled: false,
            },
            labels: labels,
            series: [
                {
                    data: values,
                },
            ],
            xaxis: {
                categories: labels,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: "13px",
                    },
                    formatter: function (val) {
                        return `${val}`;
                    },
                },
            },
            yaxis: {
                max: Math.max(values) + 5,
                labels: {
                    style: {
                        colors: [labelColor],
                        fontFamily: "Inter",
                        fontSize: "13px",
                    },
                },
            },
            tooltip: {
                enabled: true,
                style: {
                    fontSize: "12px",
                },
                onDatasetHover: {
                    highlightDataSeries: false,
                },
                custom: function ({ series, seriesIndex, dataPointIndex, w }) {
                    return (
                        '<div class="px-3 py-2">' +
                        "<span>" +
                        series[seriesIndex][dataPointIndex] +
                        "</span>" +
                        "</div>"
                    );
                },
            },
            legend: {
                show: false,
            },
        };

    if (
        typeof horizontalBarChartEl !== undefined &&
        horizontalBarChartEl !== null
    ) {
        const horizontalBarChart = new ApexCharts(
            horizontalBarChartEl,
            horizontalBarChartConfig
        );
        horizontalBarChart.render();
    }
}

function getValues(data, index) {
    var result = [];
    data.split(";")
        .filter(Boolean)
        .forEach((x) => result.push(x.split(":")[index]));

    return result;
}
