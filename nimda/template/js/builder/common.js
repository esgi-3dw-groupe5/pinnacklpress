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

function loadNodesBuilder(){
    nodes = document.querySelectorAll('.onoffswitch-checkbox');
    [].forEach.call(nodes, function(node){console.log(node);
        selectedNode = node;
        node.id;
        selectedNode.addEventListener('change',changeHandler,false);
    });
} 

var StatusBuilder = function(id, status){
    this.id = id;
    this.status = status;
}  
function changeHandler(){

    var id = this.id;
    var data = [];
    var save = {'statusBuilder':[]};
   if(this.checked){
      var status = 1;
      var commentNode = new StatusBuilder(id, status);
   }
   else{
      var status = 0;
      var commentNode = new StatusBuilder(id, status);
   }
      save.statusBuilder.push(commentNode);  
      AJAX(save, function(data){
        if(data == '#updated'){
            Notification.notify('#updated', function(box){
                var close = Sophwork('.close-notification');
                var text = Sophwork('.text-notification');
                text[0].innerHTML = "&#10004; Your modifications have been saved";
                close[0].addEventListener('click', function(){
                    Notification.close(box);
                });
                Notification.close(box, 20000);
            });
        }
    }, Sophwork.getUrl('nimda/options.php'), 'text');
} 

