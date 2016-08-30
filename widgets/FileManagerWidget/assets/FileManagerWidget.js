$(window).on('load', function () {
    var fmwWidget = $('#fmw');
    var fmwInput = $('#fmw-input');
    var fmwPreloader = $('#fmw-preloader');
    var fmwMessageBox = $('#fmw-messageBox');
    var fmwGalleryBox = $('#fmw-galleryBox');

    var messages = {
        error: '<div class="fmw-message alert alert-danger"></div>',
        success: '<div class="fmw-message alert alert-success"></div>'
    };

    function addUploadHandler() {
        fmwInput.fileUpload({uploadUrl: fileManagerWidgetSetting.uploadUrl})
            .on('uploadFile:start', function () {
                fmwPreloader.fadeIn(300);
                $(this).attr('disabled', 'disabled');
            })
            .on('uploadFile:end', function (e, response) {
                fmwPreloader.fadeOut(300);
                try {
                    response = JSON.parse(response);
                    if (response.error) {
                        fmwMessageBox.find('.fmw-message').remove();
                        fmwMessageBox.append($(messages.error).text(response.error));
                        $(this).parent().removeClass('has-success').addClass('has-error');
                        $(this).removeAttr('disabled');
                    } else {
                        fmwMessageBox.find('.fmw-message').remove();
                        $(this).val('').parent().removeClass('has-success').removeClass('has-error');
                        var item = $('<div class="col-lg-6 fmw-galleryBox-item"><img src="' + response.file.url + response.file.path + '"><div class="fmw-actions"><button type="button" class="btn btn-danger fmw-removeBtn" data-path="' + response.file.path + '"><span class="glyphicon glyphicon-remove"></span></button></div>');
                        fmwGalleryBox.append(item);
                        $(this).removeAttr('disabled');
                        addRemoveHandler();
                        addReplaceHandler();
                        addFileToInput(response.file.path);

                    }
                } catch (e) {
                    var text = '<strong>Ошибка парсинга....</strong>';
                    fmwMessageBox.append($(messages.error).text(text));
                }
            });
    }


    function addRemoveHandler() {
        fmwWidget.find('.fmw-removeBtn')
            .removeFile({removeUrl: fileManagerWidgetSetting.removeUrl, attribute: fmwInput.attr('name')})
            .on('removeFile:start', function () {
                fmwPreloader.fadeIn(300);
                fmwInput.attr('disabled', 'disabled');
            })
            .on('removeFile:end', function (e, response) {
                fmwPreloader.fadeOut(300);
                fmwInput.removeAttr('disabled');
                try {
                    response = JSON.parse(response);
                    if (response.error) {
                        fmwMessageBox.find('.fmw-message').remove();
                        fmwMessageBox.append($(messages.error).text(response.error));
                    } else {
                        fmwMessageBox.find('.fmw-message').remove();
                        fmwMessageBox.append($(messages.success).text(response.success));
                        $(this).parents('.fmw-galleryBox-item').remove();
                        $(this).parents('.fmw-notsaved-item').remove();
                        removeFileFromInput($(this).data('path'));
                        if ($('.fmw-notsaved-item').length == 0) {
                            $('.fmw-notsaved').remove();
                        }
                    }
                } catch (e) {
                    var text = '<strong>Ошибка парсинга....</strong>';
                    fmwMessageBox.append($(messages.error).text(text));
                }
            });
    }

    function addReplaceHandler() {
        $('.fmw-replaceBtn').on('click', function () {
            var el = $(this).parents('.fmw-notsaved-item').clone();
            el.removeClass('fmw-notsaved-item').addClass('fmw-galleryBox-item');
            el.find('.fmw-replaceBtn').remove();
            $(this).parents('.fmw-notsaved-item').remove();
            fmwGalleryBox.append(el);
            addFileToInput($(this).data('path'));
            addRemoveHandler();
            if ($('.fmw-notsaved-item').length == 0) {
                $('.fmw-notsaved').remove();
            }
        })
    }

    function addFileToInput(path){
        var targetInput = $('#'+fileManagerWidgetSetting.targetInputId);
        var files = targetInput.val();
        if(files !== '') {
            try {
                files = JSON.parse(files);
            } catch (e) {
                console.info('Parse Error!');
                files = [];
            }
        }else{
            files = [];
        }

        files.push(path);
        if(files.length >= +fileManagerWidgetSetting.maxFiles){
            fmwInput.attr('disabled', 'disabled');
            $('.fmw-replaceBtn').attr('disabled', 'disabled');
        }
        targetInput.val(JSON.stringify(files));

    }

    function removeFileFromInput(path){
        var targetInput = $('#'+fileManagerWidgetSetting.targetInputId);
        var files = targetInput.val();
        if(files !== '') {
            try {
                files = JSON.parse(files);
                for(var i = 0; i < files.length; i++){
                    if(files[i] == path){
                        files.splice(i, 1);
                        break;
                    }
                }
            } catch (e) {
                console.info('Parse Error!');
                files = [];
            }
        }else{
            files = [];
        }
        if(files.length < +fileManagerWidgetSetting.maxFiles){
            fmwInput.removeAttr('disabled');
            $('.fmw-replaceBtn').removeAttr('disabled');
        }
        targetInput.val(JSON.stringify(files));

    }

    addUploadHandler();
    addRemoveHandler();
    addReplaceHandler();
    try{
        var files = JSON.parse($('#'+fileManagerWidgetSetting.targetInputId).val());
        if(files.length >= +fileManagerWidgetSetting.maxFiles){
            fmwInput.attr('disabled', 'disabled');
            $('.fmw-replaceBtn').attr('disabled', 'disabled');
        }
    }catch(e){

    }
});