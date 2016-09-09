$(document).ready(function () {
    $('select').material_select();
    $('.datepicker').pickadate();
    $('input.autocomplete').autocomplete({
        data: {
            "Apple": null,
            "Microsoft": null,
            "Google": 'http://placehold.it/250x250'
        }
    });

});

const input = document.querySelector('.c-datepicker-input');
const picker = new MaterialDatePicker()
    .on('submit', (val) => {
    input.value = val.format("YYYY-MM-DD HH:mm");
});

input.addEventListener('focus', () => picker.open());
