let login = document.querySelector("#login");
// document.querySelector("#login button[name='login']");

function clearForm() {
    var inputs = document.querySelectorAll('.input');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = '';
        inputs[i].setAttribute('disabled', true);
    }
}

function validEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
}

login.onclick = function () {
    let userEmail = document.querySelector("#email").value;
    let userPassword = document.querySelector("#password").value;

    if (!validEmail(userEmail)) {
        document.querySelector("#message").textContent = "Некорректный email";
        document.querySelector("#message").setAttribute('class', 'alert alert-danger');
        return false;
    }
    data = {'email': userEmail, 'password': userPassword};
    data = JSON.stringify(data);
    $.ajax({
        type: "post",
        url: 'auth',
        data: {'data': data},
        success: function (res) {
            let response = JSON.parse(res);
            if (response.status == 'failed') {
                document.querySelector("#message").textContent = response.message;
                document.querySelector("#message").setAttribute('class', 'alert alert-danger');
            }

            if (response.status == 'pass') {
                document.querySelector("#message").textContent = response.message;
                document.querySelector("#message").setAttribute('class', 'alert alert-success');
                clearForm()
                setTimeout(function () {
                    value = window.location = 'user/home';
                }, 1500);
            }
            if (response.status == 'auth') {
                document.querySelector("#message").textContent = response.message;
                document.querySelector("#message").setAttribute('class', 'alert alert-danger');
                setTimeout(function () {
                    value = window.location = 'guest/login';
                }, 1500);
            }

        },
        error: function (res) {
            alert('Ошибка сервера');
            window.location = '/public';
        }
    });

}