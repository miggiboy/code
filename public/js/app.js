// General scripts

$('.ui.checkbox').checkbox();

$('.ui.dropdown').dropdown();

$('.icon').popup();

// Institution map
function confirmMapDeletion() {
  $delete = confirm('Вы действительно хотите удалить карту?');
  if ($delete) $('#delete-map-form').submit();
}
