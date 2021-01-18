<?php
	$ger_nome = "Página Inicial";
	$ger_slug = "pagina-inicial";
	$ger_arquivo = "ger-perfil.php";

	include_once("funcoes.php");
	logged();
	include_once("cabecalho.php");		

?>
	<section id="home">
		<div class="row">
	        <div class="span12">
				<div class='well'>
		            <ul id="myTab" class="nav nav-tabs" style='margin:0px; '>
		            	<?php
						$sql = "SELECT estrut_id, estrut_descricao FROM estruturante order by estrut_id asc ";
						$rs_estruturante = $_SESSION['db']->GetAll($sql);
						foreach ($rs_estruturante as $key => $row) { ?>
							<li <?=(($key == 1) ? 'class="active"' : '')?> >
								<a href="#item_<?=$row['estrut_id']?>" rel='<?=$row['estrut_id']?>' data-toggle="tab" style='outline: none !important;'><b><?=$row['estrut_descricao']?></b></a>
							</li>
		              	<?php } ?>
		            </ul>

					<script>
				    	$('#myTab li a').bind('click', function (e) {

				    		$('#myTabContent')
				    			.load('ger-estruturante-ajax.php?estrut=' + $(this).attr('rel') )
				    			.addClass('active')
				    			.addClass('in')
				    			.addClass('collapse')
				    			.collapse('show');

				    	})
				    	$(document).ready(function(){
				    		$('#myTabContent').load('ger-estruturante-ajax.php?estrut=1' )
				    		.addClass('active')
				    		.addClass('in')
				    		.addClass('collapse');
				    		$("#myTabContent").collapse('show');

				    	});


					</script>

		            <div id="myTabContent" class="tab-content" style='background-color: #ffffff; padding:10px; border-left:1px solid #dfdfdf; border-right:1px solid #dfdfdf; border-bottom:1px solid #dfdfdf;'></div>
				</div>
			</div>
		</div>
	</section>
<?php include_once "rodape.php"; ?>