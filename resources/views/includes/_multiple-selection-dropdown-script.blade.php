<script>
    $(document).ready(function() {
        $('.ui.form').keydown(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              return false;
          }
       });
    });

    $('.ui.dropdown').dropdown({
        fullTextSearch: true,
        match:'text',
        allowAdditions: $allowAdditions,
        keys : {
          delimiter  : false, // comma
    } });
</script>
