

<nav class="navbar navbar-default" role="navigation">
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			<li <?= ($controller === 'users')? 'class="active"' : '' ?> ><a href="<?= $admLocal ?>Users">Usuario</a></li>
			<li <?= ($controller === 'files')? 'class="active"' : '' ?>><a href="<?= $admLocal ?>Files/">Trabalhos</a></li>
			<li><a href="<?= $admLocal ?>Users/logout">Sair Do Painel</a></li>
		</ul><!-- /.nav navbar-nav -->
	</div><!-- /.navbar-collapse -->
</nav><!-- /.navbar navbar-default -->