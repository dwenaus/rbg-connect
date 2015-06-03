<?php
/**
 * The Template for Single Programs.
 */
global $RS_Connect;
get_header();
$options = get_option('rs_settings');
if(isset($options['rs_template']['before'])) echo $options['rs_template']['before']; ?>

<?php global $rs_the_teacher; ?>

<article class="page type-page status-publish entry hentry single-teacher">
    <header class="entry-header">
        <h1 class="rs-program-title"><?php echo $rs_the_teacher->name; ?></h1>
    </header>

    <div class="entry-content">
        <?php // Program Details ?>
        <div class="rs-program-content" style="padding:20px;">
            <?php if(isset($rs_the_teacher->photo_details->medium)) : ?>
                <img src="<?php echo $rs_the_teacher->photo_details->medium->url; ?>" class="alignleft" style="padding:0 20px 20px 0px;">
            <?php endif; ?>

            <?php if ( $rs_the_teacher->text ) : ?>
                <div class="rs-program-custom-wrap"><?php echo $rs_the_teacher->text; ?></div>
            <?php endif; ?>
        </div>
        <div class="rs-program-teachers" style="clear: left; margin:20px;">
            <?php if( ! empty($rs_the_teacher->programs)) : ?>
                <h3 style="margin-top: 30px;">Programs by <?php echo $rs_the_teacher->name; ?></h3>

                <?php foreach($rs_the_teacher->programs as $program) : ?>
                    <div class="program" style="float:left; clear:left;">
                        <a href="/<?php echo $RS_Connect->style; ?>/<?php echo $program->ID; ?>/<?php echo $program->slug; ?>"><img src="<?php echo $program->photo_details->thumbnail->url; ?>" style="float:left; margin:0 15px 15px 0;"></a>
                        <strong><a href="/<?php echo $RS_Connect->style; ?>/<?php echo $program->ID; ?>/<?php echo $program->slug; ?>"><?php echo $program->post_title; ?></a></strong><br/>
                        <?php echo date('F d, Y @ g:h A', $program->start); ?>
                        <p><?php echo wp_trim_words( nl2br($program->post_content), 70, '...' ); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="clearfix"></div>
    </div>

</article>

<?php if(isset($options['rs_template']['after'])) echo $options['rs_template']['after']; ?>

<?php get_footer(); ?>