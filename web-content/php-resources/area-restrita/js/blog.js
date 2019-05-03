/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
        
    $("select#buscar-categoria").bind("change", function() {
        location = "blog-dos-professores.php?categoria="+$(this).val();
    });
        
    $("span.curtir").bind("click", function() {
        var id_post = Number($(this).attr('id').split('_')[1]);
        var id_usr = Number($("span#id_usr").text());
        
        if (id_usr !== 0) { 
            $.get("../area-restrita/blogs/request.php?acao=curtir&id_usr=".concat(id_usr).concat("&id_post=").concat(id_post), function(total_likes) {
                $("span.likes_".concat(id_post)).text(total_likes);
                $("span#curtir_".concat(id_post)).text("Curtiu");
            });
        } else {
            alert("Você precisa estar logado para curtir");
        }
        
    });
        
    $.ajax({
        type: 'GET',
        url: "../chat/request.php",
        data: "acao=area",
        dataType: 'json',
        success: function (retorno) {
            
            $("select.area option").each(function () {
                if ($(this).val() === retorno.area) {
                    $(this).attr("selected", "selected");
                    selecionarCategoria($(this).val(), "categoria");
                }
            });

            $("select#categoria option").each(function () {
                if ($(this).val() === retorno.categoria) {
                    $(this).attr("selected", "selected");
                }
            });
            
        }
    });
    
    $("textarea.msg").bind("keyup", function (e) {
        if (e.which === 13) {
            var id_post = Number($(this).attr('id').split('_')[1]);
            var id_usuario = Number($("span#id_usr").text());
            var mensagem = $(this).val();
            enviarComentario(id_post, id_usuario, mensagem);
            
            var tot_men = Number($("span.coment_".concat(id_post)).text());
            $("span.coment_".concat(id_post)).text(++tot_men);
            $(this).val('');
            
        }
    });
    
});

function enviarComentario(id_post, id_usuario, mensagem) {
    $.ajax({
        type: 'POST',
        url: "../area-restrita/blogs/request.php",
        data: {acao_post: "enviar-mensagem", mensagem: mensagem, id_post: id_post, id_usuario: id_usuario},
        dataType: 'json', 
        success: function (retorno) {
            $.each(retorno.res, function (i, res) {
                if (retorno.res) {
                    $("span.c").remove();
                    $("div.comentarios_".concat(id_post))
                    .append(
                        "<div style='text-align: left;' class='box-footer box-comments'>\n\
                            <div class='row-fluid'>\n\
                                <div class='box-comment span12'>\n\
                                    <div class='span2'>\n\
                                        <img class='usr2' src='" + res.foto + "' alt='user image'>\n\
                                    </div>\n\
                                    <div class='span11' style='margin-left: -6%;'>\n\
                                        <div class='comment-text'>\n\
                                            <span class='username'>\n\
                                                " + res.nome + "\
                                                <span class='text-muted pull-right'>" + res.data + "</span>\n\
                                            </span>\n\
                                            " + res.comentario + "\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                        </div>"
                    );
                }
            });
        }, 
        error: function () {
            alert("error");
        }
    });
}