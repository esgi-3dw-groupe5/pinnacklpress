var nbLines = 0;
var gridHelper = {

	addGridLines : function(nbGrid){
		nbLines = document.getElementById('canvas').childNodes.length;
		nbLines++;
		
		if(nbGrid == 0)
			nbGrid = 1;
		var line = document.createElement('div');
		line.classList.add('builder-line');
		line.setAttribute('id', nbLines);
		// line.setAttribute('draggable', 'true');

		var header = document.createElement('header');
		
		var close = document.createElement('i');
		close.setAttribute('data',nbLines);
		close.classList.add('close');
		header.appendChild(close);

		line.appendChild(header);
		
		for(var i=1; i<=nbGrid; i++){
			var section = document.createElement('div');
			section.classList.add('builder-section');
			section.classList.add('gr-'+nbGrid);
			section.setAttribute('data-grid', 'grid-'+nbGrid);
			section.setAttribute('data-module', 'null');
			section.setAttribute('data-content', 'null');
			section.setAttribute('draggable', 'true');
			
			var text = document.createTextNode("Section " + i);
			section.appendChild(text);

			line.appendChild(section);
		}

		document.getElementById('canvas').appendChild(line);
		listeners.addLineListener();
		listeners.addSectionListener();
	},

	addGroupedGridLines:function(e){
		var data = e.getAttribute('data');
		var grids = data.split(",");

		nbLines = document.getElementById('canvas').childNodes.length;
		nbLines++;

		var line = document.createElement('div');
		line.classList.add('builder-line');
		line.setAttribute('id', nbLines);
		// line.setAttribute('draggable', 'true');

		var header = document.createElement('header');
		
		var close = document.createElement('i');
		close.setAttribute('data',nbLines);
		close.classList.add('close');
		header.appendChild(close);

		line.appendChild(header);

		for(var i=0; i<=grids.length-1; i++){
			var num = i+1;
			var section = document.createElement('div');
			section.classList.add('builder-section');
			section.classList.add('gd-'+grids[i]);
			section.setAttribute('data-grid', 'grid-'+grids[i]);
			section.setAttribute('data-module', 'null');
			section.setAttribute('data-content', 'null');
			section.setAttribute('draggable', 'true');
			
			var text = document.createTextNode("Section " + num);
			section.appendChild(text);

			line.appendChild(section);
		}
		document.getElementById('canvas').appendChild(line);
		listeners.addLineListener();
		listeners.addSectionListener();
	},
};