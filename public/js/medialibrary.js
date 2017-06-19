function deactivateButtons(id)
{
    $('#delete-media-' + id).removeClass('yellow').addClass('disabled')
    $('#delete-media-' + id).text('Удалено')

    $('#toggle-logo-button-' + id).addClass('disabled')
}

function deleteMedia (modelType, id)
{
    deactivateButtons(id)
    axios.delete('/' + modelType + '/media/' + id)
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

function toggleLogo (modelId, modelType, id)
{
    toggleLogoButtonText(id)

    axios.patch('/' + modelType + '/' + modelId + '/media/' + id)
      .then(function (response) {
          console.log(response)
      })
      .catch(function (error) {
          console.log(error)
      })
}
