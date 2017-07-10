function disableButtons(id)
{
    $('#delete-media-' + id).removeClass('yellow').addClass('disabled')
    $('#delete-media-' + id).text('Удалено')

    $('#toggle-logo-button-' + id).addClass('disabled')
}

function deleteMedia (id)
{
    disableButtons(id)
    axios.delete('/institutions/media/' + id + '/destroy')
      .then(function (response) {
          console.log(response)
      })
      .catch(function (error) {
          console.log(error)
      })
}

function toggleLogoButtonText (id)
{
    let buttonText = $('#toggle-logo-button-' + id).text()

    if (buttonText == 'Является логотипом') {
        $('#toggle-logo-button-' + id).text('Сделать логотипом')

    } else {
        $('#toggle-logo-button-' + id).text('Является логотипом')
    }
}

function toggleLogo (institution, image)
{
    toggleLogoButtonText(image)

    axios.patch('/institutions/' + institution + '/logos/' + image)
      .then(function (response) {
          console.log(response)
      })
      .catch(function (error) {
          console.log(error)
      })
}
