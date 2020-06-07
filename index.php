<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Resolveu - Plataforma Online de Serviços</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
    Baseado no template Becor   https://bootstrapmade.com/
   - Modificações: Lucas Soares.
  ======================================================== -->
</head>

<body>
<!-- Modal Registro e Login -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div id="logreg-forms">
        <form class="form-signin">
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Para realizar a busca você deve logar. </h1>
         <!--   <div class="social-login">
                <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Logar com Facebook</span> </button>
                <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Logar com Google+</span> </button>
            </div>-->
            <p style="text-align:center"></p>
            <input type="email" id="inputEmail" class="form-control" placeholder="Endereço de E-mail" required="" autofocus="">
            <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required="">
            
            <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Logar</button>
            <a href="#" id="forgot_pswd">Esqueceu a senha ?</a>
            <hr>
            <!-- <p>Don't have an account!</p>  -->
            <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Clique aqui para realizar o cadastro</button>
            </form>

            <form action="/reset/password/" class="form-reset">
                <input type="email" id="resetEmail" class="form-control" placeholder="Endreço de E-mail" required="" autofocus="">
                <button class="btn btn-primary btn-block" type="submit">Resetar senha</button>
                <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Voltar</a>
            </form>
            
            <form action="/signup/" class="form-signup">

              <!--<div class="social-login">
                    <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Logar com Facebook</span> </button>
                </div>
                <div class="social-login">
                    <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Logar com Google+</span> </button>
                </div>
              -->
                <p style="text-align:center">Informe os dados para realizar o cadastro</p>

                <input type="text" id="user-name" class="form-control" placeholder="Seu nome" required="" autofocus="">
                <input type="email" id="user-email" class="form-control" placeholder="Endereço de E-mail" required autofocus="">
                <input type="phone" id="user-phone" class="form-control" placeholder="Infome seu celular com DDD" required autofocus="">
                <input type="password" id="user-pass" class="form-control" placeholder="Senha" required autofocus="">
                <input type="password" id="user-repeatpass" class="form-control" placeholder="repita a senha" required autofocus="">
                <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> Cadastrar</button>
                <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Voltar</a>
            </form>
            <br>
            
    </div>
    </div>
  </div>
</div>
<!--Busca content -->
<div class="modal fade" id="buscar" tabindex="-1" role="dialog" aria-labelledby="buscar" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buscaTitulo" style="display: none;">Informe o serviço que vocẽ procura</h5>
        <h5 class="modal-title" id="buscaTitulo">Obrigado por usar a ResolveU</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="procuraBox" style="display: none;">
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-10 col-form-label">Seu CEP</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="cep" placeholder="Seu Cep">
          </div>
        </div>
        <div class="form-group row">
          <label for="descrição" class="col-sm-10 col-form-label">Descreva o que você necessita</label>
          <div class="col-sm-10">
           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-5">
          <button class="btn btn-primary btn-block" type="submit">Enviar Solicitação</button>
        </div>
        </div>
      </div>
        <div class="alert alert-success" role="alert">
        <b> Sua solicitação foi enviada com sucesso! <br>  retornaremos em até 45 minutos com os prestadores de serviço.</b>
        </div>

      </div>
    </div>
  </div>
</div>
<!--Busca content End -->

<!-- Modal Registro e Login End-->

  <!-- ======= Header Destaque ======= -->
  <header id="header">
    <div class="container d-flex">

      <div class="logo mr-auto">
      <!--  <h1 class="text-light"><a href="index.html">ResolveU<br><span style="font-size:12px">Plataforma de serviços</span></a></h1>-->
      <img src="assets/img/resolveuwhite.png" class="img-fluid"/>
      </div>
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="#team">Como funciona ?</a></li>
         
          <li class="get-started"><a href="#features">Seja um parceiro </a></li>
          <li><a href="#about">Sobre</a></li>
          <li><a href="#contact">Contato</a></li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <!-- Destaque da pagina e busca-->
    <div class="container" style="display: block;">
      <div class="row d-flex align-items-center">
      <div class=" col-lg-6 py-5 py-lg-0 order-2 order-lg-1" data-aos="fade-right">
      <h3 style="color:white">
        Encontramos para você tudo que você precisa 
        para resolver o seu problema<br>
        em 5 etapas que não leva nem 3 minutos.</h3><br>
      <!--  <a href="#about" class="btn-get-started scrollto">Get Started</a>-->
      <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4">
        <div class="input-group">
          <!-- Busca-->
          <input type="search" id="buscaServico" placeholder="Encontre aqui o que você procura ?" aria-describedby="button-addon1" class="form-control border-0 bg-light form-control-style">

          <datalist id="buscaServico">
            <option v-for="servico of servicos" value="{{servico.id}}"></option>
          </datalist>

          <div class="input-group-append">
            <!-- Ação do btn #loginModal |  -->
            <button id="button-addon1" type="submit" data-toggle="modal" data-target="#buscar" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </div>

      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left">
        <img src="assets/img/hero-img.png" class="img-fluid" alt="">
      </div>
    </div>
    </div>
    <!-- Destaque da pagina e busca End-->

  </section><!-- End Pagina Inicial -->

  <main id="main">
<!-- Mostra Perfil Prestador -->   
    <section id="cardprofile">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-6" style="margin-bottom: 30px;" v-for="prestador of prestadores">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-8 col-md-6">
                                <h3 class="mb-0 text-truncated">{{prestador.nome}}</h3>
                                <p class="lead">Sapateiro(a)</p>
                                <p>
                                   Faço serviços em geral
                                </p>
                                <p> <span class="badge badge-info tags">Sapataria</span> 
                                    <span class="badge badge-info tags">Costura</span>
                                    <span class="badge badge-info tags">Pintura</span>
                                </p>

                               <p>Meu contato: {{prestador.fone}} 
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 text-center">
                                <img src="https://robohash.org/68.186.255.198.png" alt="" class="mx-auto rounded-circle img-fluid">
                                <br>
                                <ul class="list-inline ratings text-center" title="Ratings">
                                    <li class="list-inline-item"><a href="#"><span class="fa fa-star"></span></a>
                                    </li>
                                    <li class="list-inline-item"><a href="#"><span class="fa fa-star"></span></a>
                                    </li>
                                    <li class="list-inline-item"><a href="#"><span class="fa fa-star"></span></a>
                                    </li>
                                    <li class="list-inline-item"><a href="#"><span class="fa fa-star"></span></a>
                                    </li>
                                    <li class="list-inline-item"><a href="#"><span class="fa fa-star"></span></a>
                                    </li>
                                </ul>
                          
                            </div>
                            <div class="col-12 col-lg-4">
                                <h3 class="mb-0">15</h3>
                                <small>Serviços contratados</small>
                          
                                <button class="btn btn-block btn-outline-success"><span class="fas fa-map-marker-alt"></span> Ver no mapa</button>
                            </div>
                            <div class="col-12 col-lg-4">
                                <h3 class="mb-0">10</h3>
                                <small>Recomendam</small>
                               <!-- <button class="btn btn-outline-info btn-block"><span class="fa fa-user"></span> Ver perfil</button>-->
                            </div>
                            <div class="col-12 col-lg-4">
                                <h3 class="mb-0">3</h3>
                                <small>Não recomendam</small>
                              
                            </div>
                            <!--/col-->
                        </div>
                        <!--/row-->
                    </div>
                    <!--/card-block-->
                </div>
            </div>
        </div>
        
      </div>
    </section>
<!-- Mostra Perfil Prestador End-->
	
    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container">

        <div class="row">
          <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start"></div>
          <div class="col-xl-7 pl-0 pl-lg-5 pr-lg-1 d-flex align-items-stretch">
            <div class="content d-flex flex-column justify-content-center">
              <h3 data-aos="fade-in" data-aos-delay="100">ResolveU uma plataforma fácil</h3>
              <p data-aos="fade-in">
                A ResolveU é uma plataforma <b>gratuita</b> de busca de serviços dedicada a facilitar a busca de serviços proximos a você
              </p>
              <div class="row">
                <div class="col-md-6 icon-box" data-aos="fade-up">
                  <i class="bx bx-receipt"></i>
                  <h4><a href="#">Orçamentos a 1 toque</a></h4>
                  <p>Encontramos para você orçamentos de forma inteligente.</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                  <i class="bx bx-cube-alt"></i>
                  <h4><a href="#">Listamos as melhores opções para você</a></h4>
                  <p>Através do nosso sistema encontraremos os melhores progissionais mais proximos de você</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                  <i class="bx bx-images"></i>
                  <h4><a href="#">Seja um parceiro</a></h4>
                  <p>Se você é profissional você encontra clientes de maneira rapida e pratica.</p>
                </div>
                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                  <i class="bx bx-shield"></i>
                  <h4><a href="#">Avalie os profissionais</a></h4>
                  <p>Após serviço feito avalie o profissional.</p>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section>
    <!-- ======= Features Section ======= -->
    <section id="features" class="features section-bg">
      <div class="container">

        <div class="section-title">
          <h2 data-aos="fade-in">Seja um parceiro</h2>
          <p data-aos="fade-in">Com a ResolveU seus clientes te encontrarão com maior facilidade</p>
        </div>

        <div class="row content">
          <div class="col-md-5" data-aos="fade-right">
            <img src="assets/img/features-1.svg" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 pt-4" data-aos="fade-left">
            <h3>Você poderá apresentar seus serviços para milhares de clientes a 1 toque de distancia.</h3>
            <p class="font-italic">
              Quais as vantegens ?
            </p>
            <ul>
              <li><i class="icofont-check"></i> Recebera solicitações de orçamentos direto no seu celular.</li>
              <li><i class="icofont-check"></i> Você terá seu cartao de visita virtual.</li>
              <li><i class="icofont-check"></i> Maior visibilidade.</li>
              <li><i class="icofont-check"></i> Orçamentos totalmente online e rapidos.</li>
            </ul>
          </div>
        </div>

        <div class="row content">
          <div class="col-md-5 order-1 order-md-2" data-aos="fade-left">
            <img src="assets/img/features-4.svg" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 pt-5 order-2 order-md-1" data-aos="fade-right">
            <h3>Orçamentos em qualquer lugar!</h3>
            <p class="font-italic">
              Use nossa plataforma em qualquer lugar, nosso serviço foi projetado para melhor atender clientes e prestadores de serviços de forma ágil.
            </p>
            <p>

            </p>
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing section-bg">
      <div class="container">

        <div class="section-title">
          <h2 data-aos="fade-in">Seja um parceiro Premium</h2>
          <p data-aos="fade-in">.</p>
        </div>

        <div class="row no-gutters">

          <div class="col-lg-4 box" data-aos="zoom-in">
            <h3>Grátis</h3>
            <h4>R$ 0.00<span>Por mês</span></h4>
            <ul>
              <li><i class="bx bx-check"></i> Receba orçamentos</li>
              <li><i class="bx bx-check"></i> Cartão de visita virtual</li>
              <li><i class="bx bx-check"></i> Receba pedidos no celular</li>
              <li class="na"><i class="bx bx-x"></i> <span>Visibilidade premium na busca </span></li>
          
            </ul>
            <a href="#" class="get-started-btn">Começar agora</a>
          </div>

          <div class="col-lg-4 box featured" data-aos="zoom-in">
            <span class="featured-badge">Promoção</span>
            <h3>Plano Silver</h3>
            <h4>R$ 5,00<span>Por mês</span></h4>
            <ul>
              <li><i class="bx bx-check"></i> alguma coisa</li>

            </ul>
            <a href="#" class="get-started-btn">Começar agora</a>
          </div>

          <div class="col-lg-4 box" data-aos="zoom-in">
            <h3>Plano Gold</h3>
            <h4>R$ 15,00<span>Por mês</span></h4>
            <ul>
              <li><i class="bx bx-check"></i> alguma coisa</li>

            </ul>
            <a href="#" class="get-started-btn">Começar agora</a>
          </div>

        </div>

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title">
          <h2 data-aos="fade-in">Fale conosco</h2>
          <p data-aos="fade-in"> Caso queira solicitar ajuda ou suporte entre em contato por aqui.</p>
        </div>

        <div class="row">

          <div class="col-lg-6">

            <div class="row">
              <div class="col-md-12">
                <div class="info-box" data-aos="fade-up">
                  <i class="bx bx-map"></i>
                  <h3>Nosso endereço</h3>
                  <p>Rua Praia de belas, Prédio Prime Offices Numero 4888 6ª Andar sala 15</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4" data-aos="fade-up" data-aos-delay="100">
                  <i class="bx bx-envelope"></i>
                  <h3>Nosso Email</h3>
                  <p>atendimento@resolveu.com.br<br></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4" data-aos="fade-up" data-aos-delay="100">
                  <i class="bx bx-phone-call"></i>
                  <h3>Telefones</h3>
                  <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form" data-aos="fade-up">
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Seu nome" data-rule="minlen:4" data-msg="Numero minimo de caracteres é 4" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Seu E-mail" data-rule="email" data-msg="Por favor informe um E-mail válido" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto" data-rule="minlen:4" data-msg="Informe no minimo 8 caracteres." />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Escreve sua mensagem aqui" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Carregando</div>
                <div class="error-message"></div>
                <div class="sent-message">Sua mensagem foi enviada com sucesso!</div>
              </div>
              <div class="text-center"><button type="submit">Enviar mensagem</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">



    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>ResolveU</span></strong>. Todos direitos reservados 2020 - Consunte os <u><b>termos de uso</b></u>
      </div>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade Modificado por Lucas Soares</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script type="text/javascript">
  function toggleResetPswd(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle() // display:block or none
    $('#logreg-forms .form-reset').toggle() // display:block or none
}

function toggleSignUp(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle(); // display:block or none
    $('#logreg-forms .form-signup').toggle(); // display:block or none
}

$(()=>{
    // Login Register Form
    $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
    $('#logreg-forms #cancel_reset').click(toggleResetPswd);
    $('#logreg-forms #btn-signup').click(toggleSignUp);
    $('#logreg-forms #cancel_signup').click(toggleSignUp);
});
  </script>

  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  
  <script src="vue/prestadores.js"></script>
  <script src="vue/app.js"></script>

</body>

</html>