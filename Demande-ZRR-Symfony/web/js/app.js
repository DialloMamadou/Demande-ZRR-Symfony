$(document).on('change', '#activite_domainescientifique, #activite_disciplinescientifique', function () {
    let $field = $(this)
    let $form = $field.closest('form')
    let data = {}
    data[$field.attr('name')] = $field.val()
    // On soumet les données
    $.post($form.attr('action'), data).then(function (data) {
        // On récupère le nouveau <select> c'est à dire discipline scientifique
        let $input = $(data).find('#activite_disciplinescientifique')
        // On remplace notre <select> actuel
        $('#activite_disciplinescientifique').replaceWith($input)
    })
})