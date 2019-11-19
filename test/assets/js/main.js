$(document).ready(function(){
    $('#form-signin button[type="submit"]').on('click', function() {
        var login = $.trim($('#login').val());
        var pass = $.trim($('#password').val());
        if (login == '' || pass == '') {
            $('.error-block').show().text('Пожалуйста заполните все поля');
        }
    });

    $('.new-task').click(function(){
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
            $(this).text('Отмена');
            $('.task-form form').slideDown();
        } else {
            $(this).text('Новая задача');
            $('.task-form form').slideUp();
        }
    });


    var pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.[a-z]{2,6}$/i;
    var email = $('#email');
    email.blur(function(){
        if(email.val() != ''){
            if(email.val().search(pattern) == 0){
                $('#task-add button[type="submit"]').attr('disabled', false);
                $('.error-block').hide();
            }else{
                $('.error-block').show().text('Введите корректный email');
                $('#task-add button[type="submit"]').attr('disabled', true);
            }
        }
    });

    $('#task-add').on('click', function() {
        var name = $.trim($('#name').val());
        var text = $('#text').val();        
        if (name == '' || email == '' || text == '') {
            $('.error-block').show().text('Пожалуйста заполните все поля');
        }
    });

    function escapeHtml(str)
    {
        var map =
        {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return str.replace(/[&<>"']/g, function(m) {return map[m];});
    }

    $(document).on('click', '.edit-text', function(){
        var i = $(this).find('i');
        var id = $(this).data('id');
        var button = $(this);
        var td = $(document).find('td[data-id="'+ id +'"]');
        var old_text = td.data('text');
        if ($(this).hasClass('active')) {
            var text = td.find('input').val();
            if (text != old_text) {
                $.ajax({
                    url: "/site/editTask",
                    type: "POST",
                    data: {
                        id   : id,
                        text : text,
                    },
                    beforeSend: function(){
                        i.attr('class', 'far fa-circle-notch fa-spin');
                    },
                    success: function(data){
                        i.attr('class', 'fa fa-pencil');
                        td.html(escapeHtml(text) +'<br><span> отредактировано администратором</span>');
                        td.data('text', escapeHtml(text)); 
                        button.removeClass('active');
                    }
                });
            } else {
                i.attr('class', 'fa fa-pencil');
                td.html(escapeHtml(text));
                button.removeClass('active');
            }
            
        } else {
            td.html('<input value="'+ old_text +'"/>'); 
            td.find('input').attr('style', 'background:#fff; padding-left:10px').focus();
            i.attr('class', 'fa fa-check');
            button.addClass('active');
        }
    });
});