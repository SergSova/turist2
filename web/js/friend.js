$('.friend-info').on('click', function () {
    var data = $(this).find('.user_id').text();
    $.post({
        url: location.href,
        data: 'userId=' + data,
        success: function () {
            $.pjax.reload({container: "#friends"});
        }
    })
});

$('.remove-friend').on('click', function () {
    var data = $(this).data('userid')
    $.post({
        url: location.href,
        data: 'removeId=' + data,
        success: function () {
            $.pjax.reload({container: "#users"});
        }
    })
});

// $('#usersearch-username').on('change',function () {
//     $.post({
//         url: location.href,
//         data: 'UserSearch[username]=' + $(this).val(),
//         success: function () {
//             console.log($(this).val());
//             $.pjax.reload({container: "#users"});
//         }
//     })
// });