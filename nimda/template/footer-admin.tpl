		<footer class="admin-footer">
		</footer>
		</div>
		<?php
			$cnf = @file_get_contents( __DIR__ . '/../../sophwork.json');
		?>
		<script>
			window.cnf = <?php echo $cnf?>;
		</script>
	</body>
</html>