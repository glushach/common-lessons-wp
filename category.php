<?php
/**
 * The template for displaying Category pages
 *
 * Used to display archive-type pages for posts in a category.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">
		
		<?php 
			// номер рубрики
			$category_id = get_query_var('cat');
			// данные о текущей категории
			$category = get_category($category_id);
			// номер текущей страницы
			$page = get_query_var('paged');
			// данные о дочерних рубриках
			$children_categories = get_categories("parent={$category_id}");
			
			if ($category->description  && !$page) :
				?>
					<div class="post-main">
						<h1><?php echo $category->name; ?></h1>
						<div class="post">
							<?php do_shortcode($category->description) ;?>
						</div>
					</div>
					<hr/><br/>
				<?php
			endif;

			if($children_categories) :
				foreach($children_categories as $children_category) :
					$link = get_category_link($children_category->cat_ID);
					?>
					<div class="post-main">
						<h1><a href="<?php echo $link; ?>"><?php echo $children_category->name; ?></a></h1>
						<div class="post">
							<?php 
							if ($children_category->description) :
								do_shortcode($children_category->description);
							else:
								echo '<p>Описание по умолчанию</p>';
							endif;
							?>
						</div>
					</div>
					<?php
				endforeach;
			else: //иначе выводим записи;
		?>
		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title">
				<?php
				/* translators: %s: Category title. */
				printf( __( 'Category Archives: %s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' );
				?>
				</h1>
			</header><!-- .archive-header -->

			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the post format-specific template for the content. If you want
				 * to use this in a child theme then include a file called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;

			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; 
		endif // конец условия $children_categories;
		?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
