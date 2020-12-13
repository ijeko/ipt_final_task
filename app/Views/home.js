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


    data = {'email': userEmail, 'password': userPassword};
    data = JSON.stringify(data);
    $.ajax({
        type: "post",
        url: 'auth',
        data: {'data': data},
        success: function (res) {
            console.log(res)
            document.location.reload(true)
        },
        error: function (res) {
            alert('Ошибка сервера');
            window.location = '/public';
        }
    });

}