<?php
/**
 * TG: Featured Posts (Style 1) widget.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * TG: Featured Posts (Style 1) widget.
 *
 * Class colormag_featured_posts_widget
 */
class colormag_featured_posts_widget extends ColorMag_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass    = 'widget_featured_posts widget_featured_meta';
		$this->widget_description = esc_html__( 'Display latest posts or posts of specific category.', 'colormag' );
		$this->widget_name        = esc_html__( 'TG: Featured Posts (Style 1)', 'colormag' );
		$this->settings           = array(
			'widget_layout' => array(
				'type'      => 'custom',
				'default'   => '',
				'label'     => esc_html__( 'Layout will be as below:', 'colormag' ),
				'image_url' => get_template_directory_uri() . '/img/style-1.jpg',
			),
			'title'         => array(
				'type'    => 'text',
				'default' => '',
				'label'   => esc_html__( 'Title:', 'colormag' ),
			),
			'text'          => array(
				'type'    => 'textarea',
				'default' => '',
				'label'   => esc_html__( 'Description', 'colormag' ),
			),
			'number'        => array(
				'type'    => 'number',
				'default' => 4,
				'label'   => esc_html__( 'Number of posts to display:', 'colormag' ),
			),
			'type'          => array(
				'type'    => 'radio',
				'default' => 'latest',
				'label'   => '',
				'choices' => array(
					'latest'   => esc_html__( 'Show latest Posts', 'colormag' ),
					'category' => esc_html__( 'Show posts from a category', 'colormag' ),
				),
			),
			'category'      => array(
				'type'    => 'dropdown_categories',
				'default' => '',
				'label'   => esc_html__( 'Select category', 'colormag' ),
			),
		);

		parent::__construct();

	}

	/**
	 * Output widget.
	 *
	 * @param array $args     Arguments.
	 * @param array $instance Widget instance.
	 *
	 * @see WP_Widget
	 */
	public function widget( $args, $instance ) {

		global $post;
		$title    = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text     = isset( $instance['text'] ) ? $instance['text'] : '';
		$number   = empty( $instance['number'] ) ? 4 : $instance['number'];
		$type     = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category = isset( $instance['category'] ) ? $instance['category'] : '';

		$post_status = 'publish';
		if ( 1 == get_option( 'fresh_site' ) ) {
			$post_status = array( 'auto-draft', 'publish' );
		}

		$query_args = array(
			'posts_per_page'      => $number,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
			'post_status'         => $post_status,
		);

		// Display from category chosen.
		if ( 'category' == $type ) {
			$query_args['category__in'] = $category;
		}

		$get_featured_posts = new WP_Query( $query_args );

		$this->widget_start( $args );
		?>
		<?php
		$border_color = '';
		$title_color  = '';
		if ( 'latest' != $type ) {
			$border_color = 'style="border-bottom-color:' . colormag_category_color( $category ) . ';"';
			$title_color  = 'style="background-color:' . colormag_category_color( $category ) . ';"';
		}

		// Display the title.
		if ( ! empty( $title ) ) {
			echo '<h3 class="widget-title" ' . $border_color . '><span ' . $title_color . '>' . esc_html( $title ) . '</span></h3>'; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
		}

		// Display the description.
		if ( ! empty( $text ) ) {
			?>
			<p><?php echo wp_kses_post( $text ); ?></p>
			<?php
		}

		$i = 1;
		while ( $get_featured_posts->have_posts() ) :
			$get_featured_posts->the_post();

			if ( 1 == $i ) {
				$featured = 'colormag-featured-post-medium';
			} else {
				$featured = 'colormag-featured-post-small';
			}

			if ( 1 == $i ) {
				echo '<div class="first-post">';
			} elseif ( 2 == $i ) {
				echo '<div class="following-post">';
			}
			?>

			<div class="single-article clearfix">
				<?php
				if ( has_post_thumbnail() ) {
					$this->the_post_thumbnail( $post->ID, $featured );
				}
				?>

				<div class="article-content">
					<?php
					colormag_colored_category();

					// Displays the post title.
					$this->the_title();

					// Displays the post meta.
					$this->entry_meta();
					?>

					<?php if ( 1 == $i ) { ?>
						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div>
					<?php } ?>
				</div>

			</div>
			<?php
			if ( 1 == $i ) {
				echo '</div>';
			}
			$i ++;
		endwhile;
		if ( $i > 2 ) {
			echo '</div>';
		}

		// Reset Post Data.
		wp_reset_postdata();

		$this->widget_end( $args );

	}

}
