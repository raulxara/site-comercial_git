<section class="banner-container">
	<div style="background-image: url('<?php echo INCLUDE_PATH; ?>images/slide01.jpg');" class="banner-single"></div>
	<div style="background-image: url('<?php echo INCLUDE_PATH; ?>images/slide02.jpg');" class="banner-single"></div>
	<div style="background-image: url('<?php echo INCLUDE_PATH; ?>images/slide03.jpg');" class="banner-single"></div>
	<div class="overlay"></div>
	<div class="center">
		<form>
			<h2>Para receber o catálogo completo dos produtos</h2>
			<h1>Deixe seu e-mail de contato:</h1>
			<input type="email" name="email" required/>
			<div></div>
			<input type="submit" name="acao" value="Cadastrar">
		</form>
	</div>
	<div class="bullets">
	</div>
</section>

<section class="descricao-empresa">
	<div class="center">
		<div id="sobre" class="w50 left">
			<h2><?php echo $infoSite['nome_autor']; ?></h2>
			<p><?php echo $infoSite['descricaop1']; ?></p>
			<p><?php echo $infoSite['descricaop2']; ?></p>
		</div>
		<div class="w50 right">
			<img src="<?php echo INCLUDE_PATH; ?>images/slide21.jpg" alt="slide21">
		</div>
		<div class="clear"></div>
	</div>
</section>

<section class="especialidades">
	<div class="center">
		<h2 class="title">Especialidades</h2>
		<div class="w33 left box-especialidade">
			<h3><i class="<?php echo $infoSite['icone1']; ?>"></i></h3>
			<h4>Suspensão</h4>
			<p><?php echo $infoSite['descricao1']; ?></p>
		</div>
		<div class="w33 left box-especialidade">
			<h3><i class="<?php echo $infoSite['icone2']; ?>"></i></h3>
			<h4>Injeção</h4>
			<p><?php echo $infoSite['descricao2']; ?></p>
		</div>
		<div class="w33 left box-especialidade">
			<h3><i class="<?php echo $infoSite['icone3']; ?>"></i></h3>
			<h4>Manutenção</h4>
			<p><?php echo $infoSite['descricao3']; ?></p>
		</div>
		<div class="clear"></div>
	</div>
</section>

<section class="extras">
	<div class="center">
		<div class="w50 left depoimentos-container">
			<h2 class="title">Depoimentos</h2>
			<?php  
				$sql = MySql::conectar()->prepare("SELECT * FROM `tb_site.depoimentos` ORDER BY order_id ASC LIMIT 3");
				$sql->execute();
				$depoimentos = $sql->fetchAll();
				foreach ($depoimentos as $key => $value) {
			?>
			<div class="depoimento-single">
				<p class="depoimento-descricao">"<?php echo $value['depoimento']; ?>"</p>
				<p class="nome-autor"><?php echo $value['nome']; ?> - <?php echo $value['data']; ?></p>
			</div>
			<<?php } ?>
		</div>
		<div id="servicos" class="w50 right servicos-container">
			<h2 class="title">Serviços</h2>
			<div class="servicos">
				<ul>
					<?php  
						$sql = MySql::conectar()->prepare("SELECT * FROM `tb_site.servicos` ORDER BY order_id ASC LIMIT 7");
						$sql->execute();
						$servicos = $sql->fetchAll();
						foreach ($servicos as $key => $value) {
					?>
					<li><?php echo $value['servico']; ?></li>
					<?php } ?>
				</ul>
				<img src="<?php echo INCLUDE_PATH; ?>images/selo-google.png" alt="selo-google">
			</div>
		</div>
	<div class="clear"></div>
	</div>
</section>