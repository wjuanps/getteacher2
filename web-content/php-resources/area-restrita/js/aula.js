/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $("button.avaliar").bind("click", function () {
        if (!$(this).hasClass("disabled")) {
            var id_aula = Number($(this).attr('id'));
            $("#aval_" + id_aula).toggle(1000);
        }
    });

    $("button[name=cancelar]").bind("click", function() {
        var id_aula = Number($(this).attr('id'));
        $("#cancelar_".concat(id_aula)).toggle(1000);
    });

    $("i[name=didatica]").css("cursor", "pointer").bind("click", function () {
        var qtd = Number($(this).attr('id').split("_")[1]);
        
        for (var i = 1; i < 6; i++) {
            if (i <= qtd) {
                $("i#did_"+i).addClass("text-info");
            } else {
                $("i#did_"+i).removeClass("text-info");
            }
        }
        
        $("input[name=cDid]").val(qtd);
        
    });
    
    $("i[name=conhecimento]").css("cursor", "pointer").bind("click", function () {
        var qtd = Number($(this).attr('id').split("_")[1]);
        
        for (var i = 1; i < 6; i++) {
            if (i <= qtd) {
                $("i#con_"+i).addClass("text-info");
            } else {
                $("i#con_"+i).removeClass("text-info");
            }
        }
        
        $("input[name=cCon]").val(qtd);
        
    });
    
    $("i[name=simpatia]").css("cursor", "pointer").bind("click", function () {
        var qtd = Number($(this).attr('id').split("_")[1]);
        
        for (var i = 1; i < 6; i++) {
            if (i <= qtd) {
                $("i#sim_"+i).addClass("text-info");
            } else {
                $("i#sim_"+i).removeClass("text-info");
            }
        }
        
        $("input[name=cSim]").val(qtd);
        
    });
    
    $("input[name=nova-data]").datepicker();
    
    $("button[name=remarcar]").bind("click", function() {
        var id_remarcar = Number($(this).attr('id').split("_")[1]);
        $("div[id=remarcar_"+id_remarcar+"]").toggle(1000);
    });

});

