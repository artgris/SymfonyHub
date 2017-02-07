var dataTableLanguage = {
    "sProcessing": "Traitement en cours...",
    "sSearch": "Rechercher :",
    "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
    "sInfo": "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
    "sInfoEmpty": "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
    "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
    "sInfoPostFix": "",
    "sLoadingRecords": "Chargement en cours...",
    "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
    "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
    "oPaginate": {
        "sFirst": "Premier",
        "sPrevious": "Pr&eacute;c&eacute;dent",
        "sNext": "Suivant",
        "sLast": "Dernier"
    },
    "oAria": {
        "sSortAscending": ": activer pour trier la colonne par ordre croissant",
        "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
    }
};

// Sort datatable
jQuery.extend(jQuery.fn.dataTableExt.oSort, {
    "date-uk-pre": function (a) {
        var ukDatea = a.split('/');
        return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
    },

    "date-uk-asc": function (a, b) {
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    },

    "date-uk-desc": function (a, b) {
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    }
});

/**
 * Créer une liste au dessus de la colonne spécifiée
 * @param column
 */
function createSelectFromColumn(column) {
    var select = $('<select class="select-datatable form-control input-sm container-full"><option value="">Toutes</option></select>')
        .appendTo($(column.header()))
        .on('change', function () {
            var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
            );

            column
                .search(val ? '^' + val + '$' : '', true, false)
                .draw();
        });

    column.data().unique().sort().each(function (d, j) {
        select.append('<option value="' + d + '">' + d + '</option>')
    });
    select.click(function (e) {
        e.stopPropagation();
    })
}
/**
 * Créé un input au dessus de la colonne spécifiée
 * @param column
 * @param placeholder
 */
function createInputFromColumn(column, placeholder) {
    var input = $('<br/><input class="form-control input-sm container-full" type="text" placeholder="' + placeholder + '" />')
        .appendTo($(column.header()))
        .on('keyup', function () {
            var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
            );
            column
                .search(val ? '.*' + val + '.*' : '', true, false)
                .draw();
        });

    input.click(function (e) {
        e.stopPropagation();
    })
}

//source : https://cdn.datatables.net/plug-ins/1.10.7/sorting/datetime-moment.js
$.fn.dataTable.moment = function (format, locale) {
    var types = $.fn.dataTable.ext.type;

    // Add type detection
    types.detect.unshift(function (d) {
        // Null and empty values are acceptable
        if (d === '' || d === null) {
            return 'moment-' + format;
        }

        return moment(d.replace ? d.replace(/<.*?>/g, '') : d, format, locale, true).isValid() ?
        'moment-' + format :
            null;
    });

    // Add sorting method - use an integer for the sorting
    types.order['moment-' + format + '-pre'] = function (d) {
        return d === '' || d === null ?
            -Infinity :
            parseInt(moment(d.replace ? d.replace(/<.*?>/g, '') : d, format, locale, true).format('x'), 10);
    };
};
$(function () {

    $('#js-datatable-user').dataTable({
        'language': dataTableLanguage,
        "order": [[0, "asc"]],
        "bFilter": false,
        stateSave: true,
        "columnDefs": [
            {"width": "4%", "targets": [0, 3, 4]},
            {"targets": 4, "orderable": false}
        ]
    });

});