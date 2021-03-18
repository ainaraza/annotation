<!DOCTYPE html>
<html>
<head>
	<title>Annotation</title>

	<link rel="stylesheet" type="text/css" href="/materialize/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="/materialize/css/materialize-font.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
	     
	<div class="container" id="app-annotation">
		<div class="row">
			<div class="col s6 m6">
				<input id="username" type="text" class="validate" placeholder="Enter your name" v-model="add_user">
				<button class="btn" v-on:click="addUser()">Add</button>
			</div>
			<div class="col s12 m12">
				<div class="input-field col s6 m6">
				    <select v-model="selected_user">
				    	<option value="" disabled>Choose your name</option>
				    	<option v-for="user in users" value="{{ user.id }}">{{ user.name }}</option>
				    </select>
				 </div>
			</div>
		</div>
		<div class="row" v-if="selected_user">
			<div class="col s12 m12">
				<div class="card">
					<div class="card-content">
						<p>{{ tweet.tweet }}</p>
					</div>
					<div class="card-action center">
						<label class="btn white black-text">
							<input type="radio" class="white" name="is_psi" value="true" v-model="is_psi">
							<span class="black-text">PSI <i class="large material-icons">done</i></span>
						</label>

						<label class="btn white black-text">
							<input type="radio" class="white" name="is_psi" value="false" v-model="is_psi">
							<span class="black-text">NOT PSI <i class="large material-icons">clear</i></span>
						</label>
					</div>
					<div class="card-action center psi_types">
					  	<?php foreach($psiTypes as $type): ?>
					  		<label class="btn blue black-text">
						        <input type="checkbox" class="white" v-on:click="select(<?= $type['id']; ?>)"/>
						        <span class="black-text"><?= $type['libelle']; ?></span>
						    </label>
					  	<?php endforeach; ?>
					</div>
					<div class="card-action center">
						<button class="btn green" v-on:click="annotate()">Valider</button>
					</div>
				</div>
			</div>
		</div>
		
	</div>

	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/materialize/js/materialize.min.js"></script>
	<script type="text/javascript" src="/vuejs/vue.js"></script>
	<script type="text/javascript" src="/vuejs/axios.js"></script>

	<script type="text/javascript" src="/js/script.js"></script>
	<script type="text/javascript">
		var base_url = "<?= base_url(); ?>";
	</script>
	<script type="text/javascript" src="/js/vueapp.js"></script>
</body>
</html>