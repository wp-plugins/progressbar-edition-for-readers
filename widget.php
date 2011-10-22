<?php
	class ProgressbarWidget extends WP_Widget {
		function __construct() {
			parent::WP_Widget('progressbar','Progressbar',array('description' => 'Ein Fortschrittsbalken'));
		}

		function widget($args,$instance) {
			extract($args);
			$title 		= apply_filters('widget_title', $instance['title'] );
			$author 	= apply_filters('widget_author',$instance['author']);
			$book 		= apply_filters('widget_author',$instance['book']);
			$progress 	= apply_filters('widget_author',$instance['progress']);
			$max 		= apply_filters('widget_author',$instance['max']);
			$cover 		= apply_filters('widget_author',$instance['cover']);
		
			echo $before_widget;
			if ($title){
				echo $before_title . $title . $after_title; 
			} 
			
			include('_config.php');
			include('_style.php');
            
            if($cover) { ?>
       			<p align="center"><img class="thumb" src="<?php echo($cover); ?>" /></p>
       		<?php } ?>
            <p style="text-align: center;">
            	<b><?php echo $book; ?> von <?php echo $author; ?></b>
            </p>
            <p style="text-align: center;">
            	<div id="progressbar">
                	<div style="width:<?php if($progress > 0) { echo(($progress/$max)*100); } else { echo(0); } ?>%"></div>
                </div>   
            </p>
            <p style="text-align: center;">
				<?php echo $progress; ?> von <?php echo $max; ?> Seiten (<?php if($progress > 0) { echo(round(($progress/$max)*100,2)); } else { echo(0); } ?>%)
            </p>
            <?php echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] 		= strip_tags($new_instance['title']);
			$instance['author']		= strip_tags($new_instance['author']);
			$instance['book'] 		= strip_tags($new_instance['book']);
			$instance['progress'] 	= strip_tags($new_instance['progress']);
			$instance['max'] 		= strip_tags($new_instance['max']);
			$instance['cover'] 		= strip_tags($new_instance['cover']);
			return $instance;
		}

		function form( $instance ) {
			if ( $instance ) {
				$title 				= esc_attr( $instance[ 'title' ] );
				$author 			= esc_attr($instance['author']);
				$book 				= esc_attr($instance['book']);
				$progress 			= esc_attr($instance['progress']);
				$max 				= esc_attr($instance['max']);
				$cover 				= esc_attr($instance['cover']);
			} else {
				$title 				= __( 'Ich lese gerade', 'text_domain' );
				$author 			= __('','text_domain');
				$book 				= __('','book');
				$progress 			= __('','progress');	
				$max 				= __('','max');
				$cover 				= __('','max');
			}
			?>
            <p>
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
          		<label for="<?php echo $this->get_field_id('progress'); ?>"><?php _e('Seite:'); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id('progress'); ?>" name="<?php echo $this->get_field_name('progress'); ?>" type="text" value="<?php echo $progress; ?>" /> von
                <input class="widefat" id="<?php echo $this->get_field_id('max'); ?>" name="<?php echo $this->get_field_name('max'); ?>" type="text" value="<?php echo $max; ?>" />
            </p> 
            <p>
                <label for="<?php echo $this->get_field_id('cover'); ?>"><?php _e('Link zum Cover:'); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id('cover'); ?>" name="<?php echo $this->get_field_name('cover'); ?>" type="text" value="<?php echo $cover; ?>" />
            </p>                    
			<?php 
		}
	}
?>