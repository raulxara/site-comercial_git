<?php include('config.php'); ?>
<?php Site::updateUsuarioOnline(); ?>
<?php Site::contador(); ?>
<?php 
	$infoSite = MySql::conectar()->prepare("SELECT * FROM `tb_site.config`");
	$infoSite->execute();
	$infoSite = $infoSite->fetch();
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $infoSite['titulo']; ?></title>
	<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>fonts-6/css/all.css">
	<link href="<?php echo INCLUDE_PATH; ?>css3/style.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="Keywords" content="autopeças, injeçao de carro, suspensão de carro, manutenção de carro, loja de peças de carro">
	<meta name="description" content="Varejo e atacado de peças de injeção e suspensão automotiva">
	<meta charset="utf-8">
	<meta name="author" content="Raul Nascimento Cruz">
	<link rel="icon" href="<?php echo INCLUDE_PATH; ?>favicon.ico" type="image/x-icon" />
</head>
<body>

	<?php 
		$url = isset($_GET['url']) ? $_GET['url'] : 'home';

		switch ($url) {
			case 'sobre':
				echo '<target target="sobre" />';
				break;

			case 'servicos':
				echo '<target target="servicos" />';
				break;
		}
	?>

<header>
	<div class="center">
		<div class="logo left"><a href="<?php echo INCLUDE_PATH; ?>">PiPlug</a></div>
		<nav class="desktop right">
			<ul>
				<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
				<li><a href="<?php echo INCLUDE_PATH; ?>sobre">Sobre</a></li>
				<li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
				<li><a href="<?php echo INCLUDE_PATH; ?>noticias">Notícias</a></li>
				<li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
			</ul>
		</nav>
		<nav class="mobile right">
			<div clas="botao-menu-mobile">
				<i class="fa fa-bars" aria-hidden="true"></i>
			</div>
			<ul>
				<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
				<li><a href="<?php echo INCLUDE_PATH; ?>sobre">Sobre</a></li>
				<li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
				<li><a href="<?php echo INCLUDE_PATH; ?>noticias">Notícias</a></li>
				<li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
			</ul>
		</nav>
	</div>
	<div class="clear"></div>
</header>

<div class="container-principal">

<?php

		if(file_exists('pages/'.$url.'.php')){
			include('pages/'.$url.'.php');
		}else{
			if($url != 'sobre' && $url != 'servicos'){
				$urlPar = explode('/',$url)[0];
				if($urlPar != 'noticias'){
				$pagina404 = true;
				include('pages/404.php');
				}else{
					include('pages/noticias.php');
				}
			}else{
				include('pages/home.php');
			}
		}

	?>

</div>

<footer>
	<div class="center">
		<p>Todos os direitos reservados</p>
	</div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/scriptss.js"></script>
<script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>

<?php

		if(is_array($url) && strstr($url[0],'noticias') !== false){
	?>
		<script>
			$(function(){
				$('select').change(function(){
					location.href="noticias/"+$(this).val();
				})
			})
		</script>
	<?php
		}
	?>

<?php 
	if($url == 'contato') {
?>
<script src='https://maps.googleapis.com/maps/api/js?v3.exp&key=AIzaSyDm9yEt_IERYGYvZLBGgOdHQNtQHCpXy4w'></script>
<script src="<?php echo INCLUDE_PATH; ?>js/map.js"></script>
<?php } ?>
<script src="<?php echo INCLUDE_PATH; ?>js/exemplo.js"></script>
</body>
</html>
