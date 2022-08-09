<?php
	$id = $par[1];
	$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.empreendimentos` WHERE id = ?");
	$sql->execute(array($id));

	$infoEmpreend = $sql->fetch();

	if($infoEmpreend['nome'] == ''){
		header('Location: '.INCLUDE_PATH_PAINEL);
	}

?>

<div class="box-content w100">
	<h2 class="titulo-topo"><i class="fa-solid fa-warehouse"></i> Empreendimento: <?php echo $infoEmpreend['nome'] ?></h2>
	<div class="info-item">
		<div class="row1">
			<div style="background: #fa8564;" class="card-title">Imagem:</div>
			<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $infoEmpreend['imagem'] ?>">
		</div>

		<div class="row2">
			<div style="background: #fa8564;" class="card-title">Informação:</div>
			<p><b><i class="fa fa-pencil"></i> Nome:</b> <?php echo $infoEmpreend['nome'] ?></p>
			<p><b><i class="fa-solid fa-bars"></i> Tipo:</b> <?php echo ucfirst($infoEmpreend['tipo']) ?></p>
		</div>

	<div class="clear"></div>
	</div>

	

	<div style="background: #fa8564;" class="card-title">Cadastrar Imóvel:</div>

	<form method="post" enctype="multipart/form-data">
		<?php
		if(isset($_POST['acao'])){
			$empreendId = $id;
			$nome = $_POST['nome'];
			$preco = $_POST['preco'];
			$area = $_POST['area'];

			$imagens = array();
			$amountFiles = count($_FILES['imagens']['name']);

			$sucesso = true;

			if($_FILES['imagens']['name'][0] != ''){

			for($i =0; $i < $amountFiles; $i++){
				$imagemAtual = ['type'=>$_FILES['imagens']['type'][$i],
				'size'=>$_FILES['imagens']['size'][$i]];
				if(Painel::imagemValida($imagemAtual) == false){
					$sucesso = false;
					Painel::alert('erro','Uma das imagens selecionadas são inválidas.');
					break;
				}
			}

			}else{
				$sucesso = false;
				Painel::alert('erro','Você precisa selecionar pelo menos uma imagem.');
			}


			if($sucesso){
				for($i =0; $i < $amountFiles; $i++){
					$imagemAtual = ['tmp_name'=>$_FILES['imagens']['tmp_name'][$i],
						'name'=>$_FILES['imagens']['name'][$i]];
					$imagens[] = Painel::uploadFile($imagemAtual);
				}

				$sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.imoveis` VALUES (null,?,?,?,?,0)");
				$sql->execute(array($empreendId,$nome,$preco,$area));
				$lastId = MySql::conectar()->lastInsertId();
				foreach ($imagens as $key => $value) {
					MySql::conectar()->exec("INSERT INTO `tb_admin.imagens_imoveis` VALUES (null,$lastId,'$value')");
				}
				Painel::alert('sucesso','O imóvel foi cadastrado com sucesso.');
			}
		}

	?>
		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome">
		</div><!--form-group-->
		<div class="form-group">
			<label>Área:</label>
			<input type="number" name="area" min="0" max="2000" step="100" value="0">
		</div><!--form-group-->
		<div class="form-group">
			<label>Preco:</label>
			<input type="text" name="preco">
		</div><!--form-group-->
		<div class="form-group">
			<label>Selecione as Imagens:</label>
			<input type="file" multiple name="imagens[]">
		</div><!--form-group-->
		<div class="form-group">
			<input type="submit" name="acao" value="Adicionar">
		</div><!--form-group-->
	</form>

	<div style="background: #fa8564;" class="card-title">Imóveis do Empreendimento:</div>
	<div class="wraper-table">
		<table>
			<tr style="background:#9972b5;">
				<td>Nome</td>
				<td>Preço</td>
				<td>Área</td>
				<td></td>
			</tr>

			
			<?php
			$pegaImoveis = Painel::selectQuery('tb_admin.imoveis','empreend_id=?',array($id));
			foreach($pegaImoveis as $key=>$value){
			?>
			<tr>
				<td><?php echo $value['nome']; ?></td>
				<td>R$<?php echo $value['preco']; ?></td>
				<td><?php echo $value['area']; ?>m²</td>
				<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-imovel?id=<?php echo $value['id']; ?>"><i class="fa fa-eye"></i> Visualizar</a></td>
			</tr>
			<?php } ?>
			

		</table>
	</div>
</div>