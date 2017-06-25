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

/**
 * User markers
 */

function sendToggleRequest (itemType, itemId)
 {
  axios.post('/marker', {
        'markable_type': itemType,
        'markable_id': itemId,
    })
    .then(function (response) {
      console.log(response)
    })
    .catch(function (error) {
      console.log(error)
    });
 }

 $('.custom.item').click(function (e)
 {
    if (e.target == this) {
      $(this).toggleClass('marked');
      sendToggleRequest($(this).attr('itemType'), $(this).attr('itemId'))
    }
});

function toggleMark (itemType, itemId)
{
    sendToggleRequest(itemType, itemId)
    $('#marker').toggleClass('marked');
    changeText();
}

function changeText ()
{
    if ($('#marker').hasClass('marked')) {
      $('#marker').text('Отмечено Вами')
    } else {
      $('#marker').text('Отметить для себя')
    }
 }
