<a href="{{ route('home') }}/">
<img alt="{{ $image->name }}"
   src="{{ parse_url($image->getUrl('thumb'), PHP_URL_PATH) }}"
   data-image="{{ parse_url($image->getUrl(), PHP_URL_PATH) }}"
   data-description="{{ $image->name }}"
   style="display:none">
</a>
