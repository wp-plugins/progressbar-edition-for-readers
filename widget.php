<?php
	class ProgressbarWidgetManager {
		public function __construct() {
			add_action('widgets_init',create_function('','register_widget("ProgressbarWidget");'));	
	        add_action('widgets_init',create_function('','register_widget("ProgressbarAudiobooksWidget");'));
			add_action('widgets_init',create_function('','register_widget("ProgressbarEbooksWidget");'));	
			add_action('widgets_init',create_function('','register_widget("ProgressbarKindleWidget");'));
		}
	}
	
	class ProgressbarWidget extends WP_Widget {
		public $id_base = 'progressbar';
		public $name = 'Progressbar';
		public $description = 'Ein Fortschrittsbalken';
		
		public $progressTitle = array('Keine Seite', 'eine Seite', ' Seiten');
		public $progressLabel = 'Seite';
		public $widgetTitle = 'Ich lese gerade';
			
		function singularPlural($amount, $list)
		{
			if($amount > 1)
				return $amount . ' ' . $list[2];
		
			if($amount == 1)
				return $list[1];
		
			return $list[0];
		}
		
		function __construct() {
			parent::__construct($this->id_base, $this->name, array('description' => $this->description));
		}

		function widget($args,$instance) {			
			global $progressbarSettings;
			extract($args);
				
			$title 		= apply_filters('widget_title', $instance['title'] );
			$author 	= apply_filters('widget_author',$instance['author']);
			$book 		= apply_filters('widget_book',$instance['book']);
			$progress 	= apply_filters('widget_progress',$instance['progress']);
			$max 		= apply_filters('widget_max',$instance['max']);
			$cover 		= apply_filters('widget_cover',$instance['cover']);
			$info       = apply_filters('widget_info',$instance['info']);
		
			echo $before_widget;
			if ($title){
				echo $before_title . $title . $after_title; 
			} 
	
			extract($progressbarSettings->settings);
			
			include('_style.php');
            
            if($cover) { ?>
       			<p align="center"><img class="progressbar-thumb" src="<?php echo($cover); ?>" /></p>
       		<?php } ?>
            <p style="text-align: center;">
            	<b><?php if($book){ echo $book; } if($author){ ?><br />(<?php echo $author; ?>)<?php } ?></b>
            </p>
            <?php if($max) { ?>
            <p>
            	<div id="progressbar" style="margin: 0 auto;">
                	<div style="width:<?php echo $this->currentProgress($progress, $max); ?>%"></div>
                </div>   
            </p>
            
            <p style="text-align: center;">
                <?php echo $this->currentPage($progress, $max); ?> von <?php echo $this->singularPlural($max, $this->progressTitle); ?> (<?php echo $this->currentProgress($progress, $max, $precision); ?>%)
            </p>
            
            <?php }
            if($info) {?>
            <p>
            	<?=$info;?>
            </p>
            <?php } ?>
            <?php echo $after_widget;
		}
                
		function currentPage($progress, $max, $precision=0) {
		    return $progress;
		}
                
		function currentProgress($progress, $max, $precision=0) {
		    if($progress > 0) {
		        return round(($progress/$max)*100, $precision);
		    }
		    return 0;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] 		= strip_tags($new_instance['title']);
			$instance['author']		= strip_tags($new_instance['author']);
			$instance['book'] 		= strip_tags($new_instance['book']);
			$instance['progress'] 	= strip_tags($new_instance['progress']);
			$instance['max'] 		= strip_tags($new_instance['max']);
			$instance['cover'] 		= strip_tags($new_instance['cover']);
			$instance['info']       = $new_instance['info'];
			return $instance;
		}

		function form( $instance ) {
			if ( $instance ) {
				$title 				= esc_attr($instance['title']);
				$author 			= esc_attr($instance['author']);
				$book 				= esc_attr($instance['book']);
				$progress 			= esc_attr($instance['progress']);
				$max 				= esc_attr($instance['max']);
				$cover 				= esc_attr($instance['cover']);
				$info               = esc_attr($instance['info']);
			} else {
				$title 				= __( $this->widgetTitle, 'title' );
				$author 			= __('','author');
				$book 				= __('','book');
				$progress 			= __('','progress');	
				$max 				= __('','max');
				$cover 				= __('','cover');
				$info               = __('','info');
			}
					
			// load the script to use the media upload dialog.
			wp_enqueue_script( 'progressbarMediaUpload' );
			?><p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id('author'); ?>"><?php _e('Author:'); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id('author'); ?>" name="<?php echo $this->get_field_name('author'); ?>" type="text" value="<?php echo $author; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('book'); ?>"><?php _e('Buch:'); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id('book'); ?>" name="<?php echo $this->get_field_name('book'); ?>" type="text" value="<?php echo $book; ?>" />
            </p>      
            <p>
		        <label for="<?php echo $this->get_field_id('progress'); ?>"><?=$this->progressLabel; ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id('progress'); ?>" name="<?php echo $this->get_field_name('progress'); ?>" type="text" value="<?php echo $progress; ?>" /> von
                <input class="widefat" id="<?php echo $this->get_field_id('max'); ?>" name="<?php echo $this->get_field_name('max'); ?>" type="text" value="<?php echo $max; ?>" />
            </p> 
            <p>
				<label for="<?php echo $this->get_field_id('cover'); ?>"><?php _e('Link zum Cover:'); ?>
				<?php $this->addMediaButton($this->get_field_id('cover')); ?>
                </label> 
                <textarea name="<?php echo $this->get_field_name('cover'); ?>" id="<?=$this->get_field_id('cover');?>" class="widefat" rows="3" cols="15"><?php echo $cover; ?></textarea>
            </p> 
            <p>
                <label for="<?php echo $this->get_field_id('info'); ?>"><?php _e('Weitere Informationen:'); ?></label> 
                <textarea name="<?php echo $this->get_field_name('info'); ?>" id="<?php echo $this->get_field_id('info'); ?>" class="widefat" rows="3" cols="15"><?php echo $info; ?></textarea>
            </p>          
			<?php 
		}
		
		function addMediaButton($dataEditor) {
			// we are using the new media library introduced with WP 3.5
			// which needs at least one tinyMCE editor on the page.
            if(function_exists( 'wp_enqueue_media' )){
            	echo '<a onClick="media_upload(\'' . $dataEditor . '\')" class="button-secondary" title="Add Media" id="progressbar_add_media">Add Media</a>';
				echo '<!-- add a dummy editor to have at least one tinyMCE editor on the page.';
				wp_editor('','content');
				echo '-->';
            } else {
            	echo '<a onClick="media_upload(\'' . $dataEditor . '\');" class="add_media" id="progressbarWidget">Upload/Insert <img src="images/media-button.png?ver=20111005" width="15" height="15" /></a>';
            }
		}
	}
	
	class ProgressbarAudiobooksWidget extends ProgressbarWidget {
		public $id_base = 'progressbar-audio';
		public $name = 'Progressbar (H&ouml;rbuch)';
		public $description = 'Ein Fortschrittsbalken für Hörbücher';
		
		public $progressTitle = array('Keine Minute', 'eine Minute', ' Minuten');
		public $progressLabel = 'Minute';
		
		public $widgetTitle = 'Ich h&ouml;re gerade';
	}
                
	class ProgressbarEbooksWidget extends ProgressbarWidget {	
		public $id_base = 'progressbar-ebook';
		public $name = 'Progressbar (E-Book)';
		public $description = 'Ein Fortschrittsbalken für E-Books';
        
		public $progressLabel = 'Prozent';
        
        function currentPage($progress, $max, $precision=0) {
            return round($progress / 100 * $max, $precision);
        }
        
        function currentProgress($progress, $max, $precision=0) {
            return $progress;
        }
	}
	
	class ProgressbarKindleWidget extends ProgressbarWidget {
		public $id_base = 'progressbar-kindle';
		public $name = 'Progressbar (Kindle)';
		public $description = 'Ein Fortschrittsbalken für Kindle (Locations)';
		
		public $progressTitle = array('Keine Location', 'eine Location', ' Locations');
		public $progressLabel = 'Location';
	}
	
	// Initialize the widget manager.
	new ProgressbarWidgetManager();
?>
