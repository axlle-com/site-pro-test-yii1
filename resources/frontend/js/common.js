const axSetLocation = function (curLoc) {
    try {
        window.location.href = curLoc;
        return;
    } catch (e) {
    }
}
const errorResponse = function (response) {
    if (response && response.responseJSON && response.responseJSON.status_code === 400) {
        let error = response.responseJSON.error;
        if (error && Object.keys(error).length) {
            for (let key in error) {
                let selector = `[data-validator="${key}"]`;
                $(selector).addClass('is-invalid');
                let errorTag = $(selector).closest('.form-label-group').find('.invalid-feedback');
                let string = '';
                for (let index in error[key]) {
                    string += error[key][index] + ' ';
                }
                errorTag.html(string);
                errorTag.show();
            }
        }
    }
}
const errorResponseClear = function (form) {
    let input = form.find('.is-invalid');
    input.removeClass('is-invalid');
    form.find('.invalid-feedback').html('');
}

/********* Start User *********/
function userRegistrationFormSend() {
    $('.js-registration').on('click', '.js-registration-user-submit-button', function (e) {
        e.preventDefault();
        let form = $(this).closest('#registration-user-form');
        errorResponseClear(form);
        let data = new FormData(form[0]);
        $.ajax({
            url: '/ajax/registration',
            type: 'POST',
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
            },
            success: function (response) {
                if (response.status) {
                    form[0].reset();
                    let block = $('.js-registration .js-qr');
                    let html = response.data.view;
                    block.html(html);
                    block.closest('.card').slideDown();
                    if (response.data.url) {
                        axSetLocation(response.data.url);
                    }
                }
            },
            error: function (response) {
                errorResponse(response);
            },
            complete: function () {
            }
        });
    });
}

function userLoginFormSend() {
    $('.js-login').on('click', '.js-login-user-submit-button', function (e) {
        e.preventDefault();
        let form = $(this).closest('#login-user-form');
        errorResponseClear(form);
        let data = new FormData(form[0]);
        $.ajax({
            url: '/ajax/login',
            type: 'POST',
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
            },
            success: function (response) {
                if (response.status) {
                    if (response.data.url) {
                        axSetLocation(response.data.url);
                    }
                }
            },
            error: function (response) {
                errorResponse(response);
            },
            complete: function () {
            }
        });
    });
}

/********* End User *********/
$(document).ready(function () {
    userRegistrationFormSend();
    userLoginFormSend();
})