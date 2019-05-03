/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $(".areaTexto").bind("input keyup paste", limitadorDeCaracteres);
    
    $("input[name=cpf]").bind("blur", function () {
        validarCpf($(this).val());
    });
    
    $("input[name=telefone]").bind("blur", function () {
        validarTelefone($(this).val());
    });
	
	$("input[name=telefone]").bind("keydown", function (e) {
        return apenasNumeros(e);
    });
	
	$("input[name=cpf]").bind("keydown", function (e) {
		return apenasNumeros(e);
    });
    
    $("input[name=btnCadastrarProfessor]").bind("click", function () {
        return validarFormulario();
    });
    
    $("input[name=cadastro-aluno]").bind("click", function() {
        
        var senha = $("input[name=senha-aluno]").val();
        var rSenha = $("input[name=repetir-senha-aluno]").val();
        
        if (!confirmarSenha(senha, rSenha)) {
            alert("Senhas são diferentes");
            $("input[name=repetir-senha-aluno]").focus();
            return false;
        }
        return true;
    });
    
});

function validarCpf(cpf) {
    var cpfEsperado = /^([\d]{3})([\d]{3})([\d]{3})([\d]{2})$/;
    
    if (cpfEsperado.test(cpf)) {
        $("input[name=cpf]").val($("input[name=cpf]").val().replace(cpfEsperado, "$1.$2.$3-$4"));
        return true;
    } else {
        alert("CPF inválido");
        $("input[name=cpf]").val('');
    }
    
    return false;
    
}

function validarTelefone(telefone) {
    var telefoneEsperado = /^([\d]{1})([\d]{4})([\d]{4})$/;
    
    if (telefoneEsperado.test(telefone)) {
        $("input[name=telefone]").val($("input[name=telefone]").val().replace(telefoneEsperado, "$1 $2-$3"));
        return true;
    }
    
    return false;
    
}

function validarNome(nome) {
    var nomeEsperado = /^([A-Za-z])+$/;    
    if (nome === '') {
        return false;
    }    
    if (!nome.match(nomeEsperado)) {
        return false;
    }
    return true;    
}

function validarEmail(email) {
    var emailEsperado = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    if (email === " ") {
        return false;
    }
    if (!email.match(emailEsperado)) {
        return false;
    }
    return true;
}

function validarSenha(senha) {
    var senhaEsperada = /^[A-Za-z\d]+$/;
    if (!senha.match(senhaEsperada)) {
        return false;
    }
    return true;
}

function confirmarSenha(senha, rSenha) {
    if (senha.length === rSenha.length) {
        for (var i = 0; i < senha.length; i++) {
            if (senha.charAt(i) !== rSenha.charAt(i)) {
                return false;
            }
        }
    } else {
        return false;
    }
    return true;
}

function validarFormatoDiploma(arquivo) {
    var formatoEsperado = ".pdf";
    var formatoRecebido = arquivo.substr(arquivo.length-4, 4);
    if (formatoRecebido.toLowerCase() !== formatoEsperado) {
        return false;
    }
    return true;
}

function apenasNumeros(e) {
    var keyCode = e.which;
    var isStandard = (keyCode > 47 && keyCode < 58);
    var isOther = (",8,9,37,38,39,40,".indexOf(","+keyCode+",") > -1);
    if (isStandard || isOther) {
        return true;
    }
    return false;
}

function validarNomeUsuario(nomeUsuario) {
    var usuarioEsperado = "ABCDEFGHIJLMNOPQRSTUVXZÇKWY0123456789-.";
    if (nomeUsuario === "") {
        return false;
    }
    for (var i = 0; i < nomeUsuario.length; i++) {
        if (usuarioEsperado.toLowerCase().indexOf(nomeUsuario.toLowerCase().charAt(i)) < 0) {
            return false;
        }
    }
    return true;
}

function limitadorDeCaracteres() {
    var maximoDeCaracteres = 500;
    var disponivel = maximoDeCaracteres - $(".areaTexto").val().length;
    if (disponivel < 0) {
        var texto = $(".areaTexto").val().substr(0, maximoDeCaracteres);
        $(".areaTexto").val(texto);
        disponivel = 0;
    }
    $(".contagem").text(disponivel);
}

function validarFormulario() {
    if (!validarEmail($("input[name=email]").val())) {
        $("input[name=email]").focus();
        alert("Email inválido");
        return false;
    } else if (!confirmarSenha($("input[name=senha]").val(), $("input[name=rSenha]").val())) {
        $("input[name=rSenha]").focus();
        alert("Senhas são diferentes");
        return false;
    } else if (!validarFormatoDiploma($("input[name=diploma]").val())) {
        $("input[name=diploma]").focus();
        alert("Formarto do diploma inválido");
        return false;
    } else if (!validarNomeUsuario($("input[name=nomeUsuario]").val())) {
        $("input[name=nomeUsuario]").focus();
        alert("Nome de usuário inválido");
        return false;
    }
    
    return true;
    
}