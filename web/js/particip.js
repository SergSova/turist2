var participCount = 1;
function getOptions(){
    var str = '';
    for(var prop in permissions){
        str += '<option value="'+prop+'">'+permissions[prop]+'</option>';
    }
    return str;
}
function conditionInit(name, condition, index) {
    var condition = '<div class="form-inline card-content" data-count="' + index + '">' +
        '<div class="input-field">'+
        '<label for="particip-title'+index+'">Должность</label>'+
        '<input type="text" id="particip-title'+index+'">'+
        '</div>'+
        '<div class="input-field">'+
        '<select multiple>'+
        '<option selected disabled>Резрешения</option>'+
        getOptions()
        +'</select>'+
        '</div>'+
        '</div>';
    $('.particip_list').prepend(condition);
    if(participCount == 1){
        $('.particip_list').append('<div class="form-group">' +
            '<button type="button" class="btn btn-success btn_saveParticip fullWidth">Сохранить</button></div> ')
    }
    participCount++;
    $('select').material_select();
}
function saveCondition() {
    try {
        var json = JSON.parse($('#event-particip').val());
    } catch (e) {
        var json = {};
    }

    var conditionItems = $(this).parents('.particip_list').children('.form-inline');
    for(var i = 0; i < conditionItems.length; i++){
        var index = $(conditionItems[i]).data('count');
        var name = $(conditionItems[i]).find('#particip-title'+index).val();
        var condition = $(conditionItems[i]).find('select').val();
        console.log(condition);
        json[index] = {};
        json[index][name] = condition;
    }
    json = JSON.stringify(json);
    $('#event-particip').val(json);
    console.log(json);
}
$('#btn_addParticip').click(function () {
    conditionInit('', '', countCondition);


    $('.btn_saveParticip').on('click', saveCondition);
});
$(document).ready(function () {
    try {
        var json = JSON.parse($('#event-particip').val());
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