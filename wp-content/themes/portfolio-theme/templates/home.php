<?php /* Template Name: Home */ ?>
<?php global $post; ?>
<section class="hero">
  <div class="container">
    <div class="hero__text">
      <?php  if (have_posts()) :
              while (have_posts()) :
                 the_post();
                    the_content();
              endwhile;
            endif;
      ?>
    </div>
  </div>
</section>
<section class="portfolio">
	<div class="container">
		<h2 class="title-border">Portfolio</h2>
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
                <?php if (get_field('work_sample_url')) {
                   $work_sample_url = get_field('work_sample_url');
									} ?>
  								<a href ="<?php echo $work_sample_url ?>" target="_blank" class="portfolio-tile__image">
  								  <?php the_post_thumbnail('full', array('class' => 'img-responsive'));?>
  								</a>
								<a class="portfolio-tile__title title-border" href ="<?php echo $work_sample_url ?>" target="_blank"><?php the_title(); ?></a>
									<div class="portfolio-tile__tags">
										<?php
                      $posttags = get_the_tags();
                      if ($posttags) {
                      foreach ($posttags as $tag) {
                    ?>
														<div class="tags__item"><?php echo $tag->name ?></div>
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
