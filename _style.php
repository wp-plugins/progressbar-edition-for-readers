<style type="text/css">
	#progressbar {
		width: <?php echo($width); ?>;
		height: <?php echo($height); ?>;
		background-color: <?php echo($bgColor); ?>;	
		border: 1px solid <?php echo($borderColor); ?>;
		margin: 0;
		padding: 0;
	}
	#progressbar div {
		height: 100%;
		background-color: <?php echo($progressbarColor); ?>;	
		<?php if($progress > 0) { ?>
		border-right: 1px solid <?php echo($borderColor); ?>;
		<?php } ?>
		margin: 0;
		padding: 0;
	}

	.progressbar-thumb {
		width: 150px;
	
	}
</style>
