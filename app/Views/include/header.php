<?php
if ($title == 'Главная') $index = 'active';
if ($title == 'О проекте') $about = 'active';
if ($title == 'Контакты') $contacts = 'active';
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">TinyLink</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?= $index ?>">
                <?php if (Auth::User()): ?>
                <a class="nav-link" href="/public/user">Главная<span class="sr-only">(current)</span></a>
                <?php endif; ?>
                <?php if (!Auth::User()): ?>
                    <a class="nav-link" href="/public/guest">Главная<span class="sr-only">(current)</span></a>
                <?php endif; ?>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $about ?>" href="/public/about">О проекте</a>
            </li>
            <li class="nav-item <?= $contacts ?>">
                <a class="nav-link" href='/public/contacts' tabindex="-1" aria-disabled="false">Контакты</a>
            </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
            <?php if (Auth::User()): ?>

                <a href="home" class="btn btn-outline-light my-2 my-sm-0 mr-2 btn-sm">Личный кабинет</a>
            <?php endif; ?>
            <?php if (!Auth::User()): ?>

                <a href="/public/login" class="btn btn-outline-light my-2 my-sm-0 mr-2 btn-sm">Вход</a>
                <a href="/public/register" class="btn btn-outline-light my-2 my-sm-0 btn-sm">Регистрация</a>
            <?php endif; ?>

        </form>
    </div>
</nav>
