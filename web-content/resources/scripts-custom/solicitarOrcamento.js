/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
  
    $("#prox-passo").bind("click", function () {
        if ($("#liSobreAula").hasClass("active")) {
            $("#liSobreAula").removeClass("active");
            $("#liSobreVoce").addClass("active");
        }
    });

    $("#voltar").bind("click", function () {
        if ($("#liSobreVoce").hasClass("active")) {
            $("#liSobreVoce").removeClass("active");
            $("#liSobreAula").addClass("active");
        }
    });

    $("#solicitar-orcamento").bind("click", function () {
        $("#div-agendamento").slideUp(2000);
        $("#div-orcamento").slideToggle(2000);
    });


    $("#enviar-solicitacao").bind("click", enviarSolicitacao);
   
    $("#date").datepicker();
    
    $("#agendar-aula").bind("click", function () {
        $("#div-orcamento").slideUp(2000);
        $("#div-agendamento").slideToggle(2000);
    });

});

function enviarSolicitacao() {

    var id_professor = $("#id_professor").text();
    var mensagem = "Sua solicitação foi enviada com sucesso! Aguarde uma resposta do professor.";

    var especialidade = $("#especialidade").val(),
        nivel = $("#nivel").val(),
        tipo_aula = $("#tipo-aula").val(),
        necessidade = $("#necessidade").val(),
        nome = $("#nome-aluno").val(),
        email = $("#email-aluno").val(),
        cep = $("#cep-aluno").val(),
        telefone = $("#tel-aluno").val(),
        tipo_endereco = $("#tipo-endereco").val();

        $.ajax({
            type: 'POST',
            url: '../area-restrita/professor/orcamento/solicitarOrcamento.php',
            data: {
                especialidade: especialidade, nivel: nivel, tipo_aula: tipo_aula, necessidade: necessidade,
                nome: nome, email: email, cep: cep, telefone: telefone, tipo_endereco: tipo_endereco,
                id_professor: id_professor
            },
            dataType: 'json',
            success: function (retorno) {
                $(".solicitacao").each(function () {
                    $(this).val('');
                });

                if (retorno.res === 'Ok') {
                    mostrarMensagem(mensagem, "info");
                }
                
                $("#div-orcamento").slideToggle(2000);                
            },
            error: function () {
                alert("Error");
            }
        });
}

function mostrarMensagem(mensagem, classe) {
    if ($("div.men-erro").hasClass('hidden')) {
        $("div.men-erro").removeClass('hidden');
        $("div.e").addClass('alert-' + classe);
        $("h5.m").text(mensagem);
    } else {
        $("h5.m").text(mensagem);
    }
}