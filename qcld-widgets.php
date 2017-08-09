<?php

/**
 * 1. Adds QcLdLatestPortfolio_Widget widget.
 */
class QcLdLatestPortfolio_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'QcLdLatestPortfolio_Widget',
			esc_html__( 'Portfolio-X : Latest Items', 'portfolio-x' ),
			array( 
				'description' => esc_html__( 'Widget to display the most recent portfolio items from - Portfolio-X.', 'portfolio-x' ),
			)
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$limit = 5;
		$style = 'style-1';

		if ( ! empty( $instance['limit'] ) ) {
			$limit = $instance['limit'];
		}

		if ( ! empty( $instance['widget_style'] ) ) {
			$style = $instance['widget_style'];
		}

		echo qcld_get_latest_portfolio_items_as_widget( $limit, $style );

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Latest Portfolio Items', 'portfolio-x' );
		$limit = ! empty( $instance['limit'] ) ? $instance['limit'] : esc_html__( '5', 'portfolio-x' );
		$widget_style = ! empty( $instance['widget_style'] ) ? $instance['widget_style'] : 'style-1';

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_attr_e( 'Title:', 'portfolio-x' ); ?>
			</label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'widget_style' ) ); ?>">
				<?php esc_attr_e( 'Widget Style:', 'portfolio-x' ); ?>
			</label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'widget_style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_style' ) ); ?>">
				<?php 
					$available_style = array(
						'style-1' => 'Style 1',
						'style-2' => 'Style 2',
					);
				?>
				<?php foreach( $available_style as $key => $val ) : ?>
				<option <?php echo $key == $widget_style ? 'selected="selected"' : ''; ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>">
				<?php esc_attr_e( 'Limit:', 'portfolio-x' ); ?>
			</label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? strip_tags( $new_instance['limit'] ) : '';
		$instance['widget_style'] = ( ! empty( $new_instance['widget_style'] ) ) ? strip_tags( $new_instance['widget_style'] ) : '';

		return $instance;
	}

} // class QcLdLatestPortfolio_Widget


// Register Widgets
function qcld_register_custom_widgets() {
    register_widget( 'QcLdLatestPortfolio_Widget' );
}

add_action( 'widgets_init', 'qcld_register_custom_widgets' );

function qcld_get_latest_portfolio_items_as_widget( $limit, $style )
{

	$item_args = array(
		'post_type' => 'portfolio-x',
		'orderby' => 'date',
		'order' => 'desc',
		'posts_per_page' => $limit,
	);

	$item_query = new WP_Query( $item_args );

	

	if( $item_query->have_posts() )
	{

		ob_start();

		require( PORTFOLIO_THEMES_DIR . '/widgets/' . $style . '/widget-template.php' );

		$content = ob_get_clean();		

	}
	else
	{
		return __('No Portfolio Item was found.', 'protfolio-x');
	}

    return $content;

}