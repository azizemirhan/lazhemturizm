<?php
/**
 * Template Name: Satış Sözleşmesi Tasarımı
 *
 * @package nextcore
 */

get_header();

if ( have_posts() ) {
	the_post();
}

$defaults = lazhem_sales_defaults();
$k = static function ( $key ) use ( $defaults ) {
	return lazhem_sales( $key, $defaults[ $key ] ?? '' );
};
?>

<main class="kvkk-page sales-page">
	<section class="kvkk-hero">
		<div class="kvkk-hero__inner">
			<nav class="kvkk-breadcrumb" aria-label="<?php esc_attr_e( 'İçerik konumu', 'nextcore' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Anasayfa', 'nextcore' ); ?></a>
				<span class="kvkk-breadcrumb__sep">/</span>
				<span><?php the_title(); ?></span>
			</nav>
			<span class="eyebrow kvkk-hero__eyebrow"><?php echo esc_html( $k( 'sales_hero_eyebrow' ) ); ?></span>
			<h1 class="kvkk-hero__title">
				<?php echo wp_kses_post( $k( 'sales_hero_title' ) ); ?>
			</h1>
		</div>
        <div class="kvkk-hero__pattern" style="background-position: left bottom; opacity: 0.15;"></div>
	</section>

	<section class="kvkk-layout">
		<div class="kvkk-layout__inner">
            <aside class="kvkk-sidebar">
                <div class="kvkk-sidebar__sticky">
                    <div class="kvkk-index">
                        <span class="kvkk-index__title"><?php esc_html_e( 'Sözleşme Maddeleri', 'nextcore' ); ?></span>
                        <ul class="kvkk-index__list" id="kvkkIndexList">
                            <!-- JS will populate this from H2 tags -->
                        </ul>
                    </div>
                    
                    <div class="kvkk-actions">
                        <button type="button" class="kvkk-action-btn" onclick="window.print()">
                            <i class="fas fa-file-pdf"></i>
                            <span><?php esc_html_e( 'PDF / Yazdır', 'nextcore' ); ?></span>
                        </button>
                        <button type="button" class="kvkk-action-btn" onclick="copyToClipboard()">
                            <i class="fas fa-link"></i>
                            <span><?php esc_html_e( 'Bağlantı Al', 'nextcore' ); ?></span>
                        </button>
                    </div>

                    <div class="kvkk-badge" style="background: var(--forest-soft, #1b3a28);">
                        <div class="kvkk-badge__icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <div class="kvkk-badge__text">
                            <strong><?php esc_html_e( 'Resmi Sözleşme', 'nextcore' ); ?></strong>
                            <span><?php esc_html_e( 'Güvenli Alışveriş', 'nextcore' ); ?></span>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="kvkk-main">
                <div class="kvkk-meta">
                    <span class="kvkk-meta__updated">
                        <i class="fas fa-clock"></i>
                        <?php printf( esc_html__( 'Yürürlük: %s', 'nextcore' ), esc_html( $k( 'sales_last_updated' ) ) ); ?>
                    </span>
                    <span class="kvkk-meta__id"><?php esc_html_e( 'ID: LZM-MSS-V1', 'nextcore' ); ?></span>
                </div>
                
                <div class="kvkk-text-block" id="kvkkContentBody">
                    <?php echo wp_kses_post( wpautop( $k( 'sales_content' ) ) ); ?>
                </div>

                <div class="kvkk-doc-footer">
                    <div class="kvkk-signature">
                        <div class="kvkk-signature__line"></div>
                        <span class="kvkk-signature__name"><?php echo esc_html( lazhem_nc( 'footer_bottom_copy', 'Lazhem Turizm' ) ); ?></span>
                        <span class="kvkk-signature__title"><?php esc_html_e( 'Hukuki Onay', 'nextcore' ); ?></span>
                    </div>
                    <div class="kvkk-contact-mini">
                        <p><?php esc_html_e( 'Satış sorularınız için:', 'nextcore' ); ?></p>
                        <a href="mailto:<?php echo esc_attr( lazhem_nc( 'footer_email', 'bilgi@lazhem.com' ) ); ?>">
                            <?php echo esc_html( lazhem_nc( 'footer_email', 'bilgi@lazhem.com' ) ); ?>
                        </a>
                    </div>
                </div>
            </div>
		</div>
	</section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const content = document.getElementById('kvkkContentBody');
    const indexList = document.getElementById('kvkkIndexList');
    const headings = content.querySelectorAll('h2');
    
    headings.forEach((heading, index) => {
        const id = 'sales-' + (index + 1);
        heading.setAttribute('id', id);
        
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.href = '#' + id;
        a.textContent = heading.textContent;
        a.className = 'kvkk-index__link';
        
        li.appendChild(a);
        indexList.appendChild(li);
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                document.querySelectorAll('.kvkk-index__link').forEach(link => {
                    link.classList.toggle('is-active', link.getAttribute('href') === '#' + entry.target.id);
                });
            }
        });
    }, { threshold: 0.5 });

    headings.forEach(heading => observer.observe(heading));
});

function copyToClipboard() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        alert('Sayfa bağlantısı kopyalandı!');
    });
}
</script>

<style>
.kvkk-page {
	background: var(--paper, #fdfcf8);
	color: var(--ink, #1a1a1a);
	line-height: 1.7;
    position: relative;
    overflow-x: hidden;
}

.kvkk-page em {
	font-style: italic;
	color: var(--sage, #2d5a3d);
    font-variation-settings: "opsz" 144, "SOFT" 80;
}

/* Hero Section */
.kvkk-hero {
	background: var(--paper);
	padding: clamp(120px, 15vw, 180px) 0 clamp(60px, 8vw, 100px);
	text-align: center;
    position: relative;
    z-index: 1;
}

.kvkk-hero__inner {
	max-width: var(--container, 1200px);
	margin: 0 auto;
	padding: 0 var(--gutter, 20px);
    position: relative;
    z-index: 2;
}

.kvkk-hero__pattern {
    position: absolute;
    inset: 0;
    background-image: var(--topo);
    background-size: 800px;
    background-position: center;
    opacity: 0.4;
    mask-image: linear-gradient(to bottom, black, transparent);
    -webkit-mask-image: linear-gradient(to bottom, black, transparent);
}

.kvkk-breadcrumb {
	font-family: var(--font-body);
	font-size: 0.8rem;
	opacity: 0.5;
	margin-bottom: 2rem;
    letter-spacing: 0.02em;
}

.kvkk-breadcrumb a {
	color: inherit;
	text-decoration: none;
	border-bottom: 1px solid transparent;
	transition: all 0.2s;
}

.kvkk-breadcrumb a:hover {
	color: var(--gold-deep);
    border-bottom-color: var(--gold-deep);
}

.kvkk-breadcrumb__sep {
	margin: 0 0.6rem;
    opacity: 0.4;
}

.kvkk-hero__eyebrow {
	display: block;
	font-family: var(--font-body);
	font-size: 0.7rem;
	font-weight: 700;
	letter-spacing: 0.25em;
	text-transform: uppercase;
	color: var(--gold-deep);
	margin-bottom: 1.25rem;
}

.kvkk-hero__title {
	font-family: var(--font-display, serif);
	font-size: clamp(2.8rem, 6vw, 4.5rem);
	color: var(--forest, #0d2c20);
	line-height: 1;
    letter-spacing: -0.03em;
	margin: 0;
}

/* Layout */
.kvkk-layout {
    padding-bottom: 140px;
    position: relative;
    z-index: 2;
}

.kvkk-layout__inner {
    max-width: var(--container, 1200px);
    margin: 0 auto;
    padding: 0 var(--gutter, 20px);
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 80px;
}

/* Sidebar */
.kvkk-sidebar__sticky {
    position: sticky;
    top: 120px;
}

.kvkk-index {
    background: #fff;
    padding: 30px;
    border-radius: 4px;
    border: 1px solid rgba(15, 42, 29, 0.06);
    box-shadow: 0 20px 40px rgba(15, 42, 29, 0.03);
    margin-bottom: 30px;
}

.kvkk-index__title {
    display: block;
    font-family: var(--font-body);
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--ink-mute);
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid rgba(15, 42, 29, 0.08);
}

.kvkk-index__list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.kvkk-index__link {
    display: block;
    padding: 8px 0;
    font-size: 0.9rem;
    color: var(--ink);
    opacity: 0.7;
    transition: all 0.25s var(--ease);
    text-decoration: none;
}

.kvkk-index__link:hover {
    color: var(--gold-deep);
    opacity: 1;
    transform: translateX(4px);
}

.kvkk-index__link.is-active {
    color: var(--forest);
    opacity: 1;
    font-weight: 600;
}

.kvkk-actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 30px;
}

.kvkk-action-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 20px;
    background: #fff;
    border: 1px solid rgba(15, 42, 29, 0.08);
    border-radius: 4px;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--forest);
    transition: all 0.3s var(--ease);
}

.kvkk-action-btn:hover {
    background: var(--forest);
    color: var(--paper);
    border-color: var(--forest);
    transform: translateY(-2px);
}

.kvkk-badge {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: var(--forest-deep);
    color: var(--paper);
    border-radius: 4px;
}

.kvkk-badge__icon {
    font-size: 1.5rem;
    color: var(--gold-light);
}

.kvkk-badge__text strong {
    display: block;
    font-size: 0.85rem;
    letter-spacing: 0.02em;
}

.kvkk-badge__text span {
    font-size: 0.75rem;
    opacity: 0.7;
}

/* Main Content */
.kvkk-main {
    background: #fff;
    padding: 60px 80px;
    border-radius: 4px;
    border: 1px solid rgba(15, 42, 29, 0.06);
    box-shadow: 0 40px 100px rgba(15, 42, 29, 0.04);
}

.kvkk-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 50px;
    padding-bottom: 25px;
    border-bottom: 1px solid rgba(15, 42, 29, 0.08);
}

.kvkk-meta__updated {
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--sage);
    display: flex;
    align-items: center;
    gap: 8px;
}

.kvkk-meta__id {
    font-size: 0.75rem;
    font-family: monospace;
    opacity: 0.4;
}

.kvkk-text-block h2 {
	font-family: var(--font-display);
	font-size: 2rem;
	color: var(--forest);
	margin: 3.5rem 0 1.5rem;
    line-height: 1.2;
}

.kvkk-text-block h2:first-child {
    margin-top: 0;
}

.kvkk-text-block h3 {
	font-family: var(--font-display);
	font-size: 1.4rem;
	color: var(--forest);
	margin: 2.5rem 0 1rem;
}

.kvkk-text-block p {
	margin-bottom: 1.75rem;
	font-size: 1.1rem;
	color: var(--ink-soft);
    opacity: 0.9;
}

.kvkk-text-block ul, .kvkk-text-block ol {
	margin-bottom: 2rem;
	padding-left: 1.5rem;
}

.kvkk-text-block li {
	margin-bottom: 0.75rem;
    color: var(--ink-soft);
}

.kvkk-doc-footer {
    margin-top: 80px;
    padding-top: 50px;
    border-top: 2px solid var(--paper);
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}

.kvkk-signature {
    max-width: 200px;
}

.kvkk-signature__line {
    height: 1px;
    background: var(--ink);
    opacity: 0.2;
    margin-bottom: 15px;
}

.kvkk-signature__name {
    display: block;
    font-family: var(--font-display);
    font-size: 1.2rem;
    color: var(--forest);
}

.kvkk-signature__title {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    opacity: 0.6;
}

.kvkk-contact-mini {
    text-align: right;
    font-size: 0.85rem;
}

.kvkk-contact-mini p {
    margin-bottom: 5px;
    opacity: 0.6;
}

.kvkk-contact-mini a {
    color: var(--gold-deep);
    font-weight: 700;
    text-decoration: underline;
}

/* Printing */
@media print {
    .kvkk-hero, .kvkk-sidebar, .kvkk-breadcrumb, .kvkk-footer, .kvkk-actions {
        display: none !important;
    }
    .kvkk-main {
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
    }
    .kvkk-page {
        background: #fff !important;
    }
}

/* Responsive */
@media (max-width: 1100px) {
    .kvkk-layout__inner {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    .kvkk-sidebar {
        display: none; /* Hide sidebar on mobile for cleaner look, or move to top */
    }
    .kvkk-main {
        padding: 40px;
    }
}

@media (max-width: 768px) {
    .kvkk-main {
        padding: 30px 20px;
    }
    .kvkk-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
}

/* Sales Specific Overrides */
.sales-page em {
    color: var(--sage);
}

.sales-page .kvkk-badge {
    background: var(--forest-soft);
}

.sales-page .kvkk-index__link.is-active {
    color: var(--sage);
}
</style>

<?php
get_footer();
