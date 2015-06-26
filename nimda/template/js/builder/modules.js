var	textModule = {
	addSaveListener:function(e){
		// console.log("-------------------------------");
		// 	console.log("selected box data");
		// 	console.info(activeSection.getAttribute('data-content'));

		document.getElementsByClassName('trumbowyg-textarea')[0].value = "<p><br></p>";
		document.getElementById('wysiwyg').innerHTML = "";

		if(activeSection.getAttribute('data-content') != "null" && activeSection.getAttribute('data-content') != "null"){
			document.getElementsByClassName('trumbowyg-textarea')[0].value = activeSection.getAttribute('data-content');
			document.getElementById('wysiwyg').innerHTML = activeSection.getAttribute('data-content');
		}

		document.getElementById('save-tx-md').addEventListener('click',function(){

			var data = e.getAttribute('data');
			var module  = data;
			var content = document.getElementsByClassName('trumbowyg-textarea')[0].value;

			activeSection.setAttribute('data-module', module);
			activeSection.setAttribute('data-content', content.replace(/"/g,'\"'));
			activeSection.innerHTML = module;

			document.getElementsByClassName('overlay')[0].style.display = "none";
			document.getElementsByClassName('content-list')[0].style.display = "none";
			document.getElementsByClassName('text-module')[0].style.display = "none";
		});
		document.getElementById('clear-tx-md').addEventListener('click',function(){
			
			activeSection.setAttribute('data-content', "");
			document.getElementsByClassName('trumbowyg-textarea')[0].value = "<p><br></p>";
			document.getElementById('wysiwyg').innerHTML = "";
		});
		// console.log("-------------------------------");
	},
};

var	formModule = {
	addSaveListener:function(e){
		// console.log("-------------------------------");
		// 	console.log("selected box data");
		// 	console.info(activeSection.getAttribute('data-content'));

		}
};