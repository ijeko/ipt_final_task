let register = document.querySelector("#register button[name='register']");

function clearForm() {
    var inputs = document.querySelectorAll('.input');
    // document.querySelector("#message").textContent = "";
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = '';
        inputs[i].setAttribute('disabled', true);
    }
}

function validEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
}

register.onclick = function () {
    let userName = document.querySelector("#username").value;
    let userEmail = document.querySelector("#email").value;
    let userPassword = document.querySelector("#password").value;




    data = {'username': userName, 'email': userEmail, 'password': userPassword};
    data = JSON.stringify(data);
    $.ajax({
        type: "post",
        url: 'guest/adduser',
        data: {'data': data},
        success: function (res) {
            let response = JSON.parse(res);
            if (response.status == 'failed') {
                document.querySelector("#message").textContent = response.message;
                document.querySelector("#message").setAttribute('class', 'alert alert-danger');
            }
            if (!validEmail(userEmail)) {
                document.querySelector("#message").textContent = "Некорректный email";
                document.querySelector("#message").setAttribute('class', 'alert alert-danger');
                return false;
            }
            if (response.status == 'exists') {
                document.querySelector("#message").textContent = response.message;
                document.querySelector("#message").setAttribute('class', 'alert alert-danger');
            }
            if (response.status == 'pass') {
                document.querySelector("#message").textContent = response.message;
                document.querySelector("#message").setAttribute('class', 'alert alert-success');
                clearForm()
                setTimeout(function () {
                    value = window.location = 'login';
                }, 1500);
            }

        },
        error: function (res) {
            alert('Ошибка сервера');
            window.location = '/';
        }
    });

}