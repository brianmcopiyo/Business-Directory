document.addEventListener("DOMContentLoaded", function () {
    const data = {
        type: "fill",
        datatype: "datetime",
        id: "chart-revenue-bg",
        labels: [
            "2020-06-20",
            "2020-06-21",
            "2020-06-22",
            "2020-06-23",
            "2020-06-24",
            "2020-06-25",
        ],
        data: [
            {
                name: "Chart name",
                data: [37, 35, 44, 50, 20, 70],
            },
        ],
        card: true,
        details: {
            title: "Card Title",
            value: "$6050",
            percentage: "10%",
            direction: "up",
            dropdown: [
                { text: "Last 7 days", active: true },
                { text: "Last 30 days", active: false },
                { text: "Last 3 months", active: false },
            ],
        },
    };

    line(data);
    line(data);
    graph(data);
});

function createCard(id, data) {
    const parent = document.getElementById(id);

    const container = document.createElement("div");
    container.className = "col-sm-6 col-lg-3";

    const card = document.createElement("div");
    card.className = "card";

    const cardBody = document.createElement("div");
    cardBody.className = "card-body";

    const header = document.createElement("div");
    header.className = "d-flex align-items-center";

    const subheader = document.createElement("div");
    subheader.className = "subheader";
    subheader.textContent = data["details"]["title"];

    header.appendChild(subheader);

    const content = document.createElement("div");
    content.className = "d-flex align-items-baseline";

    const revenue = document.createElement("div");
    revenue.className = "h1 mb-0 me-2";
    revenue.textContent = data["details"]["value"];

    content.appendChild(revenue);

    cardBody.appendChild(header);
    cardBody.appendChild(content);

    const chart = document.createElement("div");
    chart.id = data["id"];
    chart.className = "chart-sm";

    card.appendChild(cardBody);
    card.appendChild(chart);

    container.appendChild(card);

    parent.appendChild(container);

    return chart;
}

function line(data) {
    var card = data["card"]
        ? createCard("cards", { id: data["id"], details: data["details"] })
        : document.getElementById(data["id"]);

    if (data["type"] == "fill") {
        window.ApexCharts &&
            new ApexCharts(card, {
                chart: {
                    type: "area",
                    fontFamily: "inherit",
                    height: 40.0,
                    sparkline: {
                        enabled: true,
                    },
                    animations: {
                        enabled: false,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                fill: {
                    opacity: 0.16,
                    type: "solid",
                },
                stroke: {
                    width: 2,
                    lineCap: "round",
                    curve: "smooth",
                },
                series: data["data"],
                tooltip: {
                    theme: "dark",
                },
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                    type: data["datatype"],
                },
                yaxis: {
                    labels: {
                        padding: 4,
                    },
                },
                labels: data["labels"],
                colors: [tabler.getColor("primary")],
                legend: {
                    show: false,
                },
            }).render();
    } else {
        window.ApexCharts &&
            new ApexCharts(card, {
                chart: {
                    type: "line",
                    fontFamily: "inherit",
                    height: 40.0,
                    sparkline: {
                        enabled: true,
                    },
                    animations: {
                        enabled: false,
                    },
                },
                fill: {
                    opacity: 1,
                },
                stroke: {
                    width: [2, 1],
                    dashArray: [0, 3],
                    lineCap: "round",
                    curve: "smooth",
                },
                series: data["data"],
                tooltip: {
                    theme: "dark",
                },
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: {
                        padding: 0,
                    },
                    tooltip: {
                        enabled: false,
                    },
                    type: data["datatype"],
                },
                yaxis: {
                    labels: {
                        padding: 4,
                    },
                },
                labels: data["labels"],
                colors: [
                    tabler.getColor("primary"),
                    tabler.getColor("gray-600"),
                ],
                legend: {
                    show: false,
                },
            }).render();
    }
}

function graph(data) {
    var card = data["card"]
        ? createCard("cards", { id: data["id"], details: data["details"] })
        : document.getElementById(data["id"]);

    window.ApexCharts &&
        new ApexCharts(card, {
            chart: {
                type: "bar",
                fontFamily: "inherit",
                height: 40.0,
                sparkline: {
                    enabled: true,
                },
                animations: {
                    enabled: false,
                },
            },
            plotOptions: {
                bar: {
                    columnWidth: "50%",
                },
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1,
            },
            series: data["data"],
            tooltip: {
                theme: "dark",
            },
            grid: {
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false,
                },
                axisBorder: {
                    show: false,
                },
                type: data["datatype"],
            },
            yaxis: {
                labels: {
                    padding: 4,
                },
            },
            labels: data["labels"],
            colors: [tabler.getColor("primary")],
            legend: {
                show: false,
            },
        }).render();
}

function map(data = null) {
    //Map
    const maps = new jsVectorMap({
        selector: "#map-world",
        map: "world",
        backgroundColor: "transparent",
        regionStyle: {
            initial: {
                fill: tabler.getColor("body-bg"),
                stroke: tabler.getColor("border-color"),
                strokeWidth: 1,
            },
        },
        zoomOnScroll: false,
        zoomButtons: true,
        // -------- Series --------
        visualizeData: {
            scale: [tabler.getColor("bg-surface"), tabler.getColor("primary")],
            values: {
                DZ: 158,
                AO: 85,
                BJ: 6,
                BW: 16,
                BF: 13,
                BI: 1,
                CM: 38,
                CV: 1,
                DJ: 1,
                EG: 302,
                GA: 17,
                GM: 1,
                GH: 67,
                GN: 12,
                GQ: 13,
                KE: 95,
                LS: 14,
                LR: 2,
                LY: 82,
                MG: 31,
                MW: 26,
                ML: 14,
                MR: 6,
                MU: 12,
                MA: 124,
                MZ: 30,
                NA: 14,
                NE: 18,
                NG: 203,
                RW: 10,
                SC: 1,
                SD: 56,
                SZ: 4,
                TZ: 58,
                TG: 7,
                TN: 34,
                UG: 42,
                ZA: 350,
                ZM: 20,
                ZW: 16,
            },
        },
    });
    window.addEventListener("resize", () => {
        maps.updateSize();
    });
}

$(document).ready(function () {
    $(".headerCheckbox").change(function () {
        const isChecked = $(this).is(":checked");
        $(this)
            .closest("table")
            .find(".rowCheckbox")
            .prop("checked", isChecked);
    });
});
