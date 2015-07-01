var activeSection;
var listeners = {
	addNewLineListener : function(){
		var btn1 = document.getElementById('add-button-obo');
		var range = document.getElementById('add-number');
		if(range !== null){
			var number = range.value;
			btn1.addEventListener('click', function(){
				gridHelper.addGridLines(number);
			}, false);
			range.addEventListener('input', function(){
				number = range.value;
			 	document.getElementById('number').value=number;
			});
		}
	},
	addGroupModalListener : function(){
		var btn2 = document.getElementById('add-button-grp');
		if(btn2 !== null){
			btn2.addEventListener('click', function(){
				document.getElementsByClassName('overlay')[0].style.display = "block";
				document.getElementsByClassName('grid-list')[0].style.display = "block";

				document.getElementById('close-gl').addEventListener('click',function(){
					document.getElementsByClassName('overlay')[0].style.display = "none";
					document.getElementsByClassName('grid-list')[0].style.display = "none";
				});
			}, false);
		}
	},
	addMuduleModalListener : function(e){
			activeSection = e;
			document.getElementsByClassName('overlay')[0].style.display = "block";
			document.getElementsByClassName('content-list')[0].style.display = 'block';

			document.getElementById('close-md').addEventListener('click',function(){
				document.getElementsByClassName('overlay')[0].style.display = "none";
				document.getElementsByClassName('content-list')[0].style.display = "none";
			});
	},
	addSectionListener : function(){
		var cols = document.querySelectorAll('.builder-section');
		[].forEach.call(cols, function(col) {
			col.addEventListener('dragstart', handleDragStart, false);
			col.addEventListener('dragenter', handleDragEnter, false);
			col.addEventListener('dragover', handleDragOver, false);
			col.addEventListener('dragleave', handleDragLeave, false);
			col.addEventListener('drop', handleDrop, false);
			col.addEventListener('click', function(){listeners.addMuduleModalListener(col)}, false);
		});
	},
	addLineListener : function(){
		var lines = document.querySelectorAll('.builder-line');
		[].forEach.call(lines, function(line) {
			// line.addEventListener('dragstart', handleDragStart, false);
			// line.addEventListener('dragenter', handleDragEnter, false);
			// line.addEventListener('dragover', handleDragOver, false);
			// line.addEventListener('dragleave', handleDragLeave, false);
			// line.addEventListener('drop', handleDrop, false);
		});
		var closes = document.querySelectorAll('.close');
		[].forEach.call(closes, function(close) {
			close.addEventListener('click', closeLine, false);
		});
	},
	addGridListListener : function(){
		var layouts = document.querySelectorAll('.layouts');
		[].forEach.call(layouts, function(layout) {
			layout.addEventListener('click',function(){
				gridHelper.addGroupedGridLines(layout);
				document.getElementsByClassName('overlay')[0].style.display = "none";
				document.getElementsByClassName('grid-list')[0].style.display = "none";
			}, false );
		});
	},
	// addModuleListListener
	addContentListListener : function(){
		var modules = document.querySelectorAll('.modules');
		[].forEach.call(modules, function(module) {
			module.addEventListener('click',function(){
				if(module.getAttribute('data') == '[text]'){
					document.getElementsByClassName('text-module')[0].style.display = "block";
					textModule.addSaveListener(module);
				}else if(module.getAttribute('data') == '[form]'){
					document.getElementsByClassName('form-module')[0].style.display = "block";
					formModule.addSaveListener(module);
				}
				
			}, false );
		});

		// Module : Text

		var elementClose = document.getElementById('close-form');
		
		if(elementClose != null){
			document.getElementById('close-form').addEventListener('click',function(){
				document.getElementsByClassName('form-module')[0].style.display = "none";
			});
		}
		document.getElementById('close-tx').addEventListener('click',function(){
			document.getElementsByClassName('text-module')[0].style.display = "none";
		});
		
		
		
	},
	addSaveBuilderListener:function(){
		if(document.getElementById('save-builder') !== null){
			document.getElementById('save-builder').addEventListener('click',function(){
				console.log("Save page builder");
				var save = builderHelper.saveBuilder();
				var data = {pageBuilder:save};
				// get the right url
				var url = window.location.href;
				var stop = false;
				var link = "";
				urls = url.split('/');
				[].forEach.call(urls, function (url) {
					if(url == 'pages' || url == 'footers'){
						stop = true;
						return;
					}
					if(!stop)
						link+=url+"/";
				});
				
				builderHelper.AJAX(data, function(data){
					console.log(data);
					window.location.reload();
				}, link+'options.php');
			});
		}
	},
	addAutoSaveListener:function(){
		document.getElementById('save-builder').addEventListener('click',function(){
			console.log("Auto save page builder");
			
				builderHelper.saveBuilder();
		});
	},
	addClearBuilderListener:function(){
		if(document.getElementById('save-builder') !== null){
			document.getElementById('clear-builder').addEventListener('click',function(){
				if(confirm("All content created in the Page Builder will be lost.\n\nDo you want to proceed?")){
					builderHelper.clearBuilder();
				}
			});
		}
	},
};

// Listener Methods
function closeLine(){
	var parentId = this.getAttribute('data');
	var parent = document.getElementById(parentId);
	document.getElementById('canvas').removeChild(parent);
}

// Drag And Drope
var dragSrcEl = null;

function handleDragStart(e) {
	this.style.opacity = '0.4';  // this / e.target is the source node.
}

function handleDragOver(e) {
	if (e.preventDefault) {
		e.preventDefault(); // Necessary. Allows us to drop.
	}

	e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.

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
	if (dragSrcEl != this && dragSrcEl.classList[0] == this.classList[0]) {
		// Set the source column's HTML to the HTML of the column we dropped on.
		dragSrcEl.innerHTML = this.innerHTML;
		dragSrcEl.setAttribute('data-module', this.getAttribute('data-module'));
		dragSrcEl.setAttribute('data-content', this.getAttribute('data-content'));

		var trasferedData = e.dataTransfer.getData("text/plain");
		var data = trasferedData.split(",");
		
		this.setAttribute('data-module', data[0]);
		this.setAttribute('data-content', data[1]);
		this.innerHTML = data[2];
	}
	// See the section on the DataTransfer object.

	return false;
}


function handleDragStart(e) {
	// Target (this) element is the source node.
	// this.style.opacity = '0.4';

	dragSrcEl = this;
	e.dataTransfer.effectAllowed = 'move';
	e.dataTransfer.setData("text/plain", this.getAttribute('data-module')+","+this.getAttribute('data-content')+","+this.innerHTML);
}

function handleDragEnd(e) {
	// this/e.target is the source node.

	[].forEach.call(cols, function (col) {
	col.classList.remove('over');
	});
}