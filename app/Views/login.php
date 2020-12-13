<h4 class="mb-3">Вход для пользоветелей</h4>
<div class="col-8 justify-content-center border rounded p-4 bg-light">
    <form action="" method="post">
        <label for="email">Электронная почта</label>
        <input type="email" name="email" id="email" class="form-control mb-3 input" autocomplete="off">

        <label for="password">Пароль</label>
        <input type="password" name="password" id="password" class="form-control mb-3 input" autocomplete="off">
        <div id="message"></div>
        <button type="button" class="btn btn-outline-primary mt-3" id="login" name="login">Войти</button>
    </form>
</div>
<script src="/app/Views/login.js"></script>
<!--<script>-->
<!--    let login = document.querySelector("#login");-->
<!--        // document.querySelector("#login button[name='login']");-->
<!---->
<!--    function clearForm() {-->
<!--        var inputs = document.querySelectorAll('.input');-->
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
<!--    login.onclick = function () {-->
<!--        let userEmail = document.querySelector("#email").value;-->
<!--        let userPassword = document.querySelector("#password").value;-->
<!---->
<!---->
<!--        data = {'email': userEmail, 'password': userPassword};-->
<!--        data = JSON.stringify(data);-->
<!--        $.ajax({-->
<!--            type: "post",-->
<!--            url: 'auth',-->
<!--            data: {'data': data},-->
<!--            success: function (res) {-->
<!--           //      console.log(res)-->
<!--              let response = JSON.parse(res);-->
<!--                 console.log(res)-->
<!--                if (response.status == 'failed') {-->
<!--                    document.querySelector("#message").textContent = response.message;-->
<!--                    document.querySelector("#message").setAttribute('class', 'alert alert-danger');-->
<!--                }-->
<!--                if (!validEmail(userEmail)) {-->
<!--                    document.querySelector("#message").textContent = "Некорректный email";-->
<!--                    document.querySelector("#message").setAttribute('class', 'alert alert-danger');-->
<!--                    return false;-->
<!--                }-->
<!--                if (response.status == 'pass') {-->
<!--                    document.querySelector("#message").textContent = response.message;-->
<!--                    document.querySelector("#message").setAttribute('class', 'alert alert-success');-->
<!--                    clearForm()-->
<!--                    setTimeout(function () {-->
<!--                        value = window.location = 'user/home';-->
<!--                    }, 1500);-->
<!--                }-->
<!--                if (response.status == 'auth') {-->
<!--                    document.querySelector("#message").textContent = response.message;-->
<!--                    document.querySelector("#message").setAttribute('class', 'alert alert-danger');-->
<!--                    setTimeout(function () {-->
<!--                        value = window.location = 'guest/login';-->
<!--                    }, 1500);-->
<!--                }-->
<!---->
<!--            },-->
<!--            error: function (res) {-->
<!--                alert('Ошибка сервера');-->
<!--                window.location = '/public';-->
<!--            }-->
<!--        });-->
<!---->
<!--    }-->
<!--</script>-->