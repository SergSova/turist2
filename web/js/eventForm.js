function addOrg(){
    var userId = $(this).data('userid');
    var userName = $('#autocomplete-input').val();

    var el = '<div class="collection-item" id="userlist-'+userId+'"><a href="'+userUrl+'?id='+userId+'">'+userName+'</a><div class="secondary-content right-align"><button type="button" class="btn-floating btn-small waves-effect waves-light red " ><i class="material-icons removeOrg" data-userId="'+userId+'">remove</i></button></div></div>';
    $(el).appendTo($('#org_list')).on('click', function(e){
        if($(e.target).hasClass('removeOrg')){
            removeOrgFromInput($(e.target).data('userid'))
            $('#userlist-'+$(e.target).data('userid')).remove();
        }
    });

    addOrgToInp({
        id: userId,
        userName: userName
    });
    $('#autocomplete-input').val('');
    $('#add-org').addClass('disabled').removeAttr('data-userId').attr('disabled', 'disabled');


}

function removeOrgFromInput(id){
    var value = $('#organizators').val();
    var orgs = [];
    if(value.length > 0 ){
        orgs = JSON.parse(value);
        for(var i = 0; i < orgs.length; i++){
            if(id == orgs[i].id){
                orgs.splice(i, 1);
                break;
            }
        }
    }
    $('#organizators').val(JSON.stringify(orgs));
}

function addOrgToInp(data){
    var value = $('#organizators').val();
    var orgs = [];
    if(value.length > 0 ){
        orgs = JSON.parse(value);
    }
    orgs.push(data);
    $('#organizators').val(JSON.stringify(orgs));
}

function addRules(){
    var ruleName = $('#rule-name').val();
    var rules = $('#rules-select').val();
    var id = $('.collection-item').length;

    var el = '<li class="collection-item" id="rule-'+id+'"><button type="button" class="btn-floating btn-small waves-effect waves-light red right"><i class="material-icons removeRule" data-ruleid="'+id+'">remove</i></button><span class="title">'+ruleName+'</span><p><strong>Права: </strong>'+rules.join(', ')+'</p></li>';
    $('#rules-list').append(el);
    $('.removeRule').on('click', function(){
        removeRuleFromInput($(this).data('ruleid'))
    });
    $('#rule-name').val('');
    $('select').material_select('destroy');
    $('#rules-select').val('');
    $('select').material_select();
    addRuleToInput({
        id: id,
        name: ruleName,
        rules: rules,
    });
}

function addRuleToInput(data){
    var value = $('#particip').val();
    var orgs = [];
    if(value.length > 0 ){
        orgs = JSON.parse(value);
    }
    orgs.push(data);
    $('#particip').val(JSON.stringify(orgs));
}

function removeRuleFromInput(id){
    var value = $('#particip').val();
    var orgs = [];
    if(value.length > 0 ){
        orgs = JSON.parse(value);
        for(var i = 0; i < orgs.length; i++){
            if(id == orgs[i].id){
                orgs.splice(i, 1);
                break;
            }
        }
    }
    $('#particip').val(JSON.stringify(orgs));
    $('#rule-'+id).remove();
}

$('#rule-name').on('keyup', function(){
    if($(this).val().length > 3){
        $('#add-rule').removeAttr('disabled').removeClass('disabled');
    }else{
        $('#add-rule').attr('disabled', 'disabled').addClass('disabled');
    }
})

$('#add-org').on('click', addOrg);
$('.removeOrg').on('click', function(){
    removeOrgFromInput($(this).data('userid'))
});
$('.removeRule').on('click', function(){
    removeRuleFromInput($(this).data('ruleid'))
});
$('#add-rule').on('click', addRules);
$(document).ready(function () {
    $('select').material_select();
});