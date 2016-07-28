/**
 * Created by Sova on 28.07.2016.
 */

$('#organizators').change(function () {

    // alert($(this).val());
    var oldHtml = $('#organizators_check').html();

    var text = '<input type="checkbox" name="' + $(this).val() + '" value="' + $(this).val() + '" checked="">' +
        '<label for="' + $(this).val() + '">data</label>';

    $('#organizators_check').html(oldHtml + text);

    alert($('#organizators_check').html());

});

