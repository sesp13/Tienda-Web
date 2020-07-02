//Función para convertir todos los números en formato de moneda

function convertCurrency() {
    $(".currency").each(function() {
        let number = $(this).text();
        let converted = new Intl.NumberFormat("es").format(number);
        $(this).text("$ " + converted);
    });
}

convertCurrency();
