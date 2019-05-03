/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    carregarEstados();

    $.get("../chat/request.php?acao=genero", function (genero) {
        $("select.genero option").each(function () {
            if ($(this).val() === genero) {
                $(this).attr("selected", "selected");
            }
        });
    });

    $("li.aulas").bind("click", function () {
        carregarAulas();
    });

    $("li.formacao").bind("click", carregarNivel);

    $("select.areaP").bind("change", function () {
        selecionarCategoria($(this).val(), "categoria");
    });

    $("i.mais").bind("click", function () {
        addTelefone();
    });

    $("input[name=aTelefones]").bind("click", function () {
        atualizarTelefone();
    });
    
    $("a#alterarEmail").bind("click", function () {
        
        $("input[name=email]").fadeToggle(500);
        return false;
    });
    
    $("a#alterarSenha").bind("click", function () {
        
        $("input[name=senha]").fadeToggle(500);
        return false;
    });

    $("li.endereco").bind("click", function () {

        $.get("../chat/request.php?acao=estado", function (retorno) {
            $("select[name=estado] option").each(function () {
                if ($(this).val() === retorno) {
                    $(this).attr("selected", "selected");
                }
            });
        });

    });

});

function carregarAulas() {
    $.ajax({
        type: 'GET',
        url: "../chat/request.php",
        data: "acao=area",
        dataType: 'json',
        success: function (retorno) {
            $("select.areaP option").each(function () {
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

            $("select.tipo-aula option").each(function () {
                if ($(this).val() === retorno.tipo_aula) {
                    $(this).attr("selected", "selected");
                }
            });

        }
    });
}

var i = 0;
function addTelefone() {
    $("div.addTel")
    .append("\n\
        <div class='row-fluid'>\n\
            <div class='span12'>\n\
                <div class='span1'>\n\
                    <label for='ddd" + ++i + "'>DDD<span class='text-error'>*</span></label>\n\
                    <input type='text' name='ddd' id='ddd" + i + "' required class='span12' />\n\
                </div>\n\
                <div class='span4'>\n\
                    <label for='tel" + i + "'>Telefone<span class='text-error'>*</span></label>\n\
                    <input type='text' name='tel' id='tel" + i + "' required class='input-large' />\n\
                </div>\n\
            </div>\n\
        </div>\n\
    ");
}

function atualizarTelefone() {
    var tel = Array();
    var ddd = Array();

    var telefones = Array();

    $("input[name=ddd]").each(function (i) {
        ddd[i] = $(this).val();
    });

    $("input[name=tel]").each(function (i) {
        tel[i] = $(this).val();
        telefones[i] = ddd[i].concat(" " + tel[i]);
    });

    $.ajax({
        type: 'POST',
        url: '../../util/atualizarCadastroProfessor.php',
        data: {aTelefones: "telefones", telefones: telefones},
        dataType: 'json',
        success: function (retorno) {
            if (retorno.res === "Ok") {
                location.href = "editarPerfil.php";
            }
        },
        error: function () {
            alert("Erro ao atualizar o telefone");
        }

    });

}

function carregarNivel() {
    $.get("request.php?acao=nivel", function(retorno) {
        $("select[name=nivel] option").each(function() {
            if ($(this).val() === retorno) {
                $(this).attr("selected", "selected");
            }
        });
    });
}
