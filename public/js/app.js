$('.ui.checkbox').checkbox();

let appUrl = 'selavu.mi:8000';

$('.ui.dropdown').dropdown();

$('.ui.search.universities').search({
    apiSettings: {
        url: "//" + appUrl + "/universities/search/autocomplete?query={query}"
    },
   fields: {
        results     : 'universities',
        title       : 'name',
        description : 'acronym',
        url         : 'url'
    },
    error : {
      noResults   : 'Поиск не дал результатов',
      serverError : 'Произошла ошибка при поиске...',
    },
    minCharacters : 2
});

$('.ui.search.professions').search({
    apiSettings: {
        url: "//" + appUrl + "/professions/search/autocomplete?query={query}"
    },
   fields: {
        results     : 'professions',
        title       : 'name',
        url         : 'url'
    },
    error : {
      noResults   : 'Поиск не дал результатов',
      serverError : 'Произошла ошибка при поиске...',
    },
    minCharacters : 2
});

$('.ui.search.colleges').search({
    apiSettings: {
        url: "//" + appUrl + "/colleges/search/autocomplete?query={query}"
    },
   fields: {
        results     : 'colleges',
        title       : 'name',
        description : 'acronym',
        url         : 'url'
    },
    error : {
      noResults   : 'Поиск не дал результатов',
      serverError : 'Произошла ошибка при поиске...',
    },
    minCharacters : 2
});


$('article').readmore({
  collapsedHeight: 110,
  speed: 500,
  moreLink: '<a href="#">Показать полностью</a>',
  lessLink: '<a href="#">Свернуть текст</a>'
});
