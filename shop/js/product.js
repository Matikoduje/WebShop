$(document).ready(function () {

    function checkQuantity(value) {
        if (value <= 0) {
            return false;
        } else if (isNaN(value)) {
            return false;
        } else if (parseInt(value) != value) {
            return false;
        }
        return true;
    }

    function getIdFromUrl() {
        var url = window.location.href;
        url = url.split('?')[1];
        if (url.substring(0, 4) === 'id=%') {
            url = url.substring(6);
            if ($.isNumeric(url) && url >= 0) {
                return url;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    var itemRequest;
    var listCategories = $('#listCategories');
    var productDetail = $('#productDetail');

    var id = getIdFromUrl();
    if (id !== null) {
        itemRequest = $.ajax({
            url: "api/product.php",
            type: "get",
            cache: false,
            dataType: "json",
            data: {id: id}
        });

        itemRequest.done(function (response) {
            if (response.error === 1) {
                window.setTimeout(function () {
                    window.location.href = "index.php";
                }, 3);
            }
            $.each(response.prodCat, function (index, value) {
                var listEl = $('<li class="list-group-item"></li>');
                listEl.text(value.name);
                listEl.attr('data-id', value.id);
                listCategories.append(listEl);
            });
            if (readCookie('token') !== false) {
                var element = $('<div class="thumbnail">' +
                    '<img style="height: 300px; width: 800px" src="' + response.prod.url[0] + '" alt="' + response.prod.name + '">' +
                    '<div class="caption-full">' +
                    '<h4 class="pull-right">' + response.prod.price + ' zł' + '</h4>' +
                    '<h4><a href="#">' + response.prod.name + '</a></h4>' +
                    '<p>' + response.prod.description + '</p>' +
                    '<p><label for="quantity">Ilość:</label><input id="quantityI" value="1" type="number" name="quantity" step="1" min="1">' +
                    '<br><button type="button" id="btnAdd" class="btn-sm btn-primary">Dodaj do koszyka</button></p></div></div>');
                $('body').on('click', '#btnAdd', function (e) {
                    var quantity = $('#quantityI').val();
                    if (checkQuantity(quantity)) {
                        var requestAddItems;
                        var token = readCookie('token');
                        requestAddItems = $.ajax({
                            url: "api/basket.php",
                            type: "post",
                            dataType: "json",
                            data: {id: response.prod.id, quantity: quantity, jsSession: token}
                        });

                        requestAddItems.done(function (basketInfo) {
                            console.log(basketInfo.error);
                        });
                    }
                });
            } else {
                var element = $('<div class="thumbnail">' +
                    '<img style="height: 300px; width: 800px" src="' + response.prod.url[0] + '" alt="' + response.prod.name + '">' +
                    '<div class="caption-full">' +
                    '<h4 class="pull-right">' + response.prod.price + ' zł' + '</h4>' +
                    '<h4><a href="#">' + response.prod.name + '</a></h4>' +
                    '<p>' + response.prod.description + '</p>' +
                    '</div></div>');
            }
            productDetail.append(element);
        });
    } else {
        window.setTimeout(function () {
            window.location.href = "index.php";
        }, 3);
    }

});