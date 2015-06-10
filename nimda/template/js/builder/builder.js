document.addEventListener("DOMContentLoaded", function() {
	$('#wysiwyg').trumbowyg({
           btnsDef: {
               // Customizables dropdowns
               image: {
                   dropdown: ['insertImage', 'upload', 'base64'],
                   ico: 'insertImage'
               }
           },
           btns: ['viewHTML',
               '|', 'formatting',
               '|', 'btnGrp-design',
               '|', 'link',
               '|', 'image',
               '|', 'btnGrp-justify',
               '|', 'btnGrp-lists',
               '|', 'foreColor', 'backColor',
               '|', 'horizontalRule']
       });
	listeners.addNewLineListener();
	listeners.addGroupModalListener();
	listeners.addSectionListener();
	listeners.addLineListener();
	listeners.addGridListListener();
	listeners.addContentListListener();
	listeners.addSaveBuilderListener();
	listeners.addClearBuilderListener();
});

var builderHelper = {
	saveBuilder:function(){
		var builderSave = [];
		var save = [];
		// Iterate on lines
		var lines = document.querySelectorAll('.builder-line');
		[].forEach.call(lines, function(line) {
			// save the builder
			builderSave.push(line);
			// ---
			var grids = line.childNodes;
			var  i = 0;
			var li = {line:[]};
			[].forEach.call(grids, function(grid) {
				if(i == 0){i++;return;}
				// class|module|content
				var cl = grid.getAttribute('data-grid');
				var md = grid.getAttribute('data-module');
				var ct = grid.getAttribute('data-content');
				section = new gridObject(cl, md, ct);
				li.line.push(section);
				i++;
			});
			save.push(li);
		});
		// console.log(save);
		// console.log(JSON.stringify(save));
		return JSON.stringify(save);
	},
	clearBuilder:function(){
		var lines = document.querySelectorAll('.line');
		[].forEach.call(lines, function(line) {
			document.getElementById('canvas').removeChild(line);
		});
	},
	AJAX:function (data, callback, URL, type){
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
	},
};
 // function randomColor(){
	// return '#' + (function co(lor){   return (lor +=
	//   [0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f'][Math.floor(Math.random()*16)])
	//   && (lor.length == 6) ?  lor : co(lor); })('');
 // }

 function gridObject(grid, module, content){
 	this.gridClass = grid;
 	this.gridModule = module;
 	this.gridContent = content;
 }