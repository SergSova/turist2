var countCondition = 1;

$(document).ready(function () {
    try {
        var json = JSON.parse($('#event-condition').val());
    } catch (e) {
        var json = {};
    }
    if(json){
        for(var item in json){
            var index = json[item];
            for(var n in index){
                conditionInit(n,json[item][n],item);
                // console.log(item);
                // console.log(n);
                // console.log(json[item][n]);
            }
        }

    }

});

$('#btn_addContition').click(function () {
    conditionInit('','',countCondition);


    $('.btn_saveCondition').on('click', saveCondition);
});

function conditionInit(name,condition,index){
    var condition = '<div class="form-inline">' +
        '<div class="form-group field-eventconditionform-name">' +
        '<label class="control-label" for="eventconditionform-name">Атрибут</label>' +
        '<input type="text" id="eventconditionform-name" class="form-control" value="'+name+'">' +
        '<div class="help-block"></div>' +
        '</div>        <div class="form-group field-eventconditionform-condition">' +
        '<label class="control-label" for="eventconditionform-condition">Условие</label>' +
        '<input type="text" id="eventconditionform-condition" class="form-control"  value="'+condition+'">' +
        '<div class="help-block"></div>' +
        '</div><div class="form-group">' +
        '<button type="button" class="btn btn-success btn_saveCondition" data-count="'+index+'">Сохранить</button></div>    </div>';
    $('.condition').append(condition);
    countCondition++;
}

function saveCondition() {
    try {
        var json = JSON.parse($('#event-condition').val());
    } catch (e) {
        var json = {};
    }
    var name = $(this).parent().parent().find('#eventconditionform-name').val();
    var condition = $(this).parent().parent().find('#eventconditionform-condition').val();
    var i = $(this).data('count');
    json[i]={};
    json[i][name]=condition;

    json = JSON.stringify(json);
    $('#event-condition').val(json);
    console.log(json);
}