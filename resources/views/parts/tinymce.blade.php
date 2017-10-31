<script src="/js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({
        selector: 'textarea',
        theme: 'modern',
        plugins: 'code preview image link table pagebreak lists textcolor',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | image table pagebreak lists textcolor code',
        image_advtab: true,
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
        ],
        menubar: false,
        relative_urls: false,
        remove_script_host: false,
        images_upload_url: '/upload/image',
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/upload/image?_token={{csrf_token()}}');

            xhr.onload = function () {
                var json;

                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.location);
            };

            formData = new FormData();
            formData.append('image', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        }

//        init_instance_callback: function (ed) {
//            ed.execCommand('mceImage');
//        }
    });
</script>