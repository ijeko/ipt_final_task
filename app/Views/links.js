toasts()
$(document).ready(function () {
    $(".toast").toast('show');
});

function toasts() {
    document.querySelector("#toasts").innerHTML = ' '

    $.ajax({
        type: "post",
        url: '/public/links/show',
        data: {'data': 'data'},
        success: function (res) {
            toast = ''
            var toastData = JSON.parse(res)
            for (var i = 0; i < toastData.length; i++) {
                toast = '<div role="alert" aria-live="assertive" aria-atomic="true" class="toast show fade" data-autohide="false" id=toast"' + toastData[i].id + '">' +
                    '<div class="toast-header justify-content-between"><a href="' + toastData[i].fullurl +
                    '" target="_blank" title="Удалить">' +
                    '<strong class="mr-auto shorturl">' + toastData[i].shorturl +
                    '</strong>' +
                    '</a>' +
                    '<small></small><button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" id="dl" name="dl" value="' + toastData[i].id + '"' +
                    '><span aria-hidden="true">&times;</span></button></div>' +
                    '<div class="toast-body fullurl">' + toastData[i].fullurl +
                    '</div></div>' + toast;
            }
            document.querySelector("#toasts").insertAdjacentHTML("afterbegin", toast)
            $('.close').click(function ()
            {
                data =  {'id': this.value};
                data = JSON.stringify(data);
                $.ajax({
                    type: "post",
                    url: '/public/links/delete',
                    data: {'data': data},
                    success: function (res)
                    {
                        data = JSON.parse(res)
                        toasts()
                    }
                });
            });

        }

    });

}

let addlink = document.querySelector("#addlink");

function clearForm() {
    var inputs = document.querySelectorAll('.input');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = '';
    }
}

function validateUrl(value) {
    return /^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:[/?#]\S*)?$/i.test(value);
}


addlink.onclick = function () {
    let fullurl = document.querySelector("#fullurl").value;
    let shorturl = document.querySelector("#shorturl").value;
    // let user_id = <?=json_encode($user_id)?>;

if (!validateUrl(fullurl) && fullurl) {
document.querySelector("#message").textContent = 'Некорректный URL, формат адреса "http или https://ваш.адрес"';
document.querySelector("#message").setAttribute('class', 'alert alert-danger');
            return false;
        }
        data = {'fullurl': fullurl, 'shorturl': shorturl, 'user_id': user_id};
        data = JSON.stringify(data);
        $.ajax({
            type: "post",
            url: '/public/links/add',
            data: {'data': data},
            success: function (res) {
                let response = JSON.parse(res);
                if (response.status == 'failed') {
                    document.querySelector("#message").textContent = response.message;
                    document.querySelector("#message").setAttribute('class', 'alert alert-danger');
                }
                if (response.status == 'exists') {
                    document.querySelector("#message").textContent = response.message;
                    document.querySelector("#message").setAttribute('class', 'alert alert-danger');
                }
                if (response.status == 'pass') {
                    document.querySelector("#toasts").insertAdjacentHTML("afterbegin", '<span></span>')
                    document.querySelector("#message").textContent = response.message;
                    document.querySelector("#message").setAttribute('class', 'alert alert-success');
                    toasts()
                    clearForm()
                    setTimeout(function () {
                        clearForm()
                        document.querySelector("#message").setAttribute('hidden', 'true')
                    }, 1500);
                }

            },
            error: function (res) {
                alert('Ошибка сервера');
                window.location = '/';
            }
        });
    }