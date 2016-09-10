function autocomplete(){
    $.post(requestUsersUrl, 'search='+$('input.autocomplete').val(), function(responce){
        try{
            responce = JSON.parse(responce);
        }catch(e){
            responce = [];
        }
        var result = '';
        if(responce.length > 0){
            for(var i = 0; i < responce.length; i++){
                result += '<li id="user-'+responce[i].id+'"><img src="'+responce[i].photo+'" class="right circle"><span>'+responce[i].username+'</span></li>'
            }
        }else{
            result = '<li><span>Ничего не найдено</span></li>'
        }

        var list = '<ul class="autocomplete-content dropdown-content">'+result+'</ul>';
        $(list).appendTo($('#autocomplete-input').parent());

        $('.autocomplete-content li').on('click', function(){
            if($(this).get(0).hasAttribute('id')) {
                $('#autocomplete-input').val($(this).find('span').text());
                $('#add-org').removeClass('disabled').removeAttr('disabled').attr('data-userId', $(this).attr('id').substr($(this).attr('id').lastIndexOf('-') + 1));
                autocompleteDestroy();
            }
        })

    })
}
function autocompleteDestroy(){
    $('.autocomplete-content').remove();
}

$('#autocomplete-input').on('keyup', function(){
    autocompleteDestroy();
    $('#add-org').addClass('disabled').removeAttr('data-userId').attr('disabled', 'disabled');
    if($(this).val().length > 3){
        autocomplete();
    }
});