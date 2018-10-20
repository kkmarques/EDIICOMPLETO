$(document).ready(function () {
    init();
});

function init() {
    $("#divpermissoes").hide();
    carregarPermissoesUsuario();
    updateAcessos();
    $(".loader").hide();
  
}

function carregarPermissoesUsuario() {
    $("#usuarios").change(function () {
        if ($("#usuarios").val() === 'Selecione o usuário') {
            $("#divpermissoes").hide();
        } else {
            $("#mensagem").html("");
            $('#moduloClientesCadastrados').prop('checked', false);
            $('#paginaCadastroClientes').prop('checked', false);
            $('#cadastroClientesFormulario').prop('checked', false);
            $('#cadastroClientesConsulta').prop('checked', false);
            $('#controleAcessoTemp').prop('checked', false);
            $('#cadastroClienteEditarCliente').prop('checked', false);
            $('#cadastroClienteApagarCliente').prop('checked', false);
            $('#paginaProfissao').prop('checked', false);
            $('#cadastroProfissaoFormulario').prop('checked', false);
            $('#cadastroProfissaoConsulta').prop('checked', false);
            $('#cadastroProfissaoEditarProfissao').prop('checked', false);
            $('#cadastroProfissaoExcluirProfissao').prop('checked', false);
            
            $.post('../../../servidor/controle-acesso/permissoesJson.php',
                    {
                        usuario: $(this).find('option:selected')[0].dataset.nomeusuario
                    }, function (response) {

                var obj = $.parseJSON(response);

                $("#verificacaoUsuario").html("PERMISSÕES DO " + $("#usuarios").val().toUpperCase());


                $('#moduloClientesCadastrados').prop('checked', converterBoolean(obj[0].ModuloClientesCadastrados));
                $('#paginaCadastroClientes').prop('checked', converterBoolean(obj[0].PaginaCadastroClientes));
                $('#cadastroClientesFormulario').prop('checked', converterBoolean(obj[0].CadastroClientesFormulario));
                $('#cadastroClientesConsulta').prop('checked', converterBoolean(obj[0].CadastroClientesConsulta));
                $('#controleAcessoTemp').prop('checked', converterBoolean(obj[0].ControleAcessoTemp));
                $('#cadastroClienteEditarCliente').prop('checked', converterBoolean(obj[0].CadastroClienteEditarCliente));
                $('#cadastroClienteApagarCliente').prop('checked', converterBoolean(obj[0].CadastroClienteApagarCliente));
                $('#paginaProfissao').prop('checked', converterBoolean(obj[0].PaginaProfissao));
                $('#cadastroProfissaoFormulario').prop('checked', converterBoolean(obj[0].CadastroProfissaoFormulario));
                $('#cadastroProfissaoConsulta').prop('checked', converterBoolean(obj[0].CadastroProfissaoConsulta));
                $('#cadastroProfissaoEditarProfissao').prop('checked', converterBoolean(obj[0].CadastroProfissaoEditarProfissao));
                $('#cadastroProfissaoExcluirProfissao').prop('checked', converterBoolean(obj[0].CadastroProfissaoExcluirProfissao));
                
                
                $("#divpermissoes").show();

            });
        }
    });
}

function converterBoolean(boolean) {
    if (boolean === 't') {
        return true;
    } else {
        return false;
    }
}
function updateAcessos() {
    $(".checkboxAcesso").change(function () {
        $(".loader").show();
        $("#mensagem").html("");
        $.post('../../../servidor/controle-acesso/updateAcessos.php',
                {
                    usuario: $("#usuarios").val(),
                    coluna: this.getAttribute("data-nomecoluna"),
                    valor: $(this).prop('checked')
                }, function (response) {
            $(".loader").hide();
            $("#mensagem").html("<span style='color:green;' class='glyphicon glyphicon-ok'></span> <label style='color:green;'>Salvo com sucesso! </label>");
        });

    });
}