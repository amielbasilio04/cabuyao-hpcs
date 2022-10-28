$(() => {
    // router
    if (
        window.location.href === route("city_admin.health_statistic.index") ||
        window.location.href === route("city_admin.dashboard.index")
    ) {
        getDefaultStatistic("city_admin.health_statistic.index");
    }

    if (
        window.location.href ===
        route("city_admin.health_statistic.family_history")
    ) {
        getDefaultStatistic(
            "city_admin.health_statistic.family_history",
            "Family History"
        );
    }

    if (
        window.location.href === route("brgy_admin.dashboard.index") ||
        window.location.href === route("brgy_admin.health_statistic.index")
    ) {
        getDefaultStatistic("brgy_admin.health_statistic.index");
    }
});

// global vars
let map;
const access_token =
    "pk.eyJ1IjoiZGV2YWVzMjAyMSIsImEiOiJja3Y2ZzdsNHgwdjNjMnRva25ydWl5dXBiIn0.PGH3gPOO163DcTiQJdVRlA";
let markers = [];

// get all default static
async function getDefaultStatistic(routename, title = "Health Issue") {
    const res = await axios.get(route(routename));
    if (typeof map === "object") {
        map.remove(); // every time we load the data we destroy the instance of the map object
        getStatistic(res.data.results, title);
    } else {
        getStatistic(res.data.results, title);
    }
}

// for display of data to the client
async function getStatistic(data, title) {
    // loop through health profiles
    data.forEach((hp) => {
        const icon = L.icon({
            iconUrl: getIcon(hp.total),
            iconSize: [35, 35], // size of the icon
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62], // the same for the shadow
            popupAnchor: [-3, -90], // point from which the popup should open relative to the iconAnchor
        });

        //initialize marker
        let marker = L.marker([hp.lat, hp.long], { icon })
            .bindPopup(
                `Barangay - ${hp.name} <br> Total ${title} - ${hp.total}`
            )
            .openPopup();

        markers.push(marker);
    });

    // create a layer group
    const barangays = L.layerGroup(markers);

    // initialize / add custom tile layer
    const light = L.tileLayer(
        `https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=${access_token}`,
        {
            // maxZoom: 18,
            id: "mapbox/light-v10",
            tileSize: 512,
            zoomOffset: -1,
            accessToken: access_token,
        }
    );

    const dark = L.tileLayer(
        `https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=${access_token}`,
        {
            maxZoom: 18,
            id: "mapbox/dark-v10",
            tileSize: 512,
            zoomOffset: -1,
            accessToken: access_token,
        }
    );

    const streetMap = L.tileLayer(
        `https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=${access_token}`,
        {
            maxZoom: 18,
            id: "mapbox/streets-v10",
            tileSize: 512,
            zoomOffset: -1,
            accessToken: access_token,
        }
    );

    //initialize map
    //var map = L.map('mapid').setView([14.2471, 121.1367], 13);

    map = L.map("mapid", {
        center: [14.2471, 121.1367],
        zoom: 12,
        layers: [light, barangays],
        scrollWheelZoom: false,
    });

    const overlayMaps = { "List of Barangay": barangays };
    const baseMaps = { light, dark, streetMap };

    // create control layers
    L.control.layers(baseMaps, overlayMaps, { collaps: false }).addTo(map);

    // create legend layer
    const legend = L.control({ position: "bottomright" });

    // create a Legend
    legend.onAdd = function (map) {
        let div = L.DomUtil.create("div", "legend");
        div.innerHTML += `<h4>Total ${title} by Barangay</h4>`;
        div.innerHTML +=
            '<i style="background: #bdc3c7"></i><span>0 - No Record History</span><br>';
        div.innerHTML +=
            '<i style="background: #2ecc71"></i><span>1-50 - Low %</span><br>';
        div.innerHTML +=
            '<i style="background: #f39c12"></i><span>51-100 - Med %</span><br>';
        div.innerHTML +=
            '<i style="background: #e55039"></i><span>More than 100 - High Risk %</span><br>';

        return div;
    };

    legend.addTo(map);

    // add print
    L.control
        .browserPrint({ documentTitle: `Print | Total ${title} 🖨️` })
        .addTo(map);
}

// get icon by total value
function getIcon(value) {
    let marker;
    if (value <= 1) {
        marker = "/img/markers/green-marker.png";
    } else if (value <= 2) {
        marker = "/img/markers/yellow-marker.png";
    } else {
        marker = "/img/markers/red-marker.png";
    }
    return marker;
    // return value <= 1
    //     ? "/img/markers/green-marker.png"
    //     : value <= 2
    //     ? "/img/markers/yellow-marker.png"
    //     : value <= 3
    //     ? "/img/markers/red-marker.png"
    //     : "";
}

async function getStatisticByHealthIssue(health_issue) {
    if (health_issue.value) {
        // get health issue type
        const health_issue_type = $(health_issue)
            .find(":selected")
            .attr("data-value");
        // query
        const res = await axios.get(
            route("city_admin.health_statistic.index"),
            {
                params: { search: health_issue.value },
            }
        );
        map.remove(); // every time we load the data we destroy the instance of the map object
        markers = [];

        getStatistic(res.data.results, `${health_issue_type} Disease`);
    } else {
        window.location.reload();
    }
}

async function getStatisticByFamilyHistory(family_history) {
    log(family_history);
    if (family_history.value) {
        // get health issue type
        const family_history_type = $(family_history)
            .find(":selected")
            .attr("data-value");
        // query
        const res = await axios.get(
            route("city_admin.health_statistic.family_history"),
            {
                params: { search: family_history.value },
            }
        );
        map.remove(); // every time we load the data we destroy the instance of the map object
        markers = [];

        getStatistic(res.data.results, `${family_history} Disease`);
    } else {
        window.location.reload();
    }
}
