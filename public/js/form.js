function errorize(elementId) {
    var inputParent = document.getElementById(elementId).parentElement;

    if (! hasClass(inputParent, 'error')) {
      document.getElementById(elementId).parentElement.className += ' error';
    }
}

function hasClass(element, className) {
    return element.classList.contains(className);
}

function isSelected(selectId) {
    return document.getElementById(selectId).value != "";
}

function fileIsUploaded(fileInputId) {
    return document.getElementById(fileInputId).value != "";
}

function setButtonStatus(buttonId, status) {
    document.getElementById(buttonId).className += ' ' + status;
}

function submitForm(elementId) {
    document.getElementById(elementId).submit();
}
