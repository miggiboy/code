<script>
    $('{{ $search_class }}').search({
      apiSettings: {
          url: '{{ Config::get('app.url') . '/' . $path . "?query={query}" }}'
     },
     fields: {
          results     : 'results',
          title       : 'title',

          @isset ($fields['description'])
            description: '{{ $fields['description'] }}',
          @endisset

          @isset ($fields['url'])
            url : '{{ $fields['url'] }}',
          @endisset
      },
      error : {
        noResults   : 'Поиск не дал результатов',
        serverError : 'Произошла ошибка при поиске...',
      },
      minCharacters : 2
  });

</script>
