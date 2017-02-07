$(function () {

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();
    $('a[data-toggle="modal"]').mouseover().tooltip();
    $('#js-confirm-delete').on('show.bs.modal', function (event) {
        var form = $(event.relatedTarget).data('form');
        var modal = $(this);
        modal.find('#js-btn-suppression').replaceWith(form);
    });

    // select2
    $('.select2').select2();

    // fancy delete
    $('#confirm-delete').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    var dateNow = new Date();
    $('.datetimepicker').datetimepicker({
        format: 'DD/MM/YYYY HH:mm',
        defaultDate: dateNow
    });

});

// highlighting
hljs.initHighlightingOnLoad();