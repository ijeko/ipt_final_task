<?php
$user_id = Auth::User()->id();
?>
<button type="button" class="ml-2 mb-1 close" id="dl" name="dl"></button>
<div class="container">
    <div class="row">
        <div class="col-9">
            <div class="container form py-3 px-4">
                <div class="row justify-content-center">
                    <h2 class="header mt-3">Приступим!</h2>
                </div>
                <div class="row mt-3">
                    <h4 class="text-center header">Чтобы уменьшить ссылку, просто введите в форму ниже полный URL и
                        удобное
                        сокращение </h4>
                </div>
                <div class="row mt-5 justify-content-center">
                    <form class="mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light">URL | Сокращение</span>
                            </div>
                            <input type="text" aria-label="Full URL" class="form-control input" id="fullurl">
                            <input type="text" aria-label="Short URL" class="form-control input" id="shorturl">
                            <button class="btn btn-primary" type="button" id="addlink" name="addlink">Создать</button>
                        </div>

                    </form>
                    <div id="message"></div>
                </div>
            </div>

        </div>
        <div class="col-3 toasts" id="toasts">

        </div>
    </div>

</div>

<script>let user_id = <?=json_encode($user_id)?>;</script>
<script src="/app/Views/links.js"></script>
