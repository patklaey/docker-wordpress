<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blossom_Travel
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">


                        <?php
			    if ( cnr_have_children() ) {
                                $i = 0;
                                while ( cnr_have_children() ) {
                                    cnr_next_child(); ?>
				    <a href="<?php the_permalink() ?>" style="text-decoration: underline; color: inherit;"><?php the_title("<h3>","</h3>");  if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium_large' );   }; ?></a>
                                    <?php the_excerpt();
                                    $i++;
                                }
                                $currentPage = ( is_paged() ? get_query_var('paged') : 1 );
                                $page = get_permalink();
                                $olderPosts = $currentPage + 1;
                                $olderPostsLink = $page . "page/" . $olderPosts;

                                if( $i == get_option('posts_per_page') ) {
                                    echo("<a href=\"" . $olderPostsLink . "\"> < Older Posts</a>");
                                }

                                if( $currentPage != 1 ) {
                                    $newerPosts = $currentPage - 1;
                                    $newerPostsLink =  $page . "page/" . $newerPosts;
                                    echo("<br/><a href=\"" . $newerPostsLink . "\">Newer Posts ></a>");
                                }
                            } else {
                                ?> <h4 style="text-align: center;">No posts in this section yet</h4> <?php
                            }

		        ?>

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				/**
                 * Comment Template
                 * 
                 * @hooked blossom_travel_comment
                */
                do_action( 'blossom_travel_after_page_content' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
