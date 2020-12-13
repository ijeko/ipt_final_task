<h4 class="header col-8 mb-4">Для связи с нами просто заполните форму ниже и нажмите кнопку "Отправить" </h4>
<div class="col-8 justify-content-center border rounded p-4 bg-light" style="float">
    <form id="register" action="" method="post">
        <label for="name">Ваше имя</label>
        <input type="text" name="name" id="name" class="form-control mb-3">
        <label for="email">Ваше почта</label>
        <input type="email" name="email" id="email" class="form-control mb-3">
        <label for="message_text">Ваше Сообщение</label>
        <textarea name="message_text" id="message_text" class="form-control mb-3"></textarea>
        <div class="text-right">
            <div id="message">

            </div>
            <button class="btn btn-primary mt-4" type="button" id="send" name="send">Отправить</button>
        </div>
    </form>
</div>
<script>
    let sendbtn = document.querySelector("#send");



    $(sendbtn).click(function (){
        let username = document.querySelector("#name").value;
        let email = document.querySelector("#email").value;
        let message = document.querySelector("#message_text").value;
        data =  {'name': username, 'email': email, 'text': message, 'file': ''};
        data = JSON.stringify(data);
        $.ajax({
            type: "post",
            url: '/public/guest/send',
            data: {'data': data},
            success: function (res)
            {
                let response = JSON.parse(res);
                if (response.result == 'error') {
                    document.querySelector("#message").textContent = response.status;
                    document.querySelector("#message").setAttribute('class', 'alert alert-danger');
                }
            }
        });
    });


</script>

