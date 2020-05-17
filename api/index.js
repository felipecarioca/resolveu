window.onload = function(){
    console.log(loadIndex());
   
};

function callIndex(){
    console.log(loadIndex());
}

function loadIndex(){
    $("main").empty();
    var div_container = $("<div class='container mt-4'></div>");
    var div_row = $("<div class=' row col-lg-12 col-sm-12 col-md-12 col-lg-4 mt-4'></div>");
    
    var div1 = $("<div class='col-4 col-sm-12 col-lg-4'></div>");
    var div_card_cli = $("<div class='card col-sm-12' style='width: 18rem;'></div>")
    var div_cardbody_cli=$("<div class='card-body'></div>");
    var h1_cardtitle_cli=$("<h5 class='card-title'>Clientes</h5>");
    var p_card_cli= $("<p class='card-text'>Lista de Clientes</p>");
    // var btn_cli=$("<button class='btn btn-success'onclick='loadCliente()'>Ver Lista</button>");
    var btn_cli=$("<input type='submit' class='btn btn-success'onclick='loadCliente()' value='ver lista'><br><br><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#clienteModal'>Cadastro Cliente</button>");
    div_cardbody_cli.append(h1_cardtitle_cli);
    div_cardbody_cli.append(p_card_cli);
    div_cardbody_cli.append(btn_cli);
    div_card_cli.append(div_cardbody_cli);
    div1.append(div_card_cli);
    div_row.append(div1);
    


    
    
    div_container.append(div_row);
    // var div_card_car
    // var div_card_f
    var imagem = $("<img alt='full screen background image' src='img/background.jpg' id='full-screen-background-image' />");
    $("main").append(imagem);
    
    $("main").append(div_container);
    console.log($("main").html());
}




