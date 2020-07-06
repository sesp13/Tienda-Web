//Función para convertir todos los números en formato de moneda

function convertCurrency() {
    $(".currency").each(function() {
        let number = $(this).text();
        let converted = new Intl.NumberFormat("es").format(number);
        $(this).text("$ " + converted);
    });
}

convertCurrency();

//Función para acortar los títulos muy largos
function castTitle() {
    $(".product .product-name").each(function() {
        let text = $(this).text();
        if(text.length > 30){
            text = text.substring(0,30) + " ...";
            $(this).text(text);
        }
    });
}

castTitle();

//Función para acortar los títulos muy largos en la tabla de productos
function castTitleTable() {
    $(".cast-title-table").each(function() {
        let text = $(this).text();
        if(text.length > 18){
            text = text.substring(0,18) + "..";
            $(this).text(text);
        }
    });
}

castTitleTable();
