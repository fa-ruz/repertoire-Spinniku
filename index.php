<?php get_header(); 
function enqueue_slick_styles() {
    wp_enqueue_style('slick-carousel', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
}
add_action('wp_enqueue_scripts', 'enqueue_slick_styles');

?>

<div id="content-container">
<section class="background-section">
    <!-- Contenu de la section -->
    <div class="content">
        <div class="text">
            <h1>TON CORPS,</h1>
            <h2>ton chemin.</h2>
        </div>
        <div class="image">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/accueil.png" alt="Votre Image">
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <?php
        // Arguments de requête pour récupérer les articles de type 'categories'
        $args = array(
            'post_type' => 'categories',
            'posts_per_page' => 4, // Nombre d'articles à afficher
            'orderby' => 'date', // Ordonne par ID
        );

        $categories_query = new WP_Query($args);

        // Vérifier si la requête a des articles
        if ($categories_query->have_posts()) :
            while ($categories_query->have_posts()) : $categories_query->the_post();
        ?>
                <div class="col-md-6">
                    <div class="card mb-4 rounded-0 bg-black text-white" >
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title(); ?>" class="img-fluid" width="728" height="533">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title" ><?php the_title(); ?></h4>
                            <a href="<?php the_permalink(); ?>" class="btn1 mt-auto align-self-end" id="monBtn">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-flèche.png" alt="flèche" class="img-fluid" alt="icone" style="position:relative; z-index:20; margin:0px;">
                                <span style="margin-left:10px;"></span>
                            </a>
                        </div>
                    </div>
                </div>
        <?php
            endwhile;
            wp_reset_postdata(); // Réinitialiser les données de la requête
        else :
            echo 'Aucun article trouvé.';
        endif;
        ?>
    </div>
</div>

<?php
$args = array(
    'post_type' => 'blockquote',
    'posts_per_page' => 1,
);

$custom_query = new WP_Query($args);

if ($custom_query->have_posts()) :
    while ($custom_query->have_posts()) : $custom_query->the_post();
?>
        <div class="blockquote-container-custom-padding mb-2 position-relative bg-black text-white">
            <!-- Image en haut à gauche -->
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon.png" alt="Image 1" class="image-top-left position-absolute" style="width: 42px; height: 100px; top: 0; left: 0;">

            <!-- Image en bas à droite -->
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon2.png" class="image-bottom-right position-absolute" style="width: 42px; height: 100px; bottom: 0; right: 0;">

            <h2 class="blockquote-title text-center mb-5"><?php the_title(); ?></h2>
            <?php the_content(); ?>
        </div>
        <p class="card-description mt-2"><?php the_excerpt(); ?></p>
<?php
    endwhile;
else :
    // Aucun contenu trouvé
    echo '<p>Aucun contenu trouvé</p>';
endif;


wp_reset_postdata(); // Rétablir les données de publication originales
?>
<div id="resultats-carousel-container" class="mt-5">
<h3>RÉSULTATS</h3>
<p>Des réussites, des changements, des vies transformées.<br>Explorez les témoignages SetForMe et laissez-vous inspirer</p>

<div class="carousel-images">
                <div class="images">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bdc-1.png">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bdc-1.png">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bdc-1.png">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bdc-1.png">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bdc-1.png">
                </div>
            </div>
            <div class="nav-buttons">
                <button class="prev"><</button>
                <button class="next">></button>
            </div>
        </div>
        
      </main>

        <script>
          document.addEventListener("DOMContentLoaded", function () {
    const imagesContainer = document.querySelector(".carousel-images .images");
    const imageWidth = imagesContainer.firstElementChild.clientWidth;
    const totalImages = imagesContainer.childElementCount;
    let currentIndex = 0;

    function updateButtonsState() {
        // Mettez à jour l'état des boutons selon le nouvel algorithme
        prevButton.disabled = currentIndex === 0;
        nextButton.disabled = currentIndex === totalImages - 1;
    }

    nextButton.addEventListener("click", function () {
        if (currentIndex < totalImages - 1) {
            currentIndex++;
            const offset = -currentIndex * imageWidth;
            imagesContainer.style.transform = `translateX(${offset}px)`;
            updateButtonsState();
        }
    });

    prevButton.addEventListener("click", function () {
        if (currentIndex > 0) {
            currentIndex--;
            const offset = -currentIndex * imageWidth;
            imagesContainer.style.transform = `translateX(${offset}px)`;
            updateButtonsState();
        }
    });

    // Mettez à jour l'état des boutons au chargement de la page
    updateButtonsState();
});
</script>

  <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>
<?php get_footer(); ?>

<script>
  jQuery(document).ready(function ($) {
    $('#myCarousel').carousel({
        interval: 5000, // Réglez l'intervalle en millisecondes (facultatif)
        pause: 'hover'
    });

    $('.carousel-control-prev, .carousel-control-next').css('color', 'black');
});

</script>
</div>

