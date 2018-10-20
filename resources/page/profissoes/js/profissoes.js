$(document).ready(function () {
    init();
});

function init() {
    
    carregarProfissoes();
    recolherValoresApagarProfissao();
    recolherValoresBotaoAlterarCliente();
    recolherValoresBotaoGerenciarLancamentos();
    modalGerenciaLancamentos();
    apagarLancamentoProfissoes();
    incluirLancamentoProfissoes();
    $(".loader").hide();
}


function carregarProfissoes() {
    var table = $('#tabela-profissoes').DataTable({
        "processing": true,
//        "order": [[getColumnIndexesWithClass(cols, "Resultado Gerencial"), "desc"]],
        "paging": true,
        "sPaginationType": "simple",
        "bLengthChange": false,
        "pageLength": 10,
//                    "responsive": true,
        "deferRender": true,
        "columnDefs": [
   
            {className: "dt-right", "targets": [2]},
            {render: $.fn.dataTable.render.number('.', ',', 2), "targets": [2]}
//            
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
            "searchPlaceholder": "Filtrar ...",
            "sSearch": "",
            "sZeroRecords": "Nenhum registro encontrado",
            "info": "Página _PAGE_ de _PAGES_",
            "sInfoEmpty": "",
            "sInfoFiltered": "",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            }
        },
        "columnDefs": [{className: "alterarColumn", "targets": [3]},
                       {className: "apagarColumn", "targets": [4]}
        ],
        "fnDrawCallback": function (oSettings) {
            if($("#acessoAlterarProfissoes").val() == false){
                $(".alterarColumn").hide();
            }
            if($("#acessoApagarProfissoes").val() == false){
                 $(".apagarColumn").hide();
            }
        },

        "bInfo": true,
    });


};

function recolherValoresApagarProfissao(){
    $(".apagar-profissao").click(function (){
        console.log(this.getAttribute("data-nomeProfissao"));
        $("#nome-apagar-profissao").html(this.getAttribute("data-nomeProfissao"));
        $("#nomeProfissaoInputModalApagar").val(this.getAttribute("data-nomeProfissao"));
        $("#idprofissaoInputModalApagar").val(this.getAttribute("data-idProfissao"));
        
    });
}

function recolherValoresBotaoAlterarCliente() {
    $(".alterar-profissao").click(function (){
        $("#tituloProfissaoEditar").html(this.getAttribute("data-nomeProfissao"));
        $("#nomeProfissaoModal").val(this.getAttribute("data-nomeProfissao"));
        $("#salarioProfissaoModal").val(this.getAttribute("data-salarioProfissao"));
        $("#descricaoProfissaoModal").val(this.getAttribute("data-descricaoProfissao"));
        $("#idProfissaoModal").val(this.getAttribute("data-idProfissao"));
    });
}

function recolherValoresBotaoGerenciarLancamentos(){
    $(".gerencia-lancamentos").click(function (){
        $("#tituloProfissaoFinanceiro").html(this.getAttribute("data-nomeProfissao"));
    });
}

function modalGerenciaLancamentos(){
    $("#btnAdicionarLancamentoProfissoesModal").click(function(){
        $("#adicionarLancamentoProfissaoModal").show();
    });
    
    $("#cancelarLancamentoProfissoesModal").click(function (){
        $("#nomeLancamentoProfissao").val("");
        $("#valorLancamentoProfissao").val("");
        
       $("#adicionarLancamentoProfissaoModal").hide(); 
    });
     $(".gerenciarLancamentosProfissao").click(function (){
         $("#tituloProfissaoFinanceiro").html(this.getAttribute("data-nomeprofissao"));
       $("#idProfissaoSelecionada").val(this.getAttribute("data-idprofissao"));
    });
    
}


function apagarLancamentoProfissoes() {
    $(".apagar-lancamento-profssao").click(function () {
        $(".loader").show();
        $("#mensagem").html("");
        var idTr = "#" + this.getAttribute("data-idLancamentoProfissao") + "";
        console.log(idTr);
        $.post('../../../servidor/profissoes/apagarLancamentoProfissao.php', {
            idLancamentoProfissao: this.getAttribute("data-idLancamentoProfissao")

        }, function () {
            $(idTr).remove();
            $(".loader").hide();
            $("#mensagem").html("<span style='color:green;' class='glyphicon glyphicon-ok'></span> <label style='color:green;'>Foi apagado com sucesso! </label>");
        });
//                
    });
}



function incluirLancamentoProfissoes() {
    $("#bntAdicionarLancamentoProfissaoModal").click(function () {
        $("#adicionarLancamentoProfissaoModal").hide(); 
        $(".loader").show();
        $("#mensagem").html("");
        if($("#nomeLancamentoProfissao").val()== ""  || $("#valorLancamentoProfissao").val() == ""){
            $(".loader").hide();
            $("#mensagem").html("<span style='color:red;' class='glyphicon glyphicon-remove'></span> <label style='color:red;'>Preencha todos os campos obrigatorios!</label>");
        } else {
            $.post('../../../servidor/profissoes/incluirLancamentoProfissao.php', {
                nomeProfissao: $("#nomeLancamentoProfissao").val(),
                salarioProfissao: $("#valorLancamentoProfissao").val(),
                idDependenciaProfissao: $("#idDependenciaModal").val(),
                idProfissaoSelecionada: $("#idProfissaoSelecionada").val()
            }, function () {
                $(".loader").hide();
                $("#mensagem").html("<span style='color:green;' class='glyphicon glyphicon-ok'></span> <label style='color:green;'>Lançamento adicionado com sucesso!</label>");
            })

        }

        
             
    });
}