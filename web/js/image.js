// Gestion du formulaire :
function readURL(input, $row) {
    var $img = $row.find('.js-img');
    var $inputText = $row.find('input[type=hidden]');

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $img.show();
            $img.attr('src', e.target.result);
            $inputText.attr('value', input.files[0].name);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function refreshThumbnail() {
    $(".form-with-image input[type=file]").change(function () {

        readURL(this, $(this).closest('.blockimg'));

    });
}

refreshThumbnail();