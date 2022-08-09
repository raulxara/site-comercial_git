<?php
	$url = explode('/',$_GET['url']);
	

	$verifica_categoria = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE slug = ?");
	$verifica_categoria->execute(array($url[1]));
	if($verifica_categoria->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'noticias');
	}
	$categoria_info = $verifica_categoria->fetch();

	$post = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE slug = ? AND categoria_id = ?");
	$post->execute(array($url[2],$categoria_info['id']));
	if($post->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'noticias');
	}
	$post = $post->fetch();

?>
<section class="noticia-single">
	<div class="center">
		<article>
			<h1><?php echo $post['titulo'] ?></h1>
			<p><?php echo $post['conteudo']; ?></p>
		</article>
		<?php 
			if(Painel::logado() == false){
			//echo "você não pode comentar";

		?>
			<div class="container-erro-login">
				<p style="font-size: 17px; color: white; padding: 10px;"><i class="fa-solid fa-triangle-exclamation"></i> Você precisa estar logado para comentar, clique <a href="<?php echo INCLUDE_PATH ?>painel">aqui</a> para efeturar login.</p>
			</div>
		<?php
			}else{?>
				<?php  
					if(isset($_POST['postar_comentario'])){
					$nome = $_POST['nome'];
					$comentario = $_POST['mensagem'];
					$noticia_id = $_POST['noticia_id'];

					$sql = MySql::conectar()->prepare("INSERT INTO `tb_site.comentarios` VALUES (null,?,?,?)");
					$sql->execute(array($nome,$comentario,$noticia_id));

					}
				?>
				<h2 class="postar-comentario">Deixe seu cometário <i class="fa-solid fa-comments"></i></h2>
			<form method="post">
				<input type="text" name="nome" value="<?php echo $_SESSION['nome']; ?>">
				<textarea name="mensagem" placeholder="Seu comentário..."></textarea>
				<input type="hidden" name="noticia_id" value="<?php echo $post['id']; ?>">
				<input type="submit" name="postar_comentario" value="Adicionar">
			</form>

			<h2 class="postar-comentario">Cometários <i class="fa-solid fa-comments"></i></h2>
			<?php 
				$comentarios = MySql::conectar()->prepare("SELECT * FROM `tb_site.comentarios` WHERE noticia_id = ?");
				$comentarios->execute(array($post['id']));
				$comentarios = $comentarios->fetchAll();

				foreach ($comentarios as $key => $value) {
				
			?>
			<div class="box-coment-noticia">
				<h3><?php echo $value['nome']; ?></h3>
				<p style="font-size: 15px; font-weight: 600; padding-left: 13px;"><?php echo $value['comentario']; ?></p>
			</div>
			<?php } ?>
		<?php } ?>

	<div class="clear"></div>
	</div>
</section>