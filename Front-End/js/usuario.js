var url = "http://localhost/Projeto_Final_Algoritmos_Programacao/Back-End/api/usuario";

var body = document.querySelector("body");

body.onload = function () {
    carregarUsuario();
}

var form = document.querySelector("#formulario");

form.onsubmit = function(event){
    event.preventDefault();
    var usuario = {};
    usuario.nome = document.querySelector("#txtnome").value;
    usuario.CPF = document.querySelector("#txtCPF").value;
    usuario.dataNascimento = document.querySelector("#txtdataNascimento").value;
    usuario.email = document.querySelector("#txtemail").value;
    usuario.senha = document.querySelector("#txtsenha").value;


    var idUsuario = document.querySelector("#txtidUsuario").value;
    if(idUsuario == "")
        enviarUsuario(usuario);
    else
    atualizarDadosUsuario(usuario, idUsuario);
}

function enviarUsuario(usuario){
    
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function(){
        if (this.readyState === 4 && this.status === 201) {
            console.log("Cadastrado com Sucesso");
            limparFormulario();
            carregarUsuario();
        }
            
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-Type","application/json");
    xhttp.send(JSON.stringify(usuario));
}

function editarUsuario(idUsuario){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function (){
        if (this.readyState === 4 && this.status ===200) {
                var usuario = JSON.parse(this.responseText);
                document.querySelector("#txtnome").value = usuario.nome;
                document.querySelector("#txtCPF").value = usuario.CPF;
                document.querySelector("#txtdataNascimento").value = usuario.dataNascimento;
                document.querySelector("#txtemail").value = usuario.email;
                document.querySelector("#txtsenha").value = usuario.senha;

                             
        }
    };
    xhttp.open("GET", url + "/" + idUsuario, true);
    xhttp.send();
}

function atualizarDadosUsuario(usuario, idUsuario){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        
        if (this.readyState === 4 && this.status === 200) {            
                console.log("Usuario atualizado com sucesso");
                limparFormulario();
                carregarUsuario();
        }
    };
        xhttp.open("PUT", url + "/" + idUsuario, true);
        xhttp.setRequestHeader("Content-Type","application/json");
        xhttp.setRequestHeader("Authorization", "Bearer " + sessionStorage.getItem('token'));
        xhttp.send(JSON.stringify(usuario));
}

function excluirUsuario(idUsuario) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            limparFormulario();
            carregarUsuario();
        }
    };
    xhttp.open("DELETE", url + "/" + idUsuario, true);
    xhttp.send();

}

function limparFormulario(){
    document.querySelector("#txtnome").value ="";
    document.querySelector("#txtCPF").value ="";
    document.querySelector("#txtdataNascimento").value ="";
    document.querySelector("#txtemail").value = "";
    document.querySelector("#txtsenha").value ="";

}

function confirmarExcluir(idUsuario) {
    if(confirm("Tem certeza que deseja excluir este registro?"))
        excluirUsuario(idUsuario);
    else 
        false;
}

function carregarUsuario() {

    var xhttp = new XMLHttpRequest(); 
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            montarTabela(JSON.parse(this.responseText));
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}

function montarTabela(usuario) {

    var str="";
    str+= "<table>";
    str+= "<tr>";
    str+= "<th>Nome</th>";
    str+= "<th>CPF</th>";
    str+= "<th>Data de Nascimento</th>";
    str+= "<th>E-mail</th>";
    str+= "<th>Senha</th>";
    str+= "<th colspan='2'>Ações</th>";
    str+= "</tr>";

    for(var i in usuario){
        str+="<tr>";
        str+="<td>" + usuario[i].nome + "</td>";
        str+="<td>" + usuario[i].CPF + "</td>";
        str+="<td>" + usuario[i].dataNascimento + "</td>";
        str+="<td>" + usuario[i].email + "</td>";
        str+="<td>" + usuario[i].senha + "</td>";
        str+="<td onclick='editarUsuario(" + usuario[i].idUsuario + ")'< class='beditar'>Editar</a></td>";
        str+="<td onclick='confirmarExcluir(" + usuario[i].idUsuario + ")' class='bexcluir'>Excluir</a></td>";
        str+="</tr>";
    } 
    str+= "</table>";

    var tabela = document.querySelector("#tabela");
    tabela.innerHTML = str;
}
