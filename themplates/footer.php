<footer>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Авторизация</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="ajaxLogin" method="post">
                        <div class="form-group">
                            <label for="login">Логин</label>
                            <input type="text" class="form-control" id="login" name="login">
                        </div>
                        <div class="form-group">
                            <label for="pass">Пароль</label>
                            <input type="password" class="form-control" id="pass" name="pass">
                        </div>
                        <input hidden="hidden" type="text" name="modInput" value="loginUser">
                        <div id="errorList">
                        </div>
                        <div>
                            <button type="button" class="btn btn-info float-left mr-2 loginButton">Отправить</button>
                            <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Закрыть</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</footer>
