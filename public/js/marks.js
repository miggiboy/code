 function sendToggleRequest (itemType, itemId) {
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

 $('.university.item').click(function (e) {
    if (e.target == this) {
      $(this).toggleClass('marked');
      sendToggleRequest($(this).attr('itemType'), $(this).attr('itemId'))
    }
});

// Toggle button


function toggleMark (itemType, itemId) {
    sendToggleRequest(itemType, itemId)
    $('#marker').toggleClass('marked');
    changeText();
}

function changeText () {
    if ($('#marker').hasClass('marked')) {
      $('#marker').text('Отмечено')
    } else {
      $('#marker').text('Отметить')
    }
 }
