

<nav class="navbar navbar-default" role="navigation">
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			<li <?= ($controller === 'produtos')? 'class="active"' : '' ?> ><a href="<?= $admLocal ?>Produtos">Produtos</a></li>
			<li <?= ($controller === 'assinantes')? 'class="active"' : '' ?>><a href="<?= $admLocal ?>Assinantes">Assinantes</a></li>
			<li><a href="<?= $admLocal ?>Users/logout">Sair Do Painel</a></li>
		</ul><!-- /.nav navbar-nav -->
	</div><!-- /.navbar-collapse -->
</nav><!-- /.navbar navbar-default -->