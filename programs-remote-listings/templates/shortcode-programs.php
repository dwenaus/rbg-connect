<?php
global $rs_the_programs;
global $shortcode_atts;
global $RS_Connect;
if(is_array($shortcode_atts)) extract($shortcode_atts);
if(! empty($rs_the_programs)) {

    foreach($rs_the_programs as $program): ?>

        <div class="rs-program rs-group">

            <?php if ( $program->photo_details && ! isset($hide_photo) ) : ?>
                <div class="rs-program-thumbnail"><a href="/<?php echo $RS_Connect->style; ?>/<?php echo $program->ID; ?>/<?php echo $program->slug; ?>"><img src="<?php echo $program->photo_details->thumbnail->url; ?>"></a></div>
            <?php endif; ?>

            <?php if ( $program->title && ! isset($hide_title) ) : ?>
                <h2 class="rs-program-title"><a href="/<?php echo $RS_Connect->style; ?>/<?php echo $program->ID; ?>/<?php echo $program->slug; ?>"><?php echo $program->title; ?></a></h2>
            <?php endif; ?>

            <?php if ( $program->date && ! isset($hide_date) ) : ?>
                <div class="rs-program-date"><?php echo $program->date; ?></div>
            <?php endif; ?>

            <?php if ( $program->location && ! isset($hide_location) ) : ?>
                <div class="rs-program-location"><?php echo $program->location; ?></div>
            <?php endif; ?>

            <?php if ( $program->text && ! isset($hide_text) ) : ?>
                <div class="rs-program-excerpt"><?php echo wp_trim_words($program->text, 100); ?></div>
            <?php endif; ?>

            <?php if ( isset($show_register_link) ) : ?>
                <?php if ($program->registration_bookable): ?>
                    <a href="<?php echo $program->registration_link; ?>" target="_blank">Register Now</a>
                <?php else: ?>
                    <?php if(empty($program->registration_action)) { echo "Closed"; } else { echo $program->registration_action; } ?>
                <?php endif; ?>
            <?php endif; ?>

        </div>

    <?php endforeach; } else { echo 'Sorry, no programs exist here.'; }?>