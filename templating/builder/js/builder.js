/**
 *	Handlers
 */
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

	if (e.stopPropagation) {
		e.stopPropagation(); // stops the browser from redirecting.
	}
	// Don't do anything if dropping the same column we're dragging.
		console.log(this.classList[0]);
		console.log(dragSrcEl.classList[0]);
	if (dragSrcEl != this && dragSrcEl.classList[0] == this.classList[0]) {
		// Set the source column's HTML to the HTML of the column we dropped on.
		dragSrcEl.innerHTML = this.innerHTML;
		this.innerHTML = e.dataTransfer.getData('text/html');
	}
	// See the section on the DataTransfer object.

	return false;
}


function handleDragStart(e) {
	// Target (this) element is the source node.
	// this.style.opacity = '0.4';

	dragSrcEl = this;
	e.dataTransfer.effectAllowed = 'move';
	e.dataTransfer.setData('text/html', this.innerHTML);
}

function handleDragEnd(e) {
	// this/e.target is the source node.

	[].forEach.call(cols, function (col) {
	col.classList.remove('over');
	});
}

function handleClick(){
	document.getElementById('ctx-menu').style.display = 'block';
	document.getElementById('ctx-title').innerHTML = this.innerHTML;
}

function closeBx(){
	document.getElementById('ctx-menu').style.display = 'none';
}

function closeLine(){
	var parentId = this.getAttribute('data');
	var parent = document.getElementById(parentId);

	document.getElementsByClassName('content')[0].removeChild(parent);
}
/**
 *	helpers
 */

 function randomColor(){
	return '#' + (function co(lor){   return (lor +=
	  [0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f'][Math.floor(Math.random()*16)])
	  && (lor.length == 6) ?  lor : co(lor); })('');
 }
/**
 *	Action
 */
 function addListners(){
	var draggers = document.querySelectorAll('.items');
	[].forEach.call(draggers, function(dragger) {
		dragger.addEventListener('dragstart', handleDragStart, false);
		dragger.addEventListener('dragenter', handleDragEnter, false);
		dragger.addEventListener('dragover', handleDragOver, false);
		dragger.addEventListener('dragleave', handleDragLeave, false);
		dragger.addEventListener('drop', handleDrop, false);
		dragger.addEventListener('dragend', handleDragEnd, false);
	});

	// element to drag
	var cols = document.querySelectorAll('.builder-section');
	[].forEach.call(cols, function(col) {
		col.addEventListener('dragstart', handleDragStart, false);
		col.addEventListener('dragenter', handleDragEnter, false);
		col.addEventListener('dragover', handleDragOver, false);
		col.addEventListener('dragleave', handleDragLeave, false);
		col.addEventListener('drop', handleDrop, false);
		col.addEventListener('click', handleClick, false);
	});

	var lines = document.querySelectorAll('.line');
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
}

	// one by one
	var btn1 = document.getElementById('add-button-obo');
	var range = document.getElementById('add-number');
	var number = range.value;
	btn1.addEventListener('click', function(){
		gridHelper.addGridLines(number);
	}, false);
	range.addEventListener('input', function(){
		number = range.value;
	 	document.getElementById('number').value=number;
	});

	// groupe button
	var btn2 = document.getElementById('add-button-grp');
	btn2.addEventListener('click', function(){
		document.getElementsByClassName('overlay')[0].style.display = "block";
		document.getElementsByClassName('grid-list')[0].style.display = "block";
		document.getElementById('close-gl').addEventListener('click',function(){
			document.getElementsByClassName('overlay')[0].style.display = "none";
			document.getElementsByClassName('grid-list')[0].style.display = "none";
		});
	}, false);
	
	// grouped grid
	var layouts = document.querySelectorAll('.layouts');
	[].forEach.call(layouts, function(layout) {
		layout.addEventListener('click',function(){console.log('plop');
			gridHelper.addGroupedGridLines(layout);
			document.getElementsByClassName('overlay')[0].style.display = "none";
			document.getElementsByClassName('grid-list')[0].style.display = "none";
		}, false );
	});
	// Globals closer
	// ctx-close
	// var closer = document.getElementById('ctx-close');
	// closer.addEventListener('click', function(){
	// 	closeBx();
	// }, false);