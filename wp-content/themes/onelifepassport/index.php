<?php
get_header();
?>

<div class="container">
	<div class="bodycontent">
		<div class="row">

			<div class="col-sm-12 page-content">
<?php if (have_posts() ) : ?>

	<!-- pagination here -->

	<!-- the loop -->
	<?php while ( have_posts() ) : the_post(); ?>
		<h2><?php the_title(); ?></h2>
		<?php the_content();?>
	<?php endwhile; ?>
	<!-- end of the loop -->

	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
</div></div></div>
<?php get_footer();?>