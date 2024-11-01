<?php

namespace Gtxtymt\Plugins\Tolstoycomments;

/**
 * Class SettingsFields
 * @package Gtxtymt\Plugins\Tolstoycomments
 */
class SettingsFields
{
	public function siteId($value)
	{
		?>
		<div>
			<?php echo __('1. Register your site at <a href="https://tolstoycomments.com/">tolstoycomments.com</a>', 'tolstoycomments');?>
		</div>
		<div>
			<?php echo __('2. Copy the Site ID in the Code section of the Tolstoy Comments administration panel', 'tolstoycomments');?>
		</div>
		<div>
			<input type="number" class="regular-text" name="tolstoycomments_site_id" value="<?php echo $value;?>" />	
		</div>
		<?php
	}

	public function active($value)
	{
		?>
		<div>
			<input type="checkbox" name="tolstoycomments_active" value="1" <?php echo $value ? 'checked' : '';?> /> <?php echo __('3. Enable the "Activate" checkbox to display the plugin at the page', 'tolstoycomments');?>
		</div>
		<?php
	}

	public function binding($value)
	{
		?>
		<div>
			<label>
				<div style="width: 30px; float: left;">
					<input type="radio" name="tolstoycomments_binding" value="0" <?php echo !$value ? 'checked="checked"':'';?> />
				</div>
				<div style="margin-left: 30px;">
					<?php echo __('by URL', 'tolstoycomments');?><br/>
					<?php echo __('example:', 'tolstoycomments');?> <i><?php echo get_site_url()?>/your_url_post</i>
				</div>
			</label>
		</div>
		<div>
			<label>
				<div style="width: 30px; float: left;">
					<input type="radio" name="tolstoycomments_binding" value="1" <?php echo $value == 1 ? 'checked="checked"':'';?> />
				</div>
				<div style="margin-left: 30px;">
					<?php echo __('by Identity as post ID', 'tolstoycomments');?><br/>
					<?php echo __('example:', 'tolstoycomments');?> <i>123</i>
				</div>
			</label>
		</div>
		<div>
			<label>
				<div style="width: 30px; float: left;">
					<input type="radio" name="tolstoycomments_binding" value="2" <?php echo $value == 2 ? 'checked="checked"':'';?> />
				</div>
				<div style="margin-left: 30px;">
					<?php echo __('by Identity as short link', 'tolstoycomments');?><br/>
					<?php echo __('example:', 'tolstoycomments');?> <i><?php echo get_site_url()?>/?p=123</i>
				</div>
			</label>
		</div>
		<div>
			<label>
				<div style="width: 30px; float: left;">
					<input type="radio" name="tolstoycomments_binding" value="3" <?php echo $value == 3 ? 'checked="checked"':'';?> />
				</div>
				<div style="margin-left: 30px;">
					<?php echo __('by Identity as full link', 'tolstoycomments');?><br/>
					<?php echo __('example:', 'tolstoycomments');?> <i><?php echo get_site_url()?>/your_url_post</i>
				</div>
			</label>
		</div>
		<?php
	}

	public function key($value)
	{
		?>
		<div>
			<?php echo __('4. Generate the API access key in the Management section of the Tolstoy Comments administration panel', 'tolstoycomments');?>
		</div>
		<div>
			<?php echo __('ATTENTION! Import/export of comments as well as indexation won\'t won\'t work without the API access key.', 'tolstoycomments');?>
		</div>
		<div>
			<input type="text" class="regular-text" name="tolstoycomments_key" value="<?php echo $value;?>" />
		</div>
		<?php
	}

	public function export($value)
    {
	    ?>
		<div>
			<input type="checkbox" name="tolstoycomments_export" value="1" <?php echo $value ? 'checked' : '';?> /> <?php echo __('5. Enable the "Export" checkbox if you would like to transfer all the comments into WordPress database after the plugin removal.', 'tolstoycomments');?>
		</div>
	    <?php
    }
	
	public function import($value)
    {
	    ?>
		<div>
			<input type="checkbox" name="tolstoycomments_import" value="1" <?php echo $value ? 'checked' : '';?> /> <?php echo __('6. Enable the "Import" checkbox to transfer the comments from WordPress to the widget. Select Wordpress in the Comments Import section of the Tolstoy Comments administration panel. Provide a link to your site and import comments.', 'tolstoycomments');?>
		</div>
	    <?php
    }

	public function index($value)
	{
		?>
		<div>
			<input type="checkbox" name="tolstoycomments_index" value="1" <?php echo $value ? 'checked' : '';?> /> <?php echo __('7. Turn on indexation to make the search engines index the comments.', 'tolstoycomments');?>
		</div>
		<?php
	}

	/**
	 * @param string $name
	 *
	 * @return mixed|void|null
	 */
	private function getField(string $name)
	{
		$value = get_option("tolstoycomments_$name");

		return $value ? $value : null;
	}
}