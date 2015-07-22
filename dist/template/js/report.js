Sophwork.ready(function(){
  loadNodesBuilder();
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

function loadNodesBuilder(){
    nodes = document.querySelectorAll('.report');
    [].forEach.call(nodes, function(node){console.log(node);
        selectedNode = node;
        node.id;
        selectedNode.addEventListener('click',changeHandler,false);
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
    var commentNode = new StatusBuilder(id, 0);
      save.statusBuilder.push(commentNode);  
      AJAX(save, function(data){
        if(data == '#updated'){
            location.reload();
        }
    }, Sophwork.getUrl('nimda/options.php'), 'text');


} 

