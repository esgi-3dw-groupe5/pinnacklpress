
Sophwork.ready(function(){
	loadNodesBuilder();
});
// Drag And Drope
var selectedNode = null;
var dragSrcEl = null;
var dragSrcParent = null;

function handleDragStart(e) {
	// Target (this) element is the source node.
	// this.style.opacity = '0.4';
	var selected =  document.querySelectorAll('.selected-node');
	[].forEach.call(selected, function(node){
		node.classList.remove('selected-node');
	});
	this.classList.add('selected-node');
	selectedNode = this;

	dragSrcEl = this;
	dragSrcParent = this.parentNode;
	e.dataTransfer.effectAllowed = 'move';
	e.dataTransfer.setData("text/plain", e.target.id);
}

function handleDragOver(e) {
	e.preventDefault();
	if (e.preventDefault) {
		e.preventDefault(); // Necessary. Allows us to drop.
	}

	e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.
	this.classList.add('over');
	return false;
}

function handleDragEnter(e) {
	// this / e.target is the current hover target.
	this.classList.add('over');
}

function handleDragLeave(e) {
	this.classList.remove('over');  // this / e.target is previous target element.
}

function handleDrop(e) {
	// this / e.target is current target element.
	e.preventDefault();
	if (e.stopPropagation) {
		e.stopPropagation(); // stops the browser from redirecting.
	}
	// Don't do anything if dropping the same column we're dragging.
	if (dragSrcEl != this) {
		if(typeof(this.children[1]) != 'undefined')
			var replaced = document.getElementById(this.children[1].id);
		else
			var replaced = document.getElementById(this.children[0].id);
		dragSrcParent.appendChild(replaced);
		
		var data = e.dataTransfer.getData("text");
		var droped = document.getElementById(data);

		var tps = replaced.getAttribute('data-lv');
		replaced.setAttribute('data-lv', droped.getAttribute('data-lv'));
		droped.setAttribute('data-lv', tps);

		var tps = replaced.getAttribute('data-order');
		replaced.setAttribute('data-order', droped.getAttribute('data-order'));
		droped.setAttribute('data-order', tps);
		
		this.appendChild(droped);
	}
	return false;	
}

function handleDragEnd(e) {
	// this/e.target is the source node.
	var overs = document.querySelectorAll('.over');
	[].forEach.call(overs, function (over) {
		over.classList.remove('over');
	});
}

function selected(){
	var selected =  document.querySelectorAll('.selected-node');
	[].forEach.call(selected, function(node){
		node.classList.remove('selected-node');
	});
	this.classList.add('selected-node');
	selectedNode = this;
}

var cols = document.querySelectorAll('#menu-builder .menu-node');
[].forEach.call(cols, function(col) {
  col.addEventListener('dragstart', handleDragStart, false);
  col.addEventListener('dragend', function(e){
  	setTimeout(function(){
		var selected =  document.querySelectorAll('.selected-node');
		[].forEach.call(selected, function(node){
			node.classList.remove('selected-node');
		});
  	}, 1000);
  }, false);  
  col.addEventListener('click', selected, false);
});

var containers = document.querySelectorAll('#menu-builder .drag-container');
[].forEach.call(containers, function(container){
	container.addEventListener('dragover', handleDragOver, false);
	container.addEventListener('drop', handleDrop, false);
	container.addEventListener('dragenter', handleDragEnter, false);
	container.addEventListener('dragleave', handleDragLeave, false);
	container.addEventListener('dragend', handleDragEnd, false);
});

function moveLeft(e){
	if(selectedNode !== null){
		if(!selectedNode.parentNode.classList.contains('level-1')){
			console.log('Move left');
			var prevLv = selectedNode.parentNode.parentNode;
			var pastLv = selectedNode.parentNode;
			if(selectedNode != prevLv){
				prevLv.appendChild(selectedNode);
				pastLv.classList.add('display-none');

				var nodeLevel = Number(selectedNode.getAttribute('data-lv'));
				selectedNode.setAttribute('data-lv', --nodeLevel);
				selectedNode.setAttribute('data-parent', getCurentRoot(selectedNode));				
			}
		}
	}
}

function moveRight(e){
	if(selectedNode !== null){
		var level1 = document.querySelectorAll('.drag-container.level-1');
		if(level1[0] != selectedNode.parentNode){
			var nextLv = selectedNode.parentNode.children[0];
			nodes = document.querySelectorAll('.menu-node');
			var pastNode = null;
			var actNode = false;
			[].forEach.call(nodes, function(node){
				if(selectedNode == node){actNode = true; return;}
				if(actNode) return;
				pastNode = node;
			});

			var pastNodeLevel = Number(pastNode.getAttribute('data-lv'));
			var nodeLevel = Number(selectedNode.getAttribute('data-lv'));

			if(selectedNode != nextLv && pastNodeLevel+1 >= nodeLevel+1){
				console.log('Move right');
				
				nextLv.classList.remove('display-none');
				nextLv.appendChild(selectedNode);

				selectedNode.setAttribute('data-lv', ++nodeLevel);
				selectedNode.setAttribute('data-parent', getCurentRoot(selectedNode));
			}
		}
	}
}

function getCurentRoot(currentNode){
	nodes = document.querySelectorAll('.menu-node');
	var lastRoot = null;
	var pastNode = null;
	var actNode = false;

	[].forEach.call(nodes, function(node){
		if(currentNode == node){actNode = true; return;}
		if(actNode) return;
		pastNode = node;

		if(Number(pastNode.getAttribute('data-lv')) < Number(currentNode.getAttribute('data-lv'))){
			lastRoot = pastNode;
		}
	});
	return lastRoot.id;
}

var mvLeft = document.getElementById('mv-left');
var mvRight = document.getElementById('mv-right');
var saveBtn = document.getElementById('save-builder');
mvLeft.addEventListener('click', moveLeft, false);
mvRight.addEventListener('click', moveRight, false);
saveBtn.addEventListener('click', saveBuilder, false);

// create a node menu object

var MenuNode = function(id, dataLv, dataOrder, dataParent){
	this.id = id;
	this.dataLv = dataLv;
	this.dataOrder = dataOrder;
	this.dataParent = dataParent;
}

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

function saveBuilder(e){
	e.preventDefault();
	console.log('saving...');
	var save = {'nodesBuilder':[]};

	var nodes = document.querySelectorAll('.menu-node');
	var nbNode = 0;
	[].forEach.call(nodes, function(node){
		var id = node.id;
		var dataLv = node.getAttribute('data-lv');
		var dataOrder = node.getAttribute('data-order');
		var dataParent = node.getAttribute('data-parent');

		var menuNode = new MenuNode(id, dataLv, dataOrder, dataParent);

		save.nodesBuilder.push(menuNode);
	});
	
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

function loadNodesBuilder(){
	nodes = document.querySelectorAll('.menu-node');
	[].forEach.call(nodes, function(node){
		selectedNode = node;
		for (var i = 1; i < Number(node.getAttribute('data-lv')); i++) {
			
			var nextLv = selectedNode.parentNode.children[0];
			nextLv.classList.remove('display-none');
			nextLv.appendChild(selectedNode);
		};
	});
}