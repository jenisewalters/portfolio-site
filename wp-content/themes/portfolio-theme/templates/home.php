<?php /* Template Name: Home */ ?>
<?php global $post; ?>
<section class="hero">
  <div class="container">
    <div class="hero__text">
      <?php if (have_posts()) :
              while (have_posts()) :
                     the_post();
                        the_content();
              endwhile;
            endif;

            if (get_field('resume_url')) {
                $resume_url = get_field('resume_url');
                ?>
                <a class="btn-primary btn--large resume-button" target="_blank" href="<?php echo $resume_url ?>">Download Resume</a>

            <?php }

                 if (get_field('github_url')) {
                  $github_url = get_field('github_url');
                  ?>
                  <a class="btn-primary btn--large code-button" target="_blank" href="<?php echo $github_url ?>">View Source Code</a>
              <?php
            } ?>
    </div>
  </div>
</section>
<section class="portfolio">
	<div class="container">
		<h2 class="title-border">Portfolio</h2>

  				<?php
            $args = array(
            'post_type' => array('portfolio'),
            'order_by' => 'menu_order',
             'order' => 'ASC'
            );

            $query = new WP_Query($args);

          ?>
          <div class="flexbox-container">


					<?php while ($query->have_posts()) : $query->the_post(); ?>






							<div class="portfolio-tile">
                <?php if (get_field('work_sample_url')) {
                  $work_sample_url = get_field('work_sample_url');
}               ?>
      								<a href ="<?php echo $work_sample_url ?>" target="_blank" class="portfolio-tile__image">
      								  <?php the_post_thumbnail('full', array('class' => 'img-responsive'));?>
      								</a>
                      <div class="portfolio-tile__description">
								      <a class="portfolio-tile__title  title-border" href ="<?php echo $work_sample_url ?>" target="_blank"><?php the_title(); ?></a>
									<div class="portfolio-tile__tags">
										<?php
                        $posttags = get_the_tags();
                        if ($posttags) {
                            foreach ($posttags as $tag) {
                                ?>
												<div class="tags__item"><?php echo $tag->name ?></div>
												<?php

                            }
                            ?>

                      <?php
                        } ?>
								</div>


                  <?php the_content(); ?>

							</div>
            </div>


					<?php endwhile;
                    wp_reset_query(); ?>
      </div>


</div>

</section>
