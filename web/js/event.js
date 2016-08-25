$('#organizators').change(function () {

    var oldHtml = $('#event-organizators').html();
    var text = ' <label><input type="checkbox" name="Event[organizators][]" value="' + $(this).val() + '"' +
        ' checked="">' +
        $('#organizators :selected').html() +
        '</label>';
    $('#event-organizators').html(oldHtml + text);

    var newEl = $('<option value="' + $(this).val() + '">' + $('#organizators :selected').html() + '</option>');
    $('#event-particip-user_id').append(newEl);
    $('#organizators :selected').remove();
});

$("#event-organizators").change(function (event) {
    var target = $(event.target);
    $('#organizators').append($('<option value="' + target.value + '">' + target.parent().text() + '</option>'));
    target.parent().remove();
});


$('.btn_addPartic').click(function () {
    $('#particip').prepend($('<div class="form-inline ">' +
        '<div class="form-group field-event-particip-name">' +
        '<label class="control-label" for="event-particip-name">Particip</label>' +
        '<input type="text" id="event-particip-name" class="form-control">' +
        '<div class="help-block"></div>' +
        '</div>            <button type="button" class="btn_addUser">Назначить</button>' +
        '</div>'));
});

function particEventInit(id, username, foto) {
    console.log(id + ' ' + username + ' ' + foto);
    var item = '<div class="col-lg-3"><div class="">';
    if (foto) {
        item = item + '<img src="/web/storage/' + foto + '" alt="">';
    }
    item = item + '</div><div class="">' + username + '</div></div>';
    $('.particEvents').append(item);
}
$(document).ready(function () {
    if (particEvent) {
        for (var item in particEvent) {
            for (var name in particEvent[item]) {
                particEventInit(item, name, particEvent[item][name]);
            }
        }
    }
});

