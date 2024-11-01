<?php

namespace Gtxtymt\Plugins\Tolstoycomments;

/**
 * Class Import
 * @package Gtxtymt\Plugins\Tolstoycomments
 */
class Import
{
	/**
	 * Initialize import process
	 * @return bool|Import
	 */
	public static function init()
	{
		// If not exists in post tolstoycomments and tolstoycomments_site_id and tolstoycomments_key
		if (!(isset($_POST['tolstoycomments']) 
			&& isset($_POST['tolstoycomments_site_id'])
			&& is_numeric($_POST['tolstoycomments_site_id'])
			&& isset($_POST['tolstoycomments_key']))) return;
			
		if ($_POST['tolstoycomments_key'] !== get_option('tolstoycomments_key')) {
			return wp_send_json_error("Please specify the api key in the widget settings from the administration panel");
		}
			
		if (get_option('tolstoycomments_import') !== '1') {
			return wp_send_json_error("Set Enable import in Settings as Allow. Now value is Block");
		}
		
		if (intval($_POST['tolstoycomments_site_id']) !== intval(get_option('tolstoycomments_site_id'))) {
			return wp_send_json_error("Site ID not equal current site id in administration page: "
				.get_option('tolstoycomments_site_id').' != '.intval($_POST['tolstoycomments_site_id']));
		}
	
		self::jsonView();
			
		die;
	}
	
	public static function jsonView(){
		$apiKey = get_option('tolstoycomments_key');
		$siteId = get_option('tolstoycomments_site_id');
		
		$json = array();
		
		$take = 100;
		$comment_last_id = isset($_POST['tolstoycomments_comment_id']) ? intval($_POST['tolstoycomments_comment_id']) : 0;
		
		// $arg = [
			// 'post_status' => 'publish',
			// 'status' => 'approve',
			// 'orderby' => 'ID',
			// 'order' => 'ASC',
			// 'number' => $take
		// ];
		
		global $wpdb;
		
		$query = "SELECT * 
        FROM $wpdb->comments as c
		INNER JOIN $wpdb->posts as p ON p.ID = c.comment_post_ID
        WHERE c.comment_approved = '1' AND p.post_status = 'publish'".
		($comment_last_id ? " AND c.comment_ID < $comment_last_id" : "").
		" ORDER BY c.comment_ID DESC LIMIT $take";
		
		$comments = $wpdb->get_results($query);
		
		foreach ($comments as $comment) {
			$post = get_post($comment->comment_post_ID);
			
			if (isset($post)){
			
				// 2020-04-13T14:15:44+00:00
				// 2004-02-12T15:19:21+00:00
				
				$tolstoycomments_id = get_comment_meta($comment->comment_ID, '_tolstoycomments_id', true);
				
				$json[] = [
					'comment_id' => intval($comment->comment_ID),
					'message' => $comment->comment_content,
					'ip' => $comment->comment_author_IP,
					'dt' => date_format(date_create($comment->comment_date_gmt), 'c'),
					'user' => [
						'name' => $comment->comment_author,
						'email' => $comment->comment_author_email
					],
					'chat' => [
						'url' => get_permalink($post->ID),
						'title' => esc_html($post->post_title),
						'identity' => $post->ID
					],
					'tolstoycomments_id' => intval($tolstoycomments_id)
				];
			}			
		}
		
		wp_send_json_success($json);
		
		//echo $apiKey.'|'.$siteId;
	}
}