"use strict";

$(function () {
    var continentLinks = document.querySelectorAll(".card-continents");

    continentLinks.forEach(function (el) {
        el.onclick = function () {
            location.href = el.getElementsByTagName("a")[0].href;
        };
    });
});
