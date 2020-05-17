/*function loadCliente(){
    console.log(loadJsonCli());
}
function loadJsonCli(){
    $.get("http://localhost/projetoDEV/clientes",
        function(jsonObject){
            trataJsonCli(jsonObject);
        }
    );
}*/
/*
function trataJsonCli(jsonObject){
    if(jsonObject.length == 0){
        alert("Não há clientes cadastrados, favor cadastrar o primeiro!");
        console.log(callIndex());
    }else{
    $("main").empty();
    var btn_cliente= $(" <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#clienteModal'>Cadastro Cliente</button><br><br>");
    var btn_back=$("<button type='button' onclick='callIndex()' class='btn btn-secondary'>Voltar ao menu</button>");
    var div_content = $("<div class='container mt-4 mb-4'></div>");
    div_content.append(btn_cliente);
    var table = $("<table class='table table-bordered'style='text-align:center;background-color:white'></table>"); 
    var tbody = $("<tbody></tbody>");
    var trh = $("<tr></tr>");
    var th = $("<th>Nome</th><th>Telefone</th><th>Email</th><th>Ação</th>");
    trh.append(th);
    tbody.append(trh);
    table.append(tbody);
    div_content.append(table);
    var imagem = $("<img alt='full screen background image' src='img/background.jpg' id='full-screen-background-image' />");
    div_content.append(btn_back);
    $("main").append(imagem);
    for(var indice in jsonObject){
        var tr = $("<tr></tr>");
        var td_nome= $("<td></td>");
        var td_telefone= $("<td></td>");
        var td_email= $("<td></td>");
       
        // var td_acao= $("<td><a href='#' onclick='deletaCliente("+jsonObject[indice].id+")'>Deletar</a><a href='' onclick='getClientebyId("+jsonObject[indice].id+")'>Editar</a></td>");
        // var td_acao= $("<td><button type='button' class='btn btn-secondary' onclick='deletaCliente("+jsonObject[indice].id+")'>Deletar</button><button type='button' class='btn btn-primary' onclick='editaCliente("+jsonObject[indice].id+")' data-toggle='modal' data-target='#clientEditModal'>Edit Cliente</button></td>");
        var td_acao= $("<td><button type='button' class='btn btn-danger' onclick='deletaCliente("+jsonObject[indice].id+")'>Deletar</button>  <input type='submit' class='btn btn-primary' value='Edita Cliente' onclick='getClientebyIdEdit("+jsonObject[indice].id+")'></td>");
        td_nome.append(jsonObject[indice].nome);
        td_telefone.append(jsonObject[indice].telefone);
        td_email.append(jsonObject[indice].email);
        //td_acao.append(jsonObject[indice].id);
        tr.append(td_nome);
        tr.append(td_telefone);
        tr.append(td_email);       
        tr.append(td_acao);
        tbody.append(tr);     
        //this.cli[indice] = new Cliente(); 
        $("main").append(div_content);
        console.log($("main").html());
    }
}
}*/
var form = document.querySelector("#cliente_cadastro");
form.onsubmit = function(event){
    event.preventDefault();
    var clientee = new Cliente();
    clientee.id = 0;
    clientee.nome = document.querySelector("#nome_c").value;
    clientee.email = document.querySelector("#email_c").value;
    clientee.cpf = document.querySelector("#cpf_c").value;
    clientee.telefone = document.querySelector("#tel_c").value;
    clientee.cep = document.querySelector("#cep").value;
    clientee.login = document.querySelector("#login").value;
    clientee.senha = document.querySelector("#senha_c").value;

    //var senha2 = document.querySelector("#conf_senha_c").value;
    // if(senha2 === clientee.senha){
    //   cadastraCliente(clientee);
    // }else{
    // document.querySelector("#senha_c").value="";
    // document.querySelector("#conf_senha_c").value="";
    // alert("As senhas não batem.");
    // }
    
}
function cadastraCliente(Cliente){
    //$.post("http://localhost/Locadora/clientes", Cliente,"json");   
    $.ajax({
            url: 'http://localhost/projetoDEV/clientes',
            type: 'POST',
            data: Cliente,
            success: function(result) {
                console.log(loadCliente());
                alert("Cliente cadastrado com sucesso!");
            }
        });
    limparFormulariocli();
}
function limparFormulariocli(){
    document.querySelector("#nome_c").value="";
    document.querySelector("#email_c").value="";
    document.querySelector("#cpf_c").value="";
    document.querySelector("#tel_c").value="";
    document.querySelector("#senha_c").value="";
    document.querySelector("#conf_senha_c").value="";
}

/*
function deletaCliente(id){
    $.ajax({
        url: 'http://localhost/projetoDEV/clientes/'+id,
        type: 'DELETE',
        success: function(result) {
            console.log(loadCliente());
            alert("Cliente deletado com sucesso!");
        }
    });
}

function getClientebyIdEdit(id){
   
    $.get("http://localhost/Locadora/clientes/"+id,
        function(jsonObject){
            exibeCardEditClient(jsonObject);
            
        }
    );
}

function exibeCardEditClient(jsonObject){
    $("main").empty();
    var divContainer = $("<div class='container mt-4'></div>");
    var imagem = $("<img alt='full screen background image' src='img/background.jpg' id='full-screen-background-image' />");
    $("main").append(imagem);
    var divWidth = $("<div class='container mt-4 mb-4'></div>");
    var divContent = $("<div class='content'></div>");
    var divCard = $("<div class='card mt-4'></div>");
    var divCO = $("<div class='card-overlay'></div>");
    var title = $("<h5 class='card-title'>Editar Cliente " +jsonObject.nome+ "</h5>");
        var x = jsonObject.nome;    
    var form_edit = $("<form id='cliente_edit'></form>");
    var div1 = $("<div class='form-group' col-12><label class='col-form-label'>Nome Completo</label><input type='text'  required='required' pattern='[a-zA-Z\\s]+$' minlength='15' maxlength='100' class='form-control' id='nome_c_edit' value='"+jsonObject.nome+"'></div>");
    var div2 = $("<div class='form-group' col-12><label class='col-form-label'>Email</label><input type='email' minlength='15' pattern='[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$' maxlength='100' class='form-control' id='email_c_edit' value='"+jsonObject.email+"'></div>");
    var div3 = $("<div class='form-group' col-12><label class='col-form-label'>CPF</label><input type='text' required='required'  minlength='10' maxlength='10' pattern='[0-9]+$'  class='form-control' id='cpf_c_edit' value='"+jsonObject.cpf+"'></div>");
    var div4 = $("<div class='form-group' col-12><label class='col-form-label'>Telefone</label><input type='text' required='required' pattern='[0-9]+$'  minlength='9' maxlength='12' class='form-control' id='telefone_c_edit' value='"+jsonObject.telefone+"'></div>");
    var div5 = $("<div class='card-footer'><button type='button'class='btn btn-secondary' onclick='loadJsonCli()'>Cancelar</button> <input  type='submit' class='btn btn-primary' value='Editar'></div>");
    var divhide =$("<input type='hidden' id='id_cliente' value="+jsonObject.id+">");
    var divhid2 =$("<input type='hidden' id='senha_c_edit' value="+jsonObject.senha+">");
    jsonObject
    form_edit.append(div1);
    form_edit.append(div2);
    form_edit.append(div3);
    form_edit.append(div4);
    
    form_edit.append(divhide);
    form_edit.append(divhid2);
    form_edit.append(div5);
    divWidth.append(title);
    divWidth.append(form_edit);
    divCO.append(divWidth);
    divCard.append(divCO);
    divContent.append(divCard);
    divContainer.append(divContent);
    $("main").append(divContainer);
    console.log($("main").html());

    var edit = document.querySelector("#cliente_edit");
    edit.onsubmit = function(event){
        event.preventDefault();
        var clientee = new Cliente();

        clientee.nome = document.querySelector("#nome_c_edit").value;
        clientee.email = document.querySelector("#email_c_edit").value;
        clientee.cpf = document.querySelector("#cpf_c_edit").value;
        clientee.telefone = document.querySelector("#telefone_c_edit").value;
        // clientee.senha = document.querySelector("#senha_c_edit").value;
        clientee.id = jsonObject.id;
        clientee.senha = jsonObject.senha;

        editaCliente(clientee);
       }
   }
function editaCliente(jsonObject){
        $.ajax({
         url: 'http://localhost/Locadora/clientes/'+jsonObject.id,
        type: 'PUT',
        data: jsonObject,
        success: function(result) {
            alert("Cliente atualizado com sucesso!");
             console.log(loadCliente());
        }
    });
        
 }
*/

