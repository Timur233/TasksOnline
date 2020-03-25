$(document).ready(function() {

    if ($.cookie('user') == undefined){
        $.cookie('user', 'user');
    }

    selectTasks('id DESC', '');
    paginationTasks();

    $("#selectSort").change(function() {
        $("#sortInput").val($(this).val());
        selectTasks($(this).val(), '');
        $('.pagination-link').each(function() {
            $(this).removeClass('active');
        });
        $('.first-page').addClass('active');
    });

    $("#pagination").on('click', '.pagination-link', function() {
        selectTasks($("#selectSort").val(), 'OFFSET '+$(this).attr('data-offset'));
        $('.pagination-link').each(function() {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
    });

    $("#tasks").on('change', '.changeStatus', function() {
        if ($(this).val() != ''){
            updateStatus($(this).attr('data-id'), $(this).val());
        }
    });

    $(".sendButton").click(
        function(){
            if ($('#nameInput').val()=='' || $('#emailInput').val()=='' || $('#taskInput').val()==''){
                $('#resultForm').html('<div class="alert alert-danger" role="alert">Ошибка. Заполните все поля формы.</div>');
            } else
            {
                var pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.[a-z]{2,6}$/i;
                var mail = $('#emailInput').val();

                if(mail.search(pattern) == 0){
                    sendForm('resultForm', 'ajaxForm', 'includes/controller.php');
                    selectTasks($('#selectSort').val(), '');
                    paginationTasks();
                }else{
                    $('#resultForm').html('<div class="alert alert-danger" role="alert">Ошибка. Поле E-mail заполнено не правильно.</div>');
                }
                }

            return false;
        }
    );

    $(".sendEditButton").click(
        function(){
            if ($('#nameInput').val()=='' || $('#emailInput').val()=='' || $('#taskInput').val()==''){
                $('#resultForm').html('<div class="alert alert-danger" role="alert">Ошибка. Заполните все поля формы.</div>');
            } else
            {
                var pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.[a-z]{2,6}$/i;
                var mail = $('#emailInput').val();

                if(mail.search(pattern) == 0){
                    if ($.cookie('user')!='admin') {
                        $('#resultForm').html('<div class="alert alert-danger" role="alert">Для редактирования записи вам требуется авторизоваться!</div>');
                    } else {
                        sendEditForm('resultForm', 'ajaxForm', 'includes/controller.php');
                    }
                }else{
                    $('#resultForm').html('<div class="alert alert-danger" role="alert">Ошибка. Поле E-mail заполнено не правильно.</div>');
                }
            }

            return false;
        }
    );

    $(".loginButton").click(
        function(){
            if ($('#login').val()=='' && $('#pass').val()==''){
                $('#errorList').html('<div class="alert alert-danger" role="alert">Ошибка. Заполните все поля формы.</div>');
            } else {
                if ($('#login').val()==''){
                    $('#errorList').html('<div class="alert alert-danger" role="alert">Ошибка. Укажите логин администратора.</div>');
                } else if ($('#pass').val()==''){
                    $('#errorList').html('<div class="alert alert-danger" role="alert">Ошибка. Укажите пароль администратора.</div>');
                } else {
                    loginUser('errorList', 'ajaxLogin', 'includes/controller.php');
                }
            }

            return false;
        }
    );

    $('.logout').click(function() {
        $.cookie('user', 'user');
        location.href = "/";
    });

    $("#ajaxLogin input").click(function() {
        $('#errorList').html('');
    });

});

function sendForm(resultForm, ajaxForm, url) {
    $.ajax({
        url:     url,
        type:     "POST",
        dataType: "html",
        data: $("#"+ajaxForm).serialize(),
        success: function(response) {
            result = $.parseJSON(response);
            $('#resultForm').html('<div class="alert alert-success" role="alert">' + result + '</div>');
            $('form input.formInput, form textarea').val('');
        },
        error: function(response) {
            $('#resultForm').html('<div class="alert alert-danger" role="alert">Ошибка. Данные не отправлены.</div>');
        }
    });
}

function sendEditForm(resultForm, ajaxForm, url) {
    $.ajax({
        url:     url,
        type:     "POST",
        dataType: "html",
        data: $("#"+ajaxForm).serialize(),
        success: function(response) {
            result = $.parseJSON(response);
            $('#resultForm').html('<div class="alert alert-success" role="alert">' + result + '</div>');
        },
        error: function(response) {
            $('#resultForm').html('<div class="alert alert-danger" role="alert">' + result + '</div>');
        }
    });
}

function updateStatus(id, status) {
    $.ajax({
        url:     "includes/controller.php",
        type:     "POST",
        dataType: "html",
        data: "modInput=updateStatus&id="+id+"&status="+status,
        success: function(html) {
            selectTasks($('#selectSort').val(), 'OFFSET '+$('.pagination-link.active').attr('data-offset'));
        }
    });
}

function selectTasks(sort, offset){
    $.ajax({
        url:     "includes/controller.php",
        type:     "POST",
        dataType: "html",
        data: "modInput=selectTask&sort="+sort+"&offset="+offset,
        success: function(html) {
            $('#tasks').html(html)
        },
        error: function(response) {
            $('#tasks').html('<div class="alert alert-danger" role="alert">Ошибка. Данные не были загружены. Обновить страницу.</div>');
        }
    });
}

function paginationTasks(){
    $.ajax({
        url:     "includes/controller.php",
        type:     "POST",
        dataType: "html",
        data: "modInput=paginationTask",
        success: function(html) {
            $('.paginationItems').html(html)
        }
    });
}

function loginUser(resultForm, ajaxForm, url){
    $.ajax({
        url:     "includes/controller.php",
        type:     "POST",
        dataType: "html",
        data: $("#"+ajaxForm).serialize(),
        success: function(html) {
            $('#errorList').html('<div class="alert alert-success" role="alert">Добро пожаловать.</div>');
            $('#staticBackdrop').modal('hide');
            $('.login').fadeOut();
            $('.logout').fadeIn();
            $.cookie('user', 'admin');
            selectTasks($('#selectSort').val(), '');
            paginationTasks();
        },
        error: function(html) {
            $('#errorList').html('<div class="alert alert-danger" role="alert">Логин или пароль не правильный.</div>');
        }
    });
}
