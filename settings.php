<?php
	if($_POST['submit'] == "Speichern") {
		if(is_numeric($_POST['width']) || is_numeric($_POST['height'])) {
			echo "<div id='message' class='error' style='width: 505px;'><p><b>Einheiten angeben! Einstellungen wurden <u>nicht</u> gespeichert.</b></p></div>";				
		} else {
			if($handle   = @fopen("../wp-content/plugins/progressbar-edition-for-readers/_config.php",'w+')){
				$content  = "<?php \n\t\$width = '".$_POST['width']."';";
				$content .= "\n\t\$height = '".$_POST['height']."';";
				$content .= "\n\t\$bgColor = '".$_POST['bgColor']."';";
				$content .= "\n\t\$borderColor = '".$_POST['borderColor']."';";
				$content .= "\n\t\$progressbarColor = '".$_POST['progressbarColor']."';\n?>";
				fwrite($handle,$content);
				fclose($handle);
				
				echo "<div id='message' class='updated' style='width: 505px;'><p><b>Einstellungen wurden gespeichert.</b></p></div>";	
			} else {
			echo "<div id='message' class='error' style='width: 505px;'><p><b>Die Datei /wp-content/plugins/progressbar-edition-for-readers/_config.php muss beschreibar sein. Weise ihr mindestens die Rechte 666 zu.</b></p></div>";					
			}
		}
	} 
	require('_config.php');
	require('_style.php');
?>
<div class="wrap">
    
        <div id="icon-options-general" class="icon32"><br /></div>
        <h2>Einstellungen &rsaquo; Progressbar</h2>
        <form method="post" action="options-general.php?page=progressbar-edition-for-readers.php">
            <table class="form-table">
                <tr>
                    <th>Gr&ouml;&szlig;e</th>
                    <td>
                        <input type="text" value="<?php echo($width); ?>" maxlength="6" name="width" />
                        x
                        <input type="text" value="<?php echo($height); ?>" maxlength="6"  name="height" style='width: 143px;'/>
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
</div>