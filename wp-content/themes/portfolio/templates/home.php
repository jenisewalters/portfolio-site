<?php /* Template Name: Home */ ?>
<?php global $post; ?>
<section class="hero">
  <div class="container">
    <div class="hero__text">
     <?php
            echo $post->post_content ?>
    </div>
  </div>
</section>
<section class="portfolio bg--blue">
	<div class="container">
		<h2>Portfolio</h2>
		  <div class="row">
				<?php
                    $args = array(
                    'post_type' => array('portfolio'),
                    );

                       $query = new WP_Query($args);

                    ?>
					<?php while ($query->have_posts()) : $query->the_post(); ?>
						<div class="col-md-6">
							<div class="portfolio-tile">
								<div class="portfolio-tile__title"><?php the_title(); ?></div>
  								<a class="portfolio-tile__image">
  								  <?php the_post_thumbnail('full', array('class' => 'img-responsive'));?>
  								</a>
								<?php if (get_field('work_sample_url')) { ?>
									<a href="<?php the_field('work_sample_url');
    ?>" target="_blank"  class="btn-primary portfolio-tile__button">View Website</a>
									<?php } ?>
									<div class="portfolio-tile__tags">
										<?php
                                                $posttags = get_the_tags();
                                                if ($posttags) {
                                                    foreach ($posttags as $tag) {
                                                        ?>
														<label class="btn-label"><?php echo $tag->name ?></label>
												<?php
                                                    }
                                                }
                                         ?>
								</div>
							</div>
						</div>
					<?php endwhile;
                    wp_reset_query(); ?>
		  </div>
  </div>
</section>
