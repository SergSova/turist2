/**
 * Created by Sova on 28.07.2016.
 */

$('#organizators').change(function () {

    var oldHtml = $('#event-organizators').html();
    var text = ' <label><input type="checkbox" name="Event[organizators][]" value="' + $(this).val() + '"' +
        ' checked="">' +
        $('#organizators :selected').html() +
        '</label>';
    $('#event-organizators').html(oldHtml + text);

    console.log($('#event-particip-user_id'));
    var newEl = $('<option value="' + $(this).val() + '">' + $('#organizators :selected').html() + '</option>');
    $('#event-particip-user_id').append(newEl);
    $('#organizators :selected').remove();
});

$("#event-organizators").change(function (event) {
    var target = $(event.target);
    $('#organizators').append($('<option value="' + target.value + '">' + target.parent().text() + '</option>'));
    target.parent().remove();
});


$('#btn_addPartic').click(function () {
    $('#particip').prepend($('<div class="form-inline ">' +
        '<div class="form-group field-event-particip-name has-success">' +
        '<label class="control-label" for="event-particip-name">Particip</label>' +
        '<input type="text" id="event-particip-name" class="form-control" name="Event[particip][name][]">' +
        '<div class="help-block"></div>' +
        '</div>' +
        '  <div class="form-group field-event-particip-user_id has-success">' +
        '<label class="control-label" for="event-particip-user_id">user</label>' +
        '<select id="event-particip-user_id" class="form-control" name="Event[particip][user_id][]">' +
        '<div class="help-block"></div>' +
        '</div></div>'));
});