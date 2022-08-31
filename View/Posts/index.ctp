
	<link rel="stylesheet" href=https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css> <link rel="stylesheet"
	href=https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js> <link rel="stylesheet"
	href=https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js> <link rel="stylesheet"
	href=https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<Html>	
<script>
	document.addEventListener("DOMContentLoaded", function (event) {

		const showNavbar = (toggleId, navId, bodyId, headerId) => {
			const toggle = document.getElementById(toggleId),
				nav = document.getElementById(navId),
				bodypd = document.getElementById(bodyId),
				headerpd = document.getElementById(headerId)

			if (toggle && nav && bodypd && headerpd) {
				toggle.addEventListener('click', () => {
					// show navbar
					nav.classList.toggle('show')
					// change icon
					toggle.classList.toggle('bx-x')
					// add padding to body
					bodypd.classList.toggle('body-pd')
					// add padding to header
					headerpd.classList.toggle('body-pd')
				})
			}
		}

		showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

		/*===== LINK ACTIVE =====*/
		const linkColor = document.querySelectorAll('.nav_link')

		function colorLink() {
			if (linkColor) {
				linkColor.forEach(l => l.classList.remove('active'))
				this.classList.add('active')
			}
		}
		linkColor.forEach(l => l.addEventListener('click', colorLink))
	});

</script>


<!-- sessoes -->
<?php
 $usuario=$this->Session->read('username');
$user_id=$this->Session->read('user_id');
$role=$this->Session->read('role');

?>
<!--  -->

<body id="body-pd">

	<header class="header" id="header">

		<div class="header_toggle"> </div>
		<p>Bem Vindo <strong><?php echo $usuario;
?></strong> ! ! Hoje é: <?php echo date('d/m/Y');
?><p>

				<div class="header_img"> <i class="bi bi-person-circle"></i> </div>
	</header>

	<!-- barra lateral -->
	<div class="l-navbar" id="nav-bar">
		<nav class="nav">

			<div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
						class="nav_logo-name">MEU BLOG</span> </a>
				<div class="nav_list">
					<a href="/posts" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i><span
							class="nav_name">Posts</span> </a>
					

					<?php if(isset($_SESSION['user_id'])){ ?> 
						<a href="/posts/add" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i>
							<span class="nav_name">Novo Post</span> </a> 
						<a href="users/logout" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> 
						<span class="nav_name">Sair</span> </a>
						
							<?php }else{ ?>
								<a href="users/login" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> 
						<span class="nav_name">Entrar</span> </a> <?php } ?>
						

				</div>
		</nav>
	</div>
<!-- Fim da barra lateral -->

	<!--inicio do container-->
	



		<section>
			<form method="POST">
				<!-- <?php 

// filtro
  $dados=$this->Session->read('busca');
  $datainicio=$this->Session->read('datainicio');
  $datafim=$this->Session->read('datafim');
  if(isset($this->request->data['busca'])){
	 
	  $busca = $_POST['busca'];}?> -->
				<div class="cima">
					<div class="col"><input type="search" placeholder="Buscar por Titulo " name="busca"
							class="form-control" value="<?php echo $dados; ?>"> </div>
					<div class="col"><input name="datainicio" type='date' class="form-control"
							value="<?php echo $datainicio; ?>"></div>
					<div class="col"><input name="datafim" type='date' class="form-control"
							value="<?php echo $datafim; ?>"></div>
					<div class="col  "><input class="btn btn-primary" type="submit" value="Buscar"></div>
				</div>
			</form>
		</section>

		<?php if(isset($_SESSION['user_id'])){ ?> 
  
 <?php } else {?> <div class="alert alert-primary" role="alert">
Faça login para editar e criar posts</div> <?php } ?>
		<table>


			<h4><strong>Todos os Posts</strong></h4>

			<?php foreach ($posts as $post):?>
			<tr>

				<td colspan="1">

					<p>
						<a class="btn primary" data-bs-toggle="collapse"
							href="#collapseExample<?php echo $post[0]['id'] ?>" role="button" aria-expanded="false"
							aria-controls="collapseExample"><?php echo $post[0]['title'] ?>
						</a>

						<div class="actions">

							
							<?php if($role === 'admin' || $user_id==$post[0]['user_id']) {?>


							<?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $post[0]['id']),
                array('confirm' => 'Deseja realmente excluir ?'), 
			
				
            )?>
							<a href="/posts/edit/<?php echo $post[0]['id']?>">Edite</a> 
							<?php }?>
						</div>
					</p>


					<div class="collapse" id="collapseExample<?php echo $post[0]['id'] ?>">
						<div class="card card-body"><?php echo $post[0]['body'] ?></div>
					</div>

				</td>



			</tr>
			<?php endforeach;?>
		</table>

	
	<!--Fim do container-->




</body>

</Html>
