$('#default-study-period').keyup(function () {
    $('.study-period').val(
        $('#default-study-period').val()
    );
});

$('#set-price-to-all').change(function () {
    if ($('#set-price-to-all').is(':checked')) {
        $('.price').val($('#default-price').val())
        setTimeout(function() {
          $("#set-price-to-all").prop('checked', false)
        }, 700);
    }
});

$('.set-price').change(function (event) {
    if ($(this).is(':checked')) {
        let relatedPriceInputId = '#' + $(this).attr('id') + 'input';
        $(relatedPriceInputId).val($('#default-price').val())
    }
});
