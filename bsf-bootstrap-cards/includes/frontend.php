<div class="bb_boot_card_container">

	<!--Card image-->
	<div class="bb_boot_card_image fl-photo<?php if ( ! empty( $settings->crop ) ) echo ' fl-photo-crop-' . $settings->crop ; ?> fl-photo-align-<?php echo $settings->align; ?>">
	    <?php if( $settings->photo != '' && isset( $settings->photo_src) ){ ?> 
		   <img src="<?php echo $settings->photo_src; ?>"/>
		<?php } ?>
	</div>
	<!--/.Card image-->

	<!--Card content-->
	<div class="bb_boot_card_block bb-content-align-<?php echo $settings->alignment; ?>">
	    
	    <!--Title-->
	    <<?php echo $settings->tag; ?> class="bb_boot_card_title"><?php echo $settings->card_title; ?></<?php echo $settings->tag; ?>>
	    <!--/.Title-->
	    
	    <!--Text-->
			<div class="bb_boot_card_text">
				<?php echo $settings->card_textarea; ?>
			</div>
		<!--/.Text-->
	    
	    <!--Link--> 
	   	<?php if( $settings->card_btn_type == 'link' ){ ?>  
		    <a class="bb_boot_card_link" href="<?php echo $settings->link_field; ?>" target="<?php echo $settings->link_target?>">
		    	<?php echo $settings->card_btn_text; ?>
		    </a>
	    <?php } else if($settings->card_btn_type == 'button'){ ?>
	     	<a class="bb_boot_card_link_button" href="<?php echo $settings->btn_link; ?>" target="<?php echo $settings->btn_link_target?>">
				<span class="bb_boot_button"><?php echo $settings->btn_text; ?></span>
			</a>	
		<?php } ?>
		<!--/.Link-->

	</div>
	<!--/.Card content-->

</div>    