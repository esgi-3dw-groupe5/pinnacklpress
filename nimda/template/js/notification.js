function Notification(){
}

Notification.notify = function(notifiBox, callback, overlay){
	callback = (typeof callback === "undefined") ? function(box){} : callback;
	overlay = (typeof overlay === "undefined") ? false : overlay;
	var box = Sophwork(notifiBox);
	box.style.display = 'block';
	callback(box);
}

Notification.close = function(box, timeout){
	(typeof timeout === "undefined")
		? setTimeout(function(){box.style.display = 'none';}, 0)
		: setTimeout(function(){box.style.display = 'none';}, timeout);
}

Sophwork.ready(function(){
	if(window.location.hash == '#updated')
		Notification.notify('#updated', function(box){
			var close = Sophwork('.close-notification');
			var text = Sophwork('.text-notification');
			text[0].innerHTML = "&#10004; Your modifications have been saved";
			close[0].addEventListener('click', function(){
				Notification.close(box);
			});
			Notification.close(box, 20000);
		});
});