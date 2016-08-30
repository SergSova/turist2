(function ($) {
    //
    var settings = {};

    function upload() {
        var self = $(this);
        self.trigger('uploadFile:start');
        var file = this.files[0];
        var form = new FormData();
        form.append(self.attr('name'), file);

        $.ajax({
            url: settings.uploadUrl,
            type: 'POST',
            contentType: false,
            processData: false,
            data: form,
            success: function (response) {
                self.trigger('uploadFile:end', [response]);
            }
        });
    }

    $.fn.fileUpload = function (options) {
        settings = $.extend(settings, options);
        return this.each(function () {
            $(this).on('change', upload);
        });
    }
})(jQuery);

(function ($) {
    var settings = {};

    function remove(el) {
        el.trigger('removeFile:start');
        var attribute = settings.attribute;
        var path = el.data('path');
        $.ajax({
            url: settings.removeUrl,
            type: 'POST',
            data: attribute + '=' + path,
            success: function (response) {
                el.trigger('removeFile:end', [response]);
            }
        });
    }

    $.fn.removeFile = function (options) {
        settings = $.extend(settings, options);
        return this.each(function () {
            $(this).on('click', function () {
                remove($(this));
            });
        });
    }
})(jQuery);