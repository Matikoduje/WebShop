$(document).ready(function () {
    var mainRequest;
    var listCategories = $('#listCategories');
    var rowForProd = $('#for3Products');
    mainRequest = $.ajax({
        url: "api/main.php",
        type: "get",
        cache: false,
        dataType: "json"
    });

    mainRequest.done(function (response) {
        $.each(response.prodCat, function (index, value) {
            var listEl = $('<li class="list-group-item"></li>');
            listEl.text(value.name);
            listEl.attr('data-id', value.id);
            listCategories.append(listEl);
        });
        $.each(response.last3, function (index, value) {
            var element = $('<div class="col-sm-4 col-lg-4 col-md-4">' +
                '<div class="thumbnail">' +
                '<img style="height: 150px; width: 320px" src="' + value.url[0] + '" alt="' + value.name + '">' +
                '<div class="caption">' +
                '<h4 class="pull-right">' + value.price + ' zł' + '</h4>' +
                '<h4><a href="item.php?id= ' + value.id + '">' + value.name + '</a></h4>' +
                '<p>' + value.description + '</p></div></div></div>');
            rowForProd.append(element);
        });
    });
});