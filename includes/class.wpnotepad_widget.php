<?php


namespace RWC\WPNotepad;

require_once( 'plugin.php' );

use RWC\WPNotepad\PLUGIN as PLUGIN;

class WPNotepad_Widget extends \WP_Widget {

	/**
	 * WordPress でウィジェットを登録
	 */
	function __construct() {
        
		parent::__construct(
			'wpnotepad', // Base ID
			__( 'Notepad', PLUGIN::TEXTDOMAIN ), // Name
			array( 'description' => __( 'Set up a notepad to save in the browser.', PLUGIN::TEXTDOMAIN ) ) // Args
		);

		add_action( 'wp_enqueue_scripts', array( $this, 'wpnotepad_wp_enqueue_scripts' ) );
	}

	/**
	 * ウィジェットのフロントエンド表示
	 *
	 * @param array $args ウィジェットの引数
	 * @param array $instance データベースの保存値
	 *
	 * @see WP_Widget::widget()
	 *
	 */
	public function widget( $args, $instance ) {

		$description = '';
		$textarea    = '';

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		if ( ! empty( $instance['description'] ) ) {
			$description = '<p class="description">' . nl2br( $instance['description'] ) . '</p>';
		}
		echo apply_filters( 'wpnotepad_widget_description', $description );

		$textarea = sprintf( '<textarea id="%s-textarea"></textarea>', $args['widget_id'] );
		echo apply_filters( 'wpnotepad_widget_textarea', $textarea );

		echo $args['after_widget'];
	}

	function wpnotepad_wp_enqueue_scripts() {

//        wp_enqueue_style('wpnotepad-style', plugins_url() . '/' . PLUGIN::PLUGIN_DIR . '/assets/css/wpnotepad.css');
		wp_enqueue_script( 'wpnotepad-script', plugins_url() . '/' . PLUGIN::PLUGIN_DIR . '/assets/js/wpnotepad.js', array( 'jquery' ) );
	}


	/**
	 * バックエンドのウィジェットフォーム
	 *
	 * @param array $instance データベースからの前回保存された値
	 *
	 * @see WP_Widget::form()
	 *
	 */
	public function form( $instance ) {

		$title       = '';
		$placeholder = '';
		if ( empty( $instance['title'] ) ) {
			$placeholder = __( 'New title', PLUGIN::TEXTDOMAIN );
		} else {
			$title = $instance['title'];
		}
		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', PLUGIN::TEXTDOMAIN ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
                   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>">

            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:', PLUGIN::TEXTDOMAIN ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>"
                      name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_attr( $instance['description'] ); ?></textarea>


        </p>
		<?php
	}

	/**
	 * ウィジェットフォームの値を保存用にサニタイズ
	 *
	 * @param array $new_instance 保存用に送信された値
	 * @param array $old_instance データベースからの以前保存された値
	 *
	 * @return array 保存される更新された安全な値
	 * @see WP_Widget::update()
	 *
	 */
	public function update( $new_instance, $old_instance ) {

		$instance                = array();
		$instance['title']       = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';

		return $instance;
	}
}

