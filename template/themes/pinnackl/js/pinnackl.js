(function(e){
	var burger = document.getElementById('burger');
	var menu = document.getElementById('menu');
	burger.addEventListener('click', function(){
		menu.classList.toggle("visible");
	});
})(document);

/**
 * Handle on the fly error and display the error box and prevent from submiting
 * @type {Object}
 */
var forms = document.querySelectorAll('form');
[].forEach.call(forms, function(form){
	var post = {};
	var action = form.action;
	var inputs = form.getElementsByTagName("input");
	var error = form.getElementsByClassName("error");
	for (var i = inputs.length - 1; i >= 0; i--) {
		post[inputs[i].name] = "";
	};
	[].forEach.call(inputs, function(input){
		input.addEventListener('change', function(){
			post[input.name] = input.value;
			AJAX(post, function(data){
				if(data.length > 0){
					form.addEventListener('submit', function(e){
						e.preventDefault();
					});
					error[0].innerHTML = '';
					error[0].classList.remove('unvisible');
					for (var i = data.length - 1; i >= 0; i--) {
						error[0].innerHTML += '<p>'+data[i]+'</p>';
					};
				}
				else{
					error[0].classList.add('unvisible');
					form.addEventListener('submit', function(e){
						this.submit();
					});
				}
			}, action);
		}, false);
	})
});

/**
 * For SEO get the link only on indexable text and use js to get the href on the card
 * @type {Object}
 */
var articles = document.querySelectorAll('.articles');
[].forEach.call(articles, function(article){
	// Too tired to do it without JQuery - I'm sad !!!
	var $links = $(article).find('.articleLink');
	var link = $links[0].getAttribute('href');
	article.addEventListener('click', function(){
		window.location = link;
	});
});

function AJAX(data, callback, URL, type){
	callback = (typeof callback === "undefined") ? function(){} : callback;
	URL = (typeof URL === "undefined") ? window.location.href : URL;
	type = (typeof type === "undefined") ? "json" : type;
	$.ajax({
		type: "POST",
		url: URL,
		data: data,
		success: function(data){callback(data)}, 
		dataType: type
	});
}
document.addEventListener("DOMContentLoaded", function() {
	$('#wysiwyg').trumbowyg({
        btns: ['viewHTML',
            '|', 'btnGrp-design',
            '|', 'link',
            '|', 'btnGrp-justify',
            '|', 'btnGrp-lists',
            '|', 'foreColor', 'backColor']
    });
});