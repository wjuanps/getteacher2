/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var estados = [
    ["Acre", "Alagoas", "Amapá", "Amazonas", "Bahia", "Ceará", "Destrito Federal", "Maranhão", "Mato Grosso", "Mato Grosso do Sul", "Minas Gerais", "Pará", "Paraíba", "Paraná", "Pernambuco", "Piauí", "Rio de Janeiro", "Rio Grande do Norte", "Rio Grande do Sul", "Roraima", "Roraima", "São Paulo", "Santa Catarina", "Sergipe", "Tocantins"],
    ["AC", "AL", "AP", "AM", "BA", "CE", "DF", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RS", "RO", "RR", "SP", "SC", "SE", "TO"]
];

var categorias = [
    ["Ingles", "Frances", "Alemão", "Mandarin", "Japonês", "Chinês", "Libras", "Italiano", "Português para Estrangeiros"],
    ["Matematica", "Computação", "Fisica", "Quimica", "Cálculo", "Estatística", "Engenharia", "Matemática Financeira"],
    ["Ciências Sociais", "Geografia", "História", "Filosofia", "Sociologia", "Psicologia", "Direito"],
    ["Nutrição", "Terapia Ocupacional", "Biologia", "Zootecnia", "Fonoaudiologia", "Educação Física"],
    ["Arte Digital", "Dança", "Pintura", "Desenho", "Fotografia", "Teatro", "Esportes", "Culinária"],
    ["Aula de Canto", "Instrumentos", "Música Clássica", "Música[Outros]"],
    ["Português", "Redação", "Gramática", "Literatura", "Pedagogia", "Linguagens[Outros]"],
    ["Desenvolvimento e Sustentabilidade", "Direito e Legislação Ambiental", "Economia de Recursos Naturais", "Educação Ambiental", "Saúde e Meio Ambiente", "Outros"]
];

var areas = ["Idiomas", "Exatas", "Humanas", "Biológicas", "Artes", "Música", "Linguagens", "Meio Ambiente"];

$(document).ready(function () {
    
    carregarEstados();
    
    $("#entrar").bind("click", function () {
        $("#telaLogin").slideToggle(1000);
        $(this).toggleClass("active");
    });

    var area = $("#a").val();
    if (area !== undefined) {
        selecionarCategoria(area, "categoria");
    }

    $("#area").bind("change", function () {
        selecionarCategoria($(this).val(), "categoria");
    });
    
    $("#area2").bind("change", function () {
        selecionarCategoria($(this).val(), "categoria2");
    });

});

function carregarEstados() {
    $("select[name=estado]").empty();
    for (var i = 0; i < estados[0].length; i++) {
        $("select[name=estado]").append("<option value='" + estados[1][i] + "' >" + estados[0][i] + "</option>");
    }
}

function selecionarCategoria(area, elemento) {
    var option = new Array();
    for (var i = 0; i < areas.length; i++) {
        if (area === areas[i]) {
            for (var j = 0; j < categorias[i].length; j++) {
                option[j] = $("<option>" + categorias[i][j] + "</option>", {
                    value: categorias[i][j]
                });
            }
            break;
        }
    }

    $("#"+elemento).empty()
            .prepend("<option>" + area + "</option>")
            .append(option);

}

