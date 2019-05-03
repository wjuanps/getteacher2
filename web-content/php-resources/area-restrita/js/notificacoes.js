/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $("a.agendamentos").bind("click", carregarAgendamentos);
    $("a.blog").bind("click", carregarBlog);
    $("a.cancelamentos").bind("click", carregarCancelamentos);
    $("li.noti").bind("click", notificacoes);
    
    window.setInterval(function() {
        $.get("../app/request.php?acao=veri-agendamento", function (retorno) {
            if (retorno > 0) {
                $("span#agendamento").fadeIn(1000).text(retorno);
            } else {
                $("span#agendamento").fadeOut(0);
            }
        });
        
        $.ajax({
            type: 'POST',
            url: "../app/request.php",
            data: {acao: "notificacoes"},
            dataType: 'json',
            success: function (retorno) {
                if (retorno.total > 0) {
                    $("span.notis").fadeIn(1000).text(retorno.total);
                } else {
                    $("span.notis").fadeOut(0);
                }
            }
        });
        
    }, 1000);
    
});

function notificacoes() {
    $("li.notificacoes").empty();
    $.ajax({
            type: 'POST',
            url: "../app/request.php",
            data: {acao: "notificacoes"},
            dataType: 'json',
            success: function (retorno) {
                if (retorno.avaliacao) {
                   $.each(retorno.avaliacao, function (i, aval) {
                        $("ul.notificacoes")
                        .append(
                            "<li class='notificacoes'>\n\
                                <a href=''>\n\
                                    <i class='icon-circle text-error'></i>&nbsp;&nbsp;\n\
                                    Você foi avaliado por " + aval.nome + " em " + aval.data + "\n\
                                </a>\n\
                            </li>"
                        );
                    });
                }
               
                if (retorno.agendamento) {
                   $.each(retorno.agendamento, function (i, agen) {
                        $("ul.notificacoes")
                        .append(
                            "<li class='notificacoes'>\n\
                                <a href=''>\n\
                                    <i class='icon-circle text-error'></i>&nbsp;&nbsp;\n\
                                    " + agen.nome + " Solicitou uma aula para o dia " + agen.data + "\n\
                                </a>\n\
                            </li>"
                        );
                    });
                }
                
                if (retorno.comentario) {
                    $.each(retorno.comentario, function (i, com) {
                        $("ul.notificacoes")
                        .append(
                            "<li class='notificacoes'>\n\
                                <a href='../../domain/artigo-professor.php?id_post=" + com.artigo + "&id_professor=" + com.professor + "'>\n\
                                    <i class='icon-circle text-error'></i>&nbsp;&nbsp;\n\
                                    " + com.nome + " comentou seu artigo <span class='text-info'>" + com.titulo + "</span>\n\
                                </a>\n\
                            </li>"
                        );
                    });
                }
                
                if (retorno.like) {
                    $.each(retorno.like, function (i, li) {
                        $("ul.notificacoes")
                        .append(
                            "<li class='notificacoes'>\n\
                                <a href='../../domain/artigo-professor.php?id_post=" + li.artigo + "&id_professor=" + li.professor + "'>\n\
                                    <i class='icon-circle text-error'></i>&nbsp;&nbsp;\n\
                                    " + li.nome + " curtiu seu artigo <span class='text-info'>" + li.titulo + "</span>\n\
                                </a>\n\
                            </li>"
                        );
                    });
                }
                
            },
            error: function () {
                return false;
            }
        });
}

function carregarAgendamentos() {
    $("div.agendamentos").empty();
    $.ajax({
        type: 'POST',
        url: "../app/request.php",
        data: {acao: "agendamentos"},
        dataType: 'json',
        success: function (retorno) {
            if (retorno.res) {
                $.each(retorno.res, function (i, res) {
                    $("div.agendamentos")
                    .prepend(
                        "<section>\n\
                            <div class='row-fluid'>\n\
                                <div class='span4'>\n\
                                    <span class='text-info'>Nome </span><span>" + res.nome + "</span>\n\
                                </div>\n\
                                <div class='span5'>\n\
                                    <span class='text-info'>Data/Hora </span><span>" + res.data + "</span>\n\
                                </div>\n\
                                <div class='span3'>\n\
                                    <span class='text-info'>Duração </span><span>" + res.duracao + "</span>\n\
                                </div>\n\
                            </div>\n\
                            <div class='row-fluid'>\n\
                                <div class='span12'>\n\
                                    <span class='text-info'>Necessidade </span><br /><span>" + res.necessidade + "</span>\n\
                                </div>\n\
                            </div>\n\
                            <legend></legend>\n\
                            <div class='row-fluid'>\n\
                                <form class='form-inline' method='post' action='../app/confirmarAula.php'>\n\
                                    <textarea type='text' name='agen-mensagem' class='span7' rows='1' required placeholder='Envie uma mensagem para " + res.nome.split(" ")[0] + "'></textarea>\n\
                                    <button type='submit' name='confirmar' class='btn btn-info' value='c'><i class='icon-thumbs-up'></i> Confirmar</button>\n\
                                    <button type='submit' name='recusar' class='btn btn-danger' value='r' ><i class='icon-thumbs-down'></i> Recusar</button>\n\
                                    <input type='hidden' value='" + res.id_aluno + "' name='id_aluno' />\n\
                                    <input type='hidden' value='" + res.id_aula + "' name='id_aula' />\n\
                                </form>\n\
                            </div>\n\
                            <hr />\n\
                        </section>"
                    );
                }); 
            } else {
                $("div.agendamentos").append("<h4 class='text-info'>Você não tem agendamentos pendentes!</h4><hr />");
            }
        }, 
        error: function () {
            
        }
    });
}

function carregarBlog() {
    $("div.blog").empty();
    $.ajax({
        type: 'POST',
        url: "../app/request.php",
        data: {acao: "blog"},
        dataType: 'json',
        success: function (retorno) {
            if (retorno.comentario) {
                $.each(retorno.comentario, function(i, res) {
                    $("div.blog")
                    .prepend(
                        "<div class='row-fluid'>\n\
                            <p><span class='text-info'>" + res.nome + "</span> comentou seu artigo <a href='../../domain/artigo-professor.php?id_post=" + res.id_blog + "&id_professor=" + res.id_professor + "' class='text-info'>" + res.titulo + "</a> em <span class='text-info'>" + res.data_comentario + "</span></p>\n\
                        </div>\n\
                        <hr />"
                    );
                });
            } 
            
            if (retorno.like) {
                $.each(retorno.like, function (i, res) {
                    $("div.blog")
                    .prepend(
                        "<div class='row-fluid'>\n\
                            <p><span class='text-info'>" + res.nome + "</span> curtiu seu artigo <a href='../../domain/artigo-professor.php?id_post=" + res.id_blog + "&id_professor=" + res.id_professor + "' class='text-info'>" + res.titulo + "</a> em <span class='text-info'>" + res.data_like + "</span></p>\n\
                        </div>\n\
                        <hr />"
                    );
                });
            }
            
            if (!retorno.comentario && !retorno.like) {
                $("div.blog").append("<h4 class='text-info'>Você não tem notificações pendentes!</h4><hr />");
            }
            
        }, 
        error: function () {
            
        }
    });
}

function carregarCancelamentos() {
    $("div.cancelamentos").empty();
    $.ajax({
        type: 'POST',
        url: "../app/request.php",
        data: {acao: "cancelamentos"},
        dataType: 'json',
        success: function () {
            
        }, 
        error: function () {
            
        }
    });
}