<header class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand" href="/">Онлайн <span class="badge badge-info">задачник</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Задачи</a>
                </li>
                <li class="nav-item">
                    <?php if ($_COOKIE['user']!='admin') {?>
                    <button type="button" class="btn btn-info py-1 my-1 ml-2 login" data-toggle="modal" data-target="#staticBackdrop">
                        Войти
                    </button>
                    <button style="display: none" type="button" class="btn btn-danger py-1 my-1 ml-2 logout">
                        Выйти
                    </button>
                    <?php } ?>
                    <?php if ($_COOKIE['user']=='admin') {?>
                        <button style="display: none" type="button" class="btn btn-info py-1 my-1 ml-2 login" data-toggle="modal" data-target="#staticBackdrop">
                            Войти
                        </button>
                        <button type="button" class="btn btn-danger py-1 my-1 ml-2 logout">
                            Выйти
                        </button>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </nav>
</header>