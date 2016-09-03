var countCondition = 1;

$(document).ready(function () {
    try {
        var json = JSON.parse($('#event-condition').val());
    } catch (e) {
        var json = {};
    }
    if (json) {
        for (var item in json) {
            var index = json[item];
            for (var n in index) {
                conditionInit(n, json[item][n], item);
                // console.log(item);
                // console.log(n);
                // console.log(json[item][n]);
            }
        }

    }

});

$('#btn_addContition').click(function () {
    conditionInit('', '', countCondition);


    $('.btn_saveCondition').on('click', saveCondition);
});

function conditionInit(name, condition, index) {
    var condition = '<div class="form-inline" data-count="' + index + '">' +
        '<div class="input-field field-eventconditionform-name">' +
        '<label class="control-label" for="eventconditionform-name'+index+'">Атрибут</label>' +
        '<input type="text" id="eventconditionform-name'+index+'" class="form-control" value="' + name + '">' +
        '<div class="help-block"></div>' +
        '</div>        <div class="input-field field-eventconditionform-condition">' +
        '<label class="control-label" for="eventconditionform-condition'+index+'">Условие</label>' +
        '<input type="text" id="eventconditionform-condition'+index+'" class="form-control"  value="' + condition + '">' +
        '<div class="help-block"></div>' +
        '</div></div>';
    $('.condition').prepend(condition);
    if(countCondition == 1){
        $('.condition').append('<div class="form-group">' +
            '<button type="button" class="btn btn-success btn_saveCondition fullWidth">Сохранить</button></div> ')
    }
    countCondition++;
}

function saveCondition() {
    try {
        var json = JSON.parse($('#event-condition').val());
    } catch (e) {
        var json = {};
    }

    var conditionItems = $(this).parents('.condition').children('.form-inline');
    for(var i = 0; i < conditionItems.length; i++){
        var index = $(conditionItems[i]).data('count');
        var name = $(conditionItems[i]).find('#eventconditionform-name'+index).val();
        var condition = $(conditionItems[i]).find('#eventconditionform-condition'+index).val();

        json[index] = {};
        json[index][name] = condition;
    }
    json = JSON.stringify(json);
    $('#event-condition').val(json);
    console.log(json);
}