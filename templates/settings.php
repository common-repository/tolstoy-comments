<?php

defined('ABSPATH') || exit();

use Gtxtymt\Plugins\Tolstoycomments\Plugin;
?>
<div class="wrap">
	<h2><?php echo Plugin::$pluginName;?></h2>

	<form action="<?php echo admin_url('options.php');?>" method="post">
		<?php
		settings_fields(Plugin::$pluginSlug.'_group');
		do_settings_sections(Plugin::$pluginSlug.'_section');
		?>
        <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php echo __('Save changes', 'tolstoycomments');?>"> 
		
		<?php 
		if (wp_next_scheduled('tolstoycomments_cron_task_queue')){ 
			?>
			<span class="button button-secondary"><?php echo __('Start export now', 'tolstoycomments');?></span>
			<label><?php echo __('The task is already running.', 'tolstoycomments'); ?></label>
			<?php 
		} else {
			?>
			<a href="<?php echo admin_url('admin-ajax.php');?>?action=tolstoycomments_export_start" class="button button-secondary"><?php echo __('Start export now', 'tolstoycomments');?></a>
			<?php 
		}
		?>
	</form>
</div>
