/**
 * Яндекс карты, отметки
 */
document.addEventListener("DOMContentLoaded", loadData);
ymaps.ready(init)
function init() {
    loadData();
    var map = new ymaps.Map("map", {
        center: [55.76, 37.64],
        zoom: 10
    })
    map.controls.remove('searchControl');

    for (i = 0; i < window.COORDINATES_DATA.length; ++i) {
        if  (window.COORDINATES_DATA[i].coordinates) {
            var mark = new ymaps.Placemark(JSON.parse(window.COORDINATES_DATA[i].coordinates), {
                balloonContent: '<b>'
                                + window.COORDINATES_DATA[i].address
                                + '</b><br>'
                                + window.COORDINATES_DATA[i].description
            })

            map.geoObjects.add(mark);
            console.log(window.COORDINATES_DATA[i].coordinates);
        }
    }
}

/**
 * AJAX запрос координат по нашему API
 * @param url
 * @param cFunction
 */
function loadData() {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.COORDINATES_DATA = JSON.parse(this.responseText).data
        }
    };
    xhttp.open("GET", '/api/billboards', true);
    xhttp.send();
}
