$('.ui.checkbox').checkbox();

$('.ui.dropdown').dropdown();

$('.icon').popup();

function confirmDeletion(deletionFormId, itemTitle) {
    var doDelete = confirm('Вы уверены что хотите удалить \"' + itemTitle + '\" ?\n\nВосстановить данные будет невозможно!');

    if (doDelete) {
        submitForm(deletionFormId);
    }
}
