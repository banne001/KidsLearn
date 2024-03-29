/**
 * Blezyl Santos and Sarah Mehri
 * Kids Learn Website
 * Version 1.0
 * Load JSON-encoded data from the server using a GET HTTP request.
 * loops through the requested result, builds an div,
 * and appends it to the showFruit id.
 */

window.onload = function() {
    $.getJSON("/328/KidsLearn/scripts/fruits.json", function (result) {

        $.each(result, function (index, item) {
            $("#showFruits").append(
                "<div class='row' > <div class='col-4  col-sm-5'>"
                + "<img class='image-list' src='" + item.url + "' alt='" + item.name + "'>" +
                "</div> <div class='col-8 col-sm-7'>" +
                "<h3>" + item.name + "</h3>" +
                "<h5>Color: " + item.color + "</h5>" +
                "<h5>Description: " + item.description + "</h5>" +
                "</div> </div>"
            );
        });
    });
};