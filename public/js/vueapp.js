var app = new Vue({
	el: '#app-annotation',
	data: {
		tweet: {},
		types: Array(12).fill(false),
		is_psi: false,
		add_user: "",
		users: [],
		selected_user: "",
	},
	created: function(){

	},
	mounted: function(){
		this.getTweet();
		this.reloadUsers();
	},
	updated: function(){
		var elems = document.querySelectorAll('select');
		var instances = M.FormSelect.init(elems, {});
	},
	methods: {
		select: function(id){
			id--;
			this.types[id] = !this.types[id];
			console.log(this.types);
		},
		getTweet: function(){
			console.log(base_url);
			axios.get(base_url + "/ajax/getTweet")
			     .then(response => {
			     	this.tweet = response.data;
			     });
		},
		annotate: function(){
			
			var data = {
				'types': [...this.types.keys()].filter(x => this.types[x]).map(t => t+1),
				'psi': this.is_psi
			};

			axios.post(base_url + "/ajax/annotateTweet/" + this.tweet.id, data)
			     .then(response => {
			     	this.getTweet();
			     	this.clear();
			     });
		},
		clear: function(){
			this.is_psi = false;
			this.types = Array(12).fill(false);
			$(".psi_types input[type='checkbox']").removeAttr("checked");
		},
		addUser: function(){
			axios.post(base_url + "/ajax/addUser", {'user': this.add_user})
				 .then(response => {
				 	this.add_user = "",
				 	this.reloadUsers();
				 });
		},
		reloadUsers: function(){
			axios.get(base_url + "/ajax/getUsers")
			     .then(response => {
			     	this.users = response.data;
			     });

			this.selected_user = "";
			
			var elems = document.querySelectorAll('select');
			var instances = M.FormSelect.init(elems, {});
		}
	}
});