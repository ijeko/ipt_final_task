<h4 class="mb-3">Регистрация нового пользователя</h4>
<div class="col-8 justify-content-center border rounded p-4 bg-light">
    <form id="register" action="" method="post">
        <label for="username">Имя пользователя</label>
        <input type="text" name="username" id="username" class="form-control mb-3 input" autocomplete="off">

        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control mb-3 input" autocomplete="off">

        <label for="password">Пароль</label>
        <input type="password" name="password" id="password" class="form-control mb-3 input" autocomplete="off">
        <div id="message"></div>

        <button type="button" class="btn btn-outline-primary mt-3" name="register">Регистрация</button>
    </form>
</div>
<script src="/app/Views/register.js"></script>
<!--<script>-->
<!--    let register = document.querySelector("#register button[name='register']");-->
<!---->
<!--    function clearForm() {-->
<!--        var inputs = document.querySelectorAll('.input');-->
<!--        // document.querySelector("#message").textContent = "";-->
<!--        for (var i = 0; i < inputs.length; i++) {-->
<!--            inputs[i].value = '';-->
<!--            inputs[i].setAttribute('disabled', true);-->
<!--        }-->
<!--    }-->
<!---->
<!--    function validEmail($email) {-->
<!--        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;-->
<!--        return emailReg.test($email);-->
<!--    }-->
<!---->
<!--    register.onclick = function () {-->
<!--        let userName = document.querySelector("#username").value;-->
<!--        let userEmail = document.querySelector("#email").value;-->
<!--        let userPassword = document.querySelector("#password").value;-->
<!---->
<!---->
<!---->
<!---->
<!--        data = {'username': userName, 'email': userEmail, 'password': userPassword};-->
<!--        data = JSON.stringify(data);-->
<!--        $.ajax({-->
<!--            type: "post",-->
<!--            url: 'guest/adduser',-->
<!--            data: {'data': data},-->
<!--            success: function (res) {-->
<!--                // console.log(res)-->
<!--                let response = JSON.parse(res);-->
<!--                if (response.status == 'failed') {-->
<!--                    document.querySelector("#message").textContent = response.message;-->
<!--                    document.querySelector("#message").setAttribute('class', 'alert alert-danger');-->
<!--                }-->
<!--                if (!validEmail(userEmail)) {-->
<!--                    document.querySelector("#message").textContent = "Некорректный email";-->
<!--                    document.querySelector("#message").setAttribute('class', 'alert alert-danger');-->
<!--                    return false;-->
<!--                }-->
<!--                if (response.status == 'exists') {-->
<!--                    document.querySelector("#message").textContent = response.message;-->
<!--                    document.querySelector("#message").setAttribute('class', 'alert alert-danger');-->
<!--                }-->
<!--                if (response.status == 'pass') {-->
<!--                    document.querySelector("#message").textContent = response.message;-->
<!--                    document.querySelector("#message").setAttribute('class', 'alert alert-success');-->
<!--                    clearForm()-->
<!--                    setTimeout(function () {-->
<!--                        value = window.location = 'login';-->
<!--                    }, 1500);-->
<!--                }-->
<!---->
<!--            },-->
<!--            error: function (res) {-->
<!--                alert('Ошибка сервера');-->
<!--                window.location = '/';-->
<!--            }-->
<!--        });-->
<!---->
<!--    }-->
<!--</script>-->