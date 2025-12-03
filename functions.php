<?php
function inspiro_child_enqueue_styles() {
    wp_enqueue_style( 'inspiro-parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'inspiro_child_enqueue_styles' );



//////// LISTE DES PDF//////////
function liste_documents_shortcode() {

    ob_start();

    $args = array(
        'post_type'      => 'document',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC'
    );

    $documents = new WP_Query($args);

    if ( $documents->have_posts() ) : ?>

        <div class="articles-grid">
            <ul class="articles-list">

                <?php while ( $documents->have_posts() ) : $documents->the_post(); ?>

                    <?php $pdf = get_field('fichier_pdf'); ?>
                    <?php $auteur = get_field('auteur'); ?>

                    <li class="item-document">
                        <h3 class="document-titre">
                            <a href="<?php echo esc_url($pdf); ?>" target="_blank">
                                <?php the_title(); ?>
                            </a>
                        </h3>

                        <?php if ($auteur) : ?>
                            <p class="document-auteur"><strong>Auteur :</strong> <?php echo $auteur; ?></p>
                        <?php endif; ?>
                    </li>

                <?php endwhile; ?>

            </ul>
        </div>

        <?php wp_reset_postdata();

    else :
        echo '<p>Aucun document disponible pour le moment.</p>';
    endif;

    return ob_get_clean();
}
add_shortcode('liste_documents', 'liste_documents_shortcode');


// ===== Shortcode Documents Techniques ===== //
function liste_documents_techniques_shortcode() {

    ob_start();

    $args = array(
        'post_type'      => 'document_technique',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC'
    );

    $docs = new WP_Query($args);

    if ( $docs->have_posts() ) : ?>

        <div class="articles-grid">
            <ul class="articles-list">

                <?php while ( $docs->have_posts() ) : $docs->the_post(); ?>

                    <?php 
                        $fichier = get_field('document_technique');  
                        $auteur = get_field('auteur');  
                        $date_doc = get_field('date');  
                    ?>

                    <li class="item-document">

                        <h3 class="document-titre">

                            <?php if ($fichier) : ?>
                                <a href="<?php echo esc_url($fichier); ?>" target="_blank">
                                    <?php the_title(); ?>
                                </a>
                            <?php else : ?>
                                <?php the_title(); ?>
                            <?php endif; ?>

                        </h3>

                        <?php if ($auteur) : ?>
                            <p class="document-auteur"><strong>Auteur :</strong> 
                                <?php echo esc_html($auteur); ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($date_doc) : ?>
                            <p class="document-annee"><strong>Date :</strong> 
                                <?php echo esc_html($date_doc); ?>
                            </p>
                        <?php endif; ?>

                    </li>

                <?php endwhile; ?>

            </ul>
        </div>

        <?php wp_reset_postdata();

    else :
        echo '<p>Aucun document technique disponible pour le moment.</p>';
    endif;

    return ob_get_clean();
}
add_shortcode('documents_techniques', 'liste_documents_techniques_shortcode');



// ===== Shortcode Bibliographie ===== //
function shortcode_bibliographie() {

    $args = array(
        'post_type'      => 'bibliographie',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC'
    );

    $livres = new WP_Query($args);

    ob_start();

    if ( $livres->have_posts() ) : ?>

        <div class="bibliographie-grid">
            <?php while ( $livres->have_posts() ) : $livres->the_post(); ?>

                <div class="livre-item">

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="livre-image-wrapper">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                    <?php endif; ?>

                    <h3 class="livre-titre"><?php the_title(); ?></h3>

                    <?php if ($auteur = get_field('auteur')) : ?>
                        <p class="livre-auteur"><strong>Auteur :</strong> <?php echo esc_html($auteur); ?></p>
                    <?php endif; ?>

                    <?php if ($annee = get_field('annee')) : ?>
                        <p class="livre-annee"><strong>Année :</strong> <?php echo esc_html($annee); ?></p>
                    <?php endif; ?>

                    <?php if ($description = get_field('description')) : ?>
                        <p class="livre-description"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>

                </div>

            <?php endwhile; ?>
        </div>

        <?php wp_reset_postdata(); ?>

    <?php endif;

    return ob_get_clean();
}
add_shortcode('bibliographie', 'shortcode_bibliographie');

// Shortcode pour afficher la liste des podcasts
function liste_podcasts_shortcode() {
    ob_start();

    $args = array(
        'post_type'      => 'podcast',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC'
    );

    $podcasts = new WP_Query($args);

    if ( $podcasts->have_posts() ) : ?>

        <div class="articles-grid">
            <ul class="articles-list">

                <?php while ( $podcasts->have_posts() ) : $podcasts->the_post(); ?>

                    <?php 
                    $podcast_url = get_field('podcast_url'); 
                    $description = get_field('description'); 
                    $annee       = get_field('annee'); 
                    ?>

                    <li class="item-document">
                        <h3 class="document-titre">
                            <?php if ($podcast_url) : ?>
                                <a href="<?php echo esc_url($podcast_url); ?>" target="_blank">
                                    <?php the_title(); ?>
                                </a>
                            <?php else : ?>
                                <?php the_title(); ?>
                            <?php endif; ?>
                        </h3>

                        <?php if ($description) : ?>
                            <p class="document-description"><?php echo esc_html($description); ?></p>
                        <?php endif; ?>

                        <?php if ($annee) : ?>
                            <p class="document-annee"><strong>Année :</strong> <?php echo esc_html($annee); ?></p>
                        <?php endif; ?>
                    </li>

                <?php endwhile; ?>

            </ul>
        </div>

        <?php wp_reset_postdata();

    else :
        echo '<p>Aucun podcast disponible pour le moment.</p>';
    endif;

    return ob_get_clean();
}
add_shortcode('liste_podcasts', 'liste_podcasts_shortcode');



