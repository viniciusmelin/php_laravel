function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    $("#logradouro").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
}

$("#cep").blur(function() {

    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        if(validacep.test(cep)) {

           
            $("#logradouro").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");
            $("#uf").val("...");

            
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#logradouro").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    $("#cidade").val(dados.localidade);
                    $("#uf").val(dados.uf);
                }
                else {
                    limpa_formulário_cep();
                    alert("CEP não encontrado.");
                }
            });
        }
        else {
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    }
    else {
        limpa_formulário_cep();
    }
});