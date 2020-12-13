
<main class="px-3">
    <h1 class="mb-5"><?php echo 'Приветствуем, '.Auth::User()->getData()['username'];?></h1>
    <p class="lead mb-3">Чтобы начать уменьшать ваши ссылки, пожалуйста перейдите на главную страницу!</p>

    <p class="mb-5">
        <a href="/public/user/index" class="btn btn-lg btn-primary fw-bold border-white bg-primary">Начать</a>
        <a href="/public/user/logout" class="btn btn-lg btn-secondary fw-bold border-white bg-danger">Выход</a>

    </p>
</main>
<script src="../home.js"></script>