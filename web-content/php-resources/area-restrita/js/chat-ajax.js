/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var id_conversa;
var id_usuario = Number($("#id_usuario").val());

$(document).ready(function () {

    $(".notificacoes").bind("click", function () {
        $.get("../chat/request.php?acao=msg", function (resposta) {

        });
    });

    window.setInterval(function () {
        $.get("../chat/request.php?acao=verificar", function (totalMensagens) {
            if (totalMensagens <= 0) {
                $("span.tot-men").fadeOut(1000);
            } else {
                $("span.tot-men").fadeIn(1000).text(totalMensagens);
            }
        });

        $.ajax({
            type: 'GET',
            url: '../chat/request.php',
            data: 'acao=verificar-men',
            dataType: 'json',
            success: function (retorno) {
                $.each(retorno, function (i, msg) {
                    if (Number(msg.total) <= 0) {
                        $("span#men_" + Number(msg.id_conversa)).fadeOut(1000);
                    } else {
                        var mensagem = (msg.total > 1) ? " mensagens novas" : " mensagem nova";                        
                        $("span#men_" + Number(msg.id_conversa)).fadeIn(1000).text(msg.total).attr({title: msg.total + mensagem});
                    }

                });
            },
            error: function () {

            }
        });

    }, 1000);

    $("button.limpar").bind("click", function () {
        $("h3.conversa_com").text("Conversa com");
        $("div.direct-chat-warning .box-body .chat").empty();
        $("textarea.msg").attr("id", "txt_");
    });

    $("span.carregar-conversa").bind("click", function () {
        var id_conversa = parseInt($(this).attr('id'));
        carregarHistorico(id_conversa);
    });

    $("li.not-mensagens").bind("click", function (e) {
        if (!$(this).hasClass("open")) {
            $("li.mensagens").empty();
            notMensagens(id_usuario);
        }
    });
    
    $('body').on("keyup", ".msg", function (e) {
        if (e.which === 13) {
            id_conversa = Number($(this).attr('id').split('_')[1]);
            var mensagem = $(this).val();
            enviarMensagem(id_conversa, id_usuario, mensagem);
        }
    });
    
    $("button[name=excluir-conversa]").bind("click", function() {
        $.get("../chat/request.php?acao=excluir-conversa&id-conversa=" + $(this).attr('id'), function (resposta) {
            if (resposta === "excluiu") {
                window.location = "conversas.php";
            } else {
                alert(resposta);
            }
        });
    });
    
    atualizarConversa(id_usuario, 0, 0);
    
});

function enviarMensagem(id_conversa, id_usuario, mensagem) {
    $.ajax({
        type: 'POST',
        url: "../chat/historico.php",
        data: {acao: "enviar-mensagem", msg: mensagem, id_conversa: id_conversa, id_usuario: id_usuario},
        success: function (retorno) {
            if (retorno === 'Ok') {

                var totMen = Number($("span#totMen_" + id_conversa).text().split(" ")[0]);
                $("span#totMen_" + id_conversa).text(++totMen + " Mensagens");

            } else if (retorno === 'falha') {
                alert("Erro ao enviar a mensagem.");
                $("#txt_").val('');
            }

            $("#txt_" + id_conversa).val('');

        },
        error: function () {
            alert();
        }
    });
}

function notMensagens(id_usuario) {
    $.ajax({
        type: 'POST',
        url: '../chat/historico.php',
        data: {acao: 'not-mensagens', id_usuario: id_usuario},
        dataType: 'json',
        success: function (retorno) {
            $.each(retorno, function (i, res) {
                if (res.nome !== "") {
                    $("ul.not-mensagens")
                    .append("\
                        <li class='mensagens'>\n\
                            <a class='notMensagens' id='con_" + res.id_conversa + "' href='../chat/conversas.php?conversa=" + res.id_conversa + "'>\n\
                                <i class='icon-circle text-error'></i>&nbsp;&nbsp;&nbsp;Você recebeu mensagem de " + res.nome + "\
                            </a>\n\
                        </li>"
                    );
                }
            });
        }
    });
}

function carregarHistorico(id_conversa) {
    $("div.direct-chat-warning .box-body .chat").empty();
    $.get("../chat/request.php?acao=up&id_conversa=" + id_conversa);
    $("textarea.msg").removeAttr("id").attr("id", "txt_" + id_conversa).focus();
    $("h3.conversa_com").text("Conversa com " + $("span#conversaCom_" + id_conversa).text());
    historicoConversa(id_conversa, id_usuario);
}

function historicoConversa(id_conversa, id_usuarioOnline) {
    $.ajax({
        type: 'POST',
        url: '../chat/historico.php',
        data: {acao: 'recuperar-historico', id_conversa: id_conversa, id_usuario: id_usuarioOnline},
        dataType: 'json',
        success: function (retorno) {
            $.each(retorno, function (i, msg) {
                if (id_usuarioOnline === Number(msg.destinatario)) {
                    $("div.direct-chat-warning .box-body .chat").fadeIn(1000)
                    .prepend(
                        "<div class='direct-chat-msg'>\n\
                            <div class='direct-chat-info clearfix'>\n\
                                <span class='direct-chat-timestamp pull-right'>" + msg.data + "</span>\n\
                            </div>\n\
                            <img class='direct-chat-img' src='" + msg.foto_perfil + "' />\n\
                            <div class='direct-chat-text'>\n\
                                " + msg.mensagem + "\n\
                            </div>\n\
                        </div>"
                    );
                } else if (id_usuarioOnline === Number(msg.remetente)) {
                    $("div.direct-chat-warning .box-body .chat").fadeIn(1000)
                    .prepend(
                        "<div class='direct-chat-msg right'>\n\
                            <div class='direct-chat-info clearfix'>\n\
                                <span class='direct-chat-timestamp pull-left'>" + msg.data + "</span>\n\
                            </div>\n\
                            <img class='direct-chat-img' src='" + msg.foto_perfil + "' />\n\
                            <div class='direct-chat-text'>\n\
                                " + msg.mensagem + "\n\
                            </div>\n\
                        </div>"
                    );
                }

            });

            $("div.chat").animate({scrollTop: 50000}, '500');

        },
        error: function () {
            if (!janela.hasClass("collapsed")) {
                $("div.janela_" + id_conversa)
                .append(
                    "<p class='alert-error mensagem'>Desculpe, não conseguimos carregar suas conversas. Tente novamente.</p>"
                );
            } else {
                $("div.remetente_" + id_conversa).empty();
            }
        }
    });
}

function atualizarConversa(usr, time, last) {
    var t;
    $.ajax({
        type: 'POST',
        url: '../chat/atualizarConversa.php',
        data: {acao: "atualizar-conversa", user: usr, lastid: last, timestamp: time},
        dataType: 'json',
        success: function (retorno) {
                
            clearInterval(t);
            if (retorno.status === 'resultados' || retorno.status === 'vazio') {
                t = setTimeout(function () {
                        atualizarConversa(usr, retorno.timestamp, retorno.lastid);
                    }, 1000);
                if (retorno.status === 'resultados') {

                    $.each(retorno.dados, function (i, msg) {
                                              
                        if ($("div.con_".concat(Number(msg.conversa))).length === 0) {
                            
                            $("div.conversas")
                            .prepend(
                                "<div class='row-fluid con_".concat(Number(msg.conversa)) + "'>\n\
                                    <div class='col-md-3 col-sm-3 col-xs-8'>\n\
                                        <div class='info-box'>\n\
                                            <span class='info-box-icon'><img src='" + msg.foto_perfil + "' alt='' style='height: 90px;' /></span>\n\
                                            <span id='" + Number(msg.conversa) + "'>"+msg.nome + "</span><br />\n\
                                            <a href='conversas.php?conversa=" + msg.conversa + "' class='btn btn-info btn-medium carregar-conversa' id='" + Number(msg.conversa) + "' style='margin-top: 10%;'>Ver Mensagens</a>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>"
                            ); 
                        } else {                           
                            if ($("textarea.msg").attr("id") !== "txt_") {

                                var id_conversa = Number($("textarea.msg").attr("id").split("_")[1]);
                                
                                if (id_conversa === Number(msg.conversa)) {
                                    if (usr === Number(msg.destinatario)) {

                                        $.get("../chat/request.php?acao=up&id_conversa=" + id_conversa);

                                        $("div.direct-chat-warning .box-body .chat").fadeIn(1000)
                                        .append(
                                            "<div class='direct-chat-msg'>\n\
                                                <div class='direct-chat-info clearfix'>\n\
                                                    <span class='direct-chat-timestamp pull-right'>" + msg.data + "</span>\n\
                                                </div>\n\
                                                <img class='direct-chat-img' src='" + msg.foto_perfil + "' />\n\
                                                <div class='direct-chat-text'>\n\
                                                    " + msg.mensagem + "\n\
                                                </div>\n\
                                            </div>"
                                        );
                                    } else if (usr === Number(msg.remetente)) {
                                        $("div.direct-chat-warning .box-body .chat").fadeIn(1000)
                                        .append(
                                            "<div class='direct-chat-msg right'>\n\
                                                <div class='direct-chat-info clearfix'>\n\
                                                    <span class='direct-chat-timestamp pull-left'>" + msg.data + "</span>\n\
                                                </div>\n\
                                                <img class='direct-chat-img' src='" + msg.foto_perfil + "' />\n\
                                                <div class='direct-chat-text'>\n\
                                                    " + msg.mensagem + "\n\
                                                </div>\n\
                                            </div>"
                                        );
                                    }
                                }
                            }                            
                        }
                    });

                    $("div.chat").animate({scrollTop: 50000}, '500');

                } else if (retorno.status === "Vazio") {
                    alert("Vazio");
                }

            } else {
                if (retorno.status === 'erro') {
                    alert("Erro");
                }
            }
        },
        error: function (retorno) {
            clearInterval(t);
            t = setTimeout(function () {
                atualizarConversa(id_usuario, retorno.timestamp, retorno.lastid);
            }, 15000);
        }

    });
}