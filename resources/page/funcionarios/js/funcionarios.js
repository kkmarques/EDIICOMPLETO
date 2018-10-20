$(document).ready(function () {
    init();
});

function init() {
    masks();
    carregarClientes();
    VerificaCPF();
    recolherValoresBotaoAlterarCliente();
    recolherValoresApagarCliente();
    
}

function carregarClientes() {
    var table = $('#tabela-clientes').DataTable({
        "processing": true,
//        "order": [[getColumnIndexesWithClass(cols, "Resultado Gerencial"), "desc"]],
        "paging": true,
        "sPaginationType": "simple",
        "bLengthChange": false,
        "pageLength": 10,
//                    "responsive": true,
        "deferRender": true,
        "columnDefs": [
            {"searchable": false, "targets": [2,3,6]},
            {render: function (data, type, full, meta) {
                    
                    if (full[0].length === 10) {
                        var cpf = "0"+data;
                        return cpf.slice(0,3)+"."+cpf.slice(3,6)+"."+cpf.slice(6,9)+"-"+cpf.slice(9,11);
                        
                    } else {
                        var cpf1 = data;
                        return cpf1.slice(0,3)+"."+cpf1.slice(3,6)+"."+cpf1.slice(6,9)+"-"+cpf1.slice(9,11);;
                    }

               

                }, "targets": [0]},
            {render: function (data, type, full, meta) {
                    
                    if (full[0].length === 10) {
                        var cpf = "0"+data;
                        return cpf.slice(0,3)+"."+cpf.slice(3,6)+"."+cpf.slice(6,9)+"-"+cpf.slice(9,11);
                        
                    } else {
                        var cpf1 = data;
                        return cpf1.slice(0,3)+"."+cpf1.slice(3,6)+"."+cpf1.slice(6,9)+"-"+cpf1.slice(9,11);;
                    }

               

                }, "targets": [0]},
            
            {className: "alterarColumn", "targets": [9]},
            {className: "apagarColumn", "targets": [10]}
            
//            {className: "dt-right", "targets": getColumnIndexesWithClass(cols, "Resultado Gerencial")},
//            {className: "dt-center", "targets": getColumnIndexesWithClass(cols, "UF")},
//            {render: $.fn.dataTable.render.number('.', ',', 2), "targets": getColumnIndexesWithClass(cols, "Resultado Gerencial")},
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
        "fnDrawCallback": function (oSettings) {
            if($("#acessoAlterarClienteId").val() == false){
                $(".alterarColumn").hide();
            }
            if($("#acessoApagarClienteId").val() == false){
                 $(".apagarColumn").hide();
            }
        },

        "bInfo": true,
    });


};

function masks() {
    $("#cpf").mask("999.999.999-99");
    $("#telefoneResidencial").mask("(99)-9999-9999");
    $("#telefoneCelular").mask("(99) 9 9999-9999");
}


  

function VerificaCPF() {
    $("#cpf").change(function (){
        
        var cpf = $("#cpf").val();
        cpf = cpf.replace(".", "");
        cpf = cpf.replace(".", "");
        cpf = cpf.replace("-", "");
        
        if(vercpf(cpf) === true){
             $("#mensagemCpf").html("<span class='label label-success'>Válido</span>");
             $("#submitCliente").addClass("btn-success");
             $("#submitCliente").removeClass("btn-default");
             $("#submitCliente").prop("disabled", false);
        }else{
            $("#mensagemCpf").html("<span class='label label-danger'>Inválido!</span>");
            $("#submitCliente").addClass("btn-default");
            $("#submitCliente").prop("disabled", true);
        }
    
    });
    
    
}
function vercpf(cpf){
    if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
        return false;
    add = 0;
    for (i = 0; i < 9; i ++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
        return false;
    add = 0;
    for (i = 0; i < 10; i ++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
        return false;
//    alert('O CPF INFORMADO É VÁLIDO.');
    return true;
}
function recolherValoresBotaoAlterarCliente() {
    $(".alterar-cliente").click(function (){
    $("#nome-cliente").html(this.getAttribute("data-nome"));
    $("#nome-cliente").html(this.getAttribute("data-nome"));
    
    if(this.getAttribute("data-cpf").length === 10) {
        $("#cpfmodal").val("0"+this.getAttribute("data-cpf"));
    }else{
        $("#cpfmodal").val(this.getAttribute("data-cpf"));
    }
    
    $("#cpfhidden").val(this.getAttribute("data-cpf"));
    $("#nomemodal").val(this.getAttribute("data-nome"));
    $("#enderecomodal").val(this.getAttribute("data-endereco"));
    $("#telefoneResidencialmodal").val(this.getAttribute("data-telefoneresidencial"));
    $("#celularmodal").val(this.getAttribute("data-telefonecelular"));
    $("#cidademodal").val(this.getAttribute("data-cidade"));
    $("#bairromodal").val(this.getAttribute("data-bairro"));
    $("#emailmodal").val(this.getAttribute("data-email"));
    $("#profissaomodal").val(this.getAttribute("data-profissao"));
    
    
    $("#cpfmodal").mask("999.999.999-99");
    $("#telefoneResidencialmodal").mask("(99)-9999-9999");
    $("#celularmodal").mask("(99) 9 9999-9999");
    });
   
}

function recolherValoresApagarCliente() {
    $(".apagar-cliente").click(function () {
        $("#nome-apagarcliente").html(this.getAttribute("data-nome"));
        $("#cpfApagarUsuarioInput").val(this.getAttribute("data-cpf"));
        $("#nomeApagarUsuarioInput").val(this.getAttribute("data-nome"));
        if (this.getAttribute("data-cpf").length === 10) {
            $("#cpf-apagarcliente").html("0" + this.getAttribute("data-cpf"));
        } else {
            $("#cpf-apagarcliente").html(this.getAttribute("data-cpf"));
        }


    });
}

