/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    $(".icheckbox_flat-blue").each(function() {
        $(this).attr('id', $(this).children().val());
    }); 

    $("button[name=excluir]").bind("click", function () {
        var id = Array();
        $(".icheckbox_flat-blue").each(function(i) {
            if ($(this).hasClass('checked')) {
                id[i] = Number($(this).attr('id'));
            }
        });
        excluir(id);
    });

    $("button[name=apagar]").bind("click", function () {
        var id = Number($(this).attr("id").split("_")[1]);
        excluir(id);
    });
    
});

function excluir(id) {
    $.ajax({
        type: 'POST',
        url: "../../util/request.php",
        data: {acao: "apagar", id_mensagem: id},
        dataType: 'json',
        success: function (retorno) {
            if (retorno.res === "ok") {
                location = "mailbox.php";
            } else {
                alert("Falha ao apagar a mensagem");
            }
        },
        error: function (retorno) {
            alert(retorno);
        }
    });
}