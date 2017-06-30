// General scripts

$('.ui.checkbox').checkbox();

$('.ui.dropdown').dropdown();

// Institution map
function showMapReplacementForm() {
    hideButtonMap();
    $('#map-update-form').show();
}

function hideButtonMap() {
    $('#replace-map-button').hide();
    $('#map').hide();
}
