$('.ui.checkbox').checkbox();

$('.ui.dropdown').dropdown({
    fullTextSearch: true,
    match:'text',
    allowAdditions: false,
    direction: 'downward',
    keys : {
      delimiter  : false, // comma
    }
});

function confirmDeletion(deletionFormId, itemTitle) {
    var doDelete = confirm('Вы уверены что хотите удалить \"' + itemTitle + '\" ?\n\nВосстановить данные будет невозможно!');

    if (doDelete) {
        submitForm(deletionFormId);
    }
}

function confirmSpecialtyTypeUpdate(updatingFormId, itemTitle, newType) {
    var proceed = confirm('Вы уверены что хотите сделать \"' + itemTitle + '\" ' + newType + ' ?');

    if (proceed) {
        submitForm(updatingFormId);
    }
}
