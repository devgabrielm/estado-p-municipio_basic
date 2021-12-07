<!doctype html>
<html lang="pt-br">
<head>
    <title>API IBGE | Consultar</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body>
    <!-- CDN Jquery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <select name="" id="estados" onchange="alteraCidades(this.value)"></select>
    <select name="" id="cidades">
        <option value="">Selecione um estado</option>
    </select>

    <script>
    $(document).ready(function() {
        //Armazene na variável url o valor =>
        let url = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome'
        //Pegue o Json adquirido com base na variável url e crie a função que recebe a resposta
        $.getJSON(url, function(response) {
            //Se a resposta desta consulta de Json for diferente de nula e/ou não definida
            if (response != null || response != undefined) {
                //A variável estados recebe a resposta (json)
                var estados = response
                //Variavel qtd recebe o tamanho do array estados
                this.qtd = estados.length;
                //Variavel listar recebe o  id do elemento  HTML estados
                var listar = document.getElementById('estados');
                //Variavel output recebe vazio
                var output = '';
                //Enquanto i for menor que 0, menor que o tamanho do array, incremente 1
                for (i = 0; i < this.qtd; i++) {
                    //Crie em HTML uma option  com o valor do array estados no indice i coletando o valores de sigla e nome   
                    output += `<option value="${estados[i].id}">${estados[i].nome}</option>`
                    var idEstado = estados[i].id;
                }
                listar.innerHTML = output;
            }
        })
    })
    </script>
    <script>
    //Função que é executada quando o parâmetro informado é alterado
    function alteraCidades(idEstado) {
        //Armazene na variável url o valor =>
        let url =
            `https://servicodados.ibge.gov.br/api/v1/localidades/estados/${idEstado}/municipios`
        //Pegue o Json adquirido com base na variável url e crie a função que recebe a resposta
        $.getJSON(url, function(response) {
            //Se a resposta desta consulta de Json for diferente de nula e/ou não definida
            if (response != null || response != undefined) {
                //A variável cidades recebe a resposta (json)
                var cidades = response
                //Variavel qtd recebe o tamanho do array cidades
                this.qtd = cidades.length;
                //Variavel listar recebe o  id do elemento  HTML cidades
                var listar = document.getElementById('cidades');
                //Variavel output recebe vazio
                var output = '';
                //Enquanto i for menor que 0, menor que o tamanho do array, incremente 1
                for (i = 0; i < this.qtd; i++) {
                    //Com base no id, crie em HTML uma option  com o valor do array cidades no indice i coletando o valor de nome   
                    output +=
                        `<option value="${cidades[i].nome}">${cidades[i].nome}</option>`
                }
                listar.innerHTML = output;
            }
        })
    }
    </script>
</body>
</html>