window.onload = function() {
    $.getJSON("/328/KidsLearn/scripts/shapes.json", function (result) {
        //alert(result);
        $.each(result, function (index, item) {
            $("#showShapes").append(
                "<div class='row' > <div class='col-4  col-sm-5'>"
                + "<img class='image-list'src='" + item.url + "' alt='" + item.name + "'>" +
                "</div> <div class='col-8 col-sm-7'>" +
                "<h3>" + item.name + "</h3>" +
                "<h5>Sides: " + item.sides + "</h5>" +
                "<h5>Description: " + item.description + "</h5>" +
                "</div> </div>"
            );
        });
    });
};