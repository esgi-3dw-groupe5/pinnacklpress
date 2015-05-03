<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Title </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<link rel="stylesheet" href="css/builder.css">
	</head>
	<body>
		<header>
			<nav>
			</nav>
		</header>
		<section>
			<div id="columns">
				<div class="column" draggable="true"><header>A</header></div>
				<div class="column" draggable="true"><header>B</header></div>
				<div class="column" draggable="true"><header>C</header></div>
			</div>
			<div class="content">
				<div class="builder-section" draggable="true">plop</div>
				<div class="builder-section" draggable="true">plop</div>
				<div class="builder-section" draggable="true">plop</div>
	
				<div class="builder-section" draggable="true">plop</div>
				<div class="builder-section" draggable="true">plop</div>
				<div class="builder-section" draggable="true">plop</div>
				
				<div class="builder-section" draggable="true">plop</div>
				<div class="builder-section" draggable="true">plop</div>
				<div class="builder-section" draggable="true">plop</div>
			</div>
		</section>
		<aside>
		</aside>
		<footer>
		</footer>
	<script>
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
			if (dragSrcEl != this) {
				// Set the source column's HTML to the HTML of the column we dropped on.
				dragSrcEl.innerHTML = this.innerHTML;
				this.innerHTML = e.dataTransfer.getData('text/html');
			}
			// See the section on the DataTransfer object.

			return false;
		}
	
		var dragSrcEl = null;

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

		var draggers = document.querySelectorAll('#columns .column');
		[].forEach.call(draggers, function(dragger) {
			dragger.addEventListener('dragstart', handleDragStart, false);
			dragger.addEventListener('dragenter', handleDragEnter, false);
			dragger.addEventListener('dragover', handleDragOver, false);
			dragger.addEventListener('dragleave', handleDragLeave, false);
			dragger.addEventListener('drop', handleDrop, false);
			dragger.addEventListener('dragend', handleDragEnd, false);
		});

		// element to drag
		var cols = document.querySelectorAll('.content .builder-section');
		[].forEach.call(cols, function(col) {
			col.addEventListener('dragstart', handleDragStart, false);
			col.addEventListener('dragenter', handleDragEnter, false);
			col.addEventListener('dragover', handleDragOver, false);
			col.addEventListener('dragleave', handleDragLeave, false);
			col.addEventListener('drop', handleDrop, false);
			col.addEventListener('dragend', handleDragEnd, false);
		});
	</script>
	</body>
</html>