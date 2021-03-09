window.onload = function() {
    $.getJSON("/328/KidsLearn/scripts/animals.json", function (result) {
        //alert(result);
        $.each(result, function (index, item) {
            $("#showAnimals").append(
                "<div class='row' > <div class='col-4  col-sm-5'>"
                + "<img src='" + item.url + "' alt='" + item.name + "'>" +
                "</div> <div class='col-8 col-sm-7'>" +
                "<h3>" + item.name + "</h3>" +
                "<h5>Description: " + item.description + "</h5>" +
                "</div> </div>"
            );
        });
    });
};