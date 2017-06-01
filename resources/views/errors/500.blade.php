<div class="content">
    <div class="title">Внутренняя ошибка на сервере. <br> Пожалуйста заполните поле "What happened?" описанием того что Вы делали перед этим. Далее нажмите на синюю кнопку.<br> Если перед Вами не появилась форма заполнения ошибки в течении 7 секунд - просто переходите назад. </div>
    
    <a href="/">Назад</a>

    @unless(empty($sentryID))
        <!-- Sentry JS SDK 2.1.+ required -->
        <script src="https://cdn.ravenjs.com/3.3.0/raven.min.js"></script>

        <script>
        Raven.setUserContext({
            email: '{{ auth()->user()->email }}',
            name: '{{ auth()->user()->getNameOrUsername() }}'
        });
        Raven.showReportDialog({
            eventId: '{{ $sentryID }}',

            // use the public DSN (dont include your secret!)
            dsn: 'https://9290bde2fc2a4757a05645283e0443d2@sentry.io/154442'
        });
        </script>
    @endunless
</div>