<?php
	class ProgressbarSettings {
		public $optionName = 'progressbar-edition-for-readers';
		public $settings;
		
		public function __construct() {
			$this->load();
			$this->addHooks();
		}
		
		public function addHooks() {
			if(!is_admin()) return;
			
			add_action('admin_menu', array($this, 'ProgressbarCreateMenu'), 10);
			global $wp_version;
			if ( version_compare($wp_version, '2.7', '>=' ) ) {
				add_filter( 'plugin_action_links', array($this, 'add_filter_plugin_action_links'), 10, 2 );
			}
		}
		
		function add_filter_plugin_action_links( $links, $file ) {
			if ( $file == PROGRESSBAR_READERS_PLUGIN_BASENAME ) {
				$links[] = '<a href="'.$this->GetPluginOptionsURL().'">' . __('Settings') . '</a>';
			}
			return $links;
		}
		
		function GetPluginOptionsURL() {
			if (function_exists('admin_url')) {	// since WP 2.6.0
				$adminurl = trailingslashit(admin_url());			
			} else {
				$adminurl = trailingslashit(get_settings('siteurl')).'wp-admin/';
			}
			return $adminurl.'options-general.php'.'?page=' . PROGRESSBAR_READERS_PLUGIN_NAME;		
		}

		function ProgressbarCreateMenu() {
			add_options_page('Progressbar', 'Progressbar', 10, PROGRESSBAR_READERS_PLUGIN_NAME, array($this, 'ProgressbarOptionsPage'));
		}	
		
		function ProgressbarOptionsPage(){
			global $pb_PluginName;
			
			if(isset($_POST['updateSettings'])) {
				if(is_numeric($_POST['width']) || is_numeric($_POST['height'])) {
					echo "<div id='message' class='error' style='width: 505px;'><p><b>Einheiten angeben! Einstellungen wurden <u>nicht</u> gespeichert.</b></p></div>";				
				} else {
					$settings['width'] = $_POST['width'];
					$settings['height'] = $_POST['height'];
					$settings['bgColor'] = $_POST['bgColor'];
					$settings['borderColor'] = $_POST['borderColor'];
					$settings['progressbarColor'] = $_POST['progressbarColor'];
					$settings['precision'] = $_POST['precision'];
					$this->settings = $settings;
					$this->save();
			
					echo "<div id='message' class='updated' style='width: 505px;'><p><b>Einstellungen wurden gespeichert.</b></p></div>";	
				}
			} 
		
			extract($this->settings);
	
			require('_style.php');
			?><div class="wrap"><?php
					$configFile = plugin_dir_path(__FILE__) . '_config.php';
					if(is_readable($configFile)) {
						if(is_writable($configFile) && is_writable(plugin_dir_path(__FILE__))) {
							unlink($configFile);
						} else {
							?>
							<div id='message' class='error'><p><strong>Die Datei _config.php wird seit Version 0.4 nicht mehr benötigt. Da keine Schreibrechte auf diese Datei oder das Pluginverzeichnis existieren, löschen Sie die Datei bitte manuell oder vergeben Sie die entsprechenden Rechte!</strong></p></div><br />
							<?php
						}
					}
				?><div id="icon-options-general" class="icon32"><br /></div>
				<h2>Einstellungen &rsaquo; Progressbar (edition for readers)</h2>
				<form method="post" action="options-general.php?page=<?=PROGRESSBAR_READERS_PLUGIN_NAME;?>">
					<input type="hidden" name="updateSettings" value="1" />
					<table class="form-table">
						<tr>
							<th>Gr&ouml;&szlig;e</th>
							<td>
								<input type="text" value="<?php echo($width); ?>" maxlength="6" size="3" name="width" />
								x
								<input type="text" value="<?php echo($height); ?>" maxlength="6" size="3" name="height" />
							</td>
						</tr>   
						<tr>
							<th>Hintergrundfarbe</th>
							<td><input type="text" value="<?php echo($bgColor); ?>" class="regular-text" name="bgColor" style='width: 293px;' /></td>
						</tr>                    
						<tr>
							<th>Farbe des Fortschrittbalkens</th>
							<td><input type="text" value="<?php echo($progressbarColor); ?>" class="regular-text" name="progressbarColor" style='width: 293px;' /></td>
						</tr>
						<tr>
							<th>Farbe des Rahmens</th>
							<td><input type="text" value="<?php echo($borderColor); ?>" class="regular-text" name="borderColor" style='width: 293px' /></td>
						</tr>	
						<tr>
							<th>Anzahl der Nachkommastellen</th>
							<td><input type="text" value="<?php echo($precision); ?>" class="regular-text" name="precision" style='width: 293px' /></td>
						</tr>			
					</table>
					<p class="submit">
						<input type="submit" class="button-primary" value="Speichern" name="submit" />
					</p>
				</form>
				<div id="icon-edit-pages" class="icon32 icon32-posts-post"><br /></div>
				<h2>Vorschau</h2>
				<br />
				<div style="width: 520px;">
					<div id="progressbar">
						<div style="width: 50%;"></div>
					</div>
				</div>
			</div><?php
		}
		
		public function load() {
			$this->settings = get_option($this->optionName);
			if(is_null($this->settings) || empty($this->settings)) {
				$this->loadDefaults();
			}
		}
		
		public function save() {
			update_option($this->optionName, $this->settings);
		}
		
		public function loadDefaults() {
			$settings['width'] = '100%';
			$settings['height'] = '10px';
			$settings['bgColor'] = '#EDEDED';
			$settings['borderColor'] = '#000000';
			$settings['progressbarColor'] = '#01A9DB';
			$settings['precision'] = 0;

			// legacy (<= 0.4): load all _config settings if the file is existing.			
			$configFile = plugin_dir_path(__FILE__) . '_config.php';

			if(is_readable($configFile)) {
				include($configFile);
				
				$settings['width'] = $width;
				$settings['height'] = $height;
				$settings['bgColor'] = $bgColor;
				$settings['borderColor'] = $borderColor;
				$settings['progressbarColor'] = $progressbarColor;
				
				if(is_writable($configFile) && is_writable(plugin_dir_path(__FILE__))) {
					unlink($configFile);
				}
			}
			
			$this->settings = $settings;
		}
	}	
?>