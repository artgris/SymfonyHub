//tiny
initializeTinyMce(".tinymce", 'p');
initializeTinyMce(".tinymcenoforce");
function initializeTinyMce(selector, forced) {
    tinymce.init({
        selector: selector,
        theme: "modern",
        skin: "lightgray",
        plugins: [
            "advlist autolink link image lists charmap hr anchor pagebreak template",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons template paste textcolor"
        ],
        // content_css: ['/css/style.css', '/css/admin/tinymce.css'],
        body_class: 'edit',
        image_dimensions: false,
        height: 350,
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor | code",
        extended_valid_elements: "div[*],meta[*],span[*]",
        valid_children: "+body[meta],+div[h2|span|meta|object],+object[param|embed]",
        relative_urls: false,
        valid_elements: '*[*]',
        forced_root_block: forced ? 'p' : '',
        remove_script_host: false,
        //document_base_url: 'http://{{ host }}',
        entity_encoding: "raw",
        language: "fr_FR",
        // pour avoir les url en full
        //convert_urls : true,
        convert_urls: false,
        paste_as_text: true
    });
}