<script>
    CKEDITOR.replace('description', {
        height: 350,
        extraPlugins: 'wordcount',
        wordcount: {
            showWordCount: false,
            showCharCount: true,
            maxWordCount: -1,
            maxCharCount: -1,
            showParagraphs: false,
            countSpacesAsChars: false,
            countHTML: false
        }
    });

    CKEDITOR.replace('extra_description', {
      height: 150
    });

    CKEDITOR.replace('reception[info]', {
      height: 350
    });
</script>
