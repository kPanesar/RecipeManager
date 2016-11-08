$('#ingredient_btn').click(function () {
    var $view = '<div class="row"><div class="col-sm-1"><div class="form-group">' +
        '<label for="quantity">Quantity</label>' +
        '<input id="quantity" name="quantity" type="text" placeholder="Quantity"></div></div>' +
        '<div class="col-sm-1"><div class="form-group">' +
        '<label for="unit">Unit</label> ' +
        '<input id="unit" name="unit" type="text" placeholder="Unit"> </div> </div> ' +
        '<div class="col-sm-1"><div class="form-group">' +
        '<label for="ingredient_name">Ingredient</label>' +
        '<input id="ingredient_name" name="ingredient_name" type="text" placeholder="Ingredient Name"> </div></div></div>';
    $('#ingredient_area').append($view);
});