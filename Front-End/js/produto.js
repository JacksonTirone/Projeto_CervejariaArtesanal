var url = "http://localhost/Projeto_Final_Algoritmos_Programacao/Back-End/api/produto";

var body = document.querySelector("body");

body.onload = function () {
    carregarProdutos();
}

var form = document.querySelector("#formulario");

form.onsubmit = function(event){
    event.preventDefault();
    var produto = {};
    produto.nome = document.querySelector("#txtnome").value;
    produto.descricao = document.querySelector("#txtdescricao").value;
    produto.unidadeDePeso = document.querySelector("#txtunidadeDePeso").value;
    produto.preco = document.querySelector("#txtpreco").value;
    produto.tipoCerveja = document.querySelector("#txttipoCerveja").value;
    produto.porcentagemAlcoolica = document.querySelector("#txtporcentagemAlcoolica").value;
    produto.marca_idMarca = document.querySelector("#txtmarca_idMarca").value;


    var idProduto = document.querySelector("#txtidProduto").value;
    if(idProduto == "")
        enviarProduto(produto);
    else
    atualizarDadosProdutos(produto, idProduto);
}

function enviarProduto(produto){
    
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function(){
        if (this.readyState === 4 && this.status === 201) {
            console.log("Enviado");
            limparFormulario();
            carregarProdutos();
        }
            
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-Type","application/json");
    xhttp.send(JSON.stringify(produto));
}

function editarProduto(idProduto){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function (){
        if (this.readyState === 4 && this.status ===200) {
                var produto = JSON.parse(this.responseText);
                document.querySelector("#txtnome").value = produto.nome;
                document.querySelector("#txtdescricao").value = produto.descricao;
                document.querySelector("#txtunidadeDePeso").value = produto.unidadeDePeso;
                document.querySelector("#txtpreco").value = produto.preco;
                document.querySelector("#txttipoCerveja").value = produto.tipoCerveja;
                document.querySelector("#txtporcentagemAlcoolica").value = produto.porcentagemAlcoolica;
                document.querySelector("#txtmarca_idMarca").value = produto.marca_idMarca;
                document.querySelector("#txtidProduto").value = produto.idProduto;
                             
        }
    };
    xhttp.open("GET", url + "/" + idProduto, true);
    xhttp.send();
}

function atualizarDadosProdutos(produto, idProduto){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        
        if (this.readyState === 4 && this.status === 200) {            
                console.log("Response recebido!");
                limparFormulario();
                carregarProdutos();
        }
    };
        xhttp.open("PUT", url + "/" + idProduto, true);
        xhttp.setRequestHeader("Content-Type","application/json");
        xhttp.send(JSON.stringify(produto));
}

function excluirProduto(idProduto) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            limparFormulario();
            carregarProdutos();
        }
    };
    xhttp.open("DELETE", url + "/" + idProduto, true);
    xhttp.send();

}

function limparFormulario(){
    document.querySelector("#txtnome").value ="";
    document.querySelector("#txtdescricao").value ="";
    document.querySelector("#txtunidadeDePeso").value ="";
    document.querySelector("#txtpreco").value = "";
    document.querySelector("#txttipoCerveja").value ="";
    document.querySelector("#txtporcentagemAlcoolica").value ="";
    document.querySelector("#txtmarca_idMarca").value ="";
    document.querySelector("#txtidProduto").value ="";
}

function confirmarExcluir(idProduto) {
    if(confirm("Tem certeza que deseja excluir este registro?"))
        excluirProduto(idProduto);
    else 
        false;
}

function carregarProdutos() {

    var xhttp = new XMLHttpRequest(); 
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            montarTabela(JSON.parse(this.responseText));
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}

function montarTabela(produto) {

    var str="";
    str+= "<table>";
    str+= "<tr>";
    str+= "<th>Nome</th>";
    str+= "<th>Descrição</th>";
    str+= "<th>Peso</th>";
    str+= "<th>Preco</th>";
    str+= "<th>Tipo Cerveja</th>";
    str+= "<th>Porcentagem Alcoolica</th>";
    str+= "<th colspan='2'>Ações</th>";
    str+= "</tr>";

    for(var i in produto){
        str+="<tr>";
        str+="<td>" + produto[i].nome + "</td>";
        str+="<td>" + produto[i].descricao + "</td>";
        str+="<td>" + produto[i].unidadeDePeso + "</td>";
        str+="<td>" + produto[i].preco + "</td>";
        str+="<td>" + produto[i].tipoCerveja + "</td>";
        str+="<td>" + produto[i].porcentagemAlcoolica + "</td>";
        str+="<td onclick='editarProduto(" + produto[i].idProduto + ")'< class='beditar'>Editar</a></td>";
        str+="<td onclick='confirmarExcluir(" + produto[i].idProduto + ")' class='bexcluir'>Excluir</a></td>";
        str+="</tr>";
    } 
    str+= "</table>";

    var tabela = document.querySelector("#tabela");
    tabela.innerHTML = str;
}
