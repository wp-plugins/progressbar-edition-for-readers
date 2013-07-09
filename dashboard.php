<?php
	class ProgressbarDashboard
	{
		public function readWidgetConfiguration() {
			$optionList = array('progressbar', 'progressbar-audio', 'progressbar-ebook', 'progressbar-kindle');
			$activeWidgets = NULL;
			
			foreach($optionList as $option)
			{
				$value = get_option('widget_' . $option);
							
				if(is_null($value) || empty($value)) continue;
	
				foreach($value as $number => $configuration)
				{
					if($number == '_multiwidget') continue;
					
					if(isset($_POST['updateProgress'])) {
						$configuration['progress'] = $_POST[$option.'-'.$number.'_progress'];
						$value[$number]['progress'] = $configuration['progress'];
					}
					
					if($configuration['book']) {
						$activeWidgets[$option . '-' . $number] = $configuration;
					}
				}
				
				if(isset($_POST['updateProgress'])) 
				{
					update_option('widget_' . $option, $value);
				}
			}
			
			return $activeWidgets;
		}
		
		public function dashboard_widget_function() 
		{
			$activeWidgets = $this->readWidgetConfiguration();
					
			?>
			<div class="table table_content">
			<p class="sub">Current progress</p>
			<form action="" method="POST">
			<input type="hidden" name="updateProgress" value="1" />
			<table>
			
			<?php
			if(is_null($activeWidgets) || empty($activeWidgets)) {
				echo '<tr><td>No books found. Please add new books to you widget sidebar.</td></tr>';
			} else {
				foreach($activeWidgets as $id => $widget)
				{
					?><tr>
					<td align="right"><?=$widget['book'];?>:</td>
					<td><input type="text" value="<?=$widget['progress']; ?>" name="<?=$id; ?>_progress" size="2" /> of <?=$widget['max'];?></td>
					</tr>
					<?php
				}
			
				?>
				<tr><td></td>
				<td><input type="submit" value="Update" class="button" /></td>
				
				<?php
				}
			?>
			</tr>
			</table>
			</form>
			</div>
			
			<p class="manage">
				<a href="<?=get_admin_url();?>widgets.php">Manage your books</a>
			</p><?php
		}
		
		public function add_dashboard_widgets() 
		{
			wp_add_dashboard_widget('dashboard_progressbar', 'Progressbar (edition for readers)', array($this, 'dashboard_widget_function'));	
		}
		
		public function add_my_stylesheet()
		{
			// Respects SSL, Style.css is relative to the current file
	        wp_register_style( 'dashboard_progressbar_style', plugins_url('style.css', __FILE__) );
	        wp_enqueue_style( 'dashboard_progressbar_style' );
		}
		
		public function __construct() 
		{
			/**
		     * Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
		     */
	    	add_action('admin_enqueue_scripts', array($this, 'add_my_stylesheet' ) );
			add_action('wp_dashboard_setup', array($this, 'add_dashboard_widgets') );
		}

	}
	// Initialize the dashboard plugin.
	new ProgressbarDashboard();
?>