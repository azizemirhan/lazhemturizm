<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$kvkk_text = Lazhem_Utils::get_option( 'kvkk_text', 'KVKK metnini okudum ve onaylıyorum.' );
?>
<form class="lazhem-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
	<?php wp_nonce_field( 'lazhem_inquiry_submit', 'lazhem_inquiry_nonce' ); ?>
	<input type="hidden" name="action" value="lazhem_inquiry_submit">
	<input type="hidden" name="listing_id" value="<?php echo esc_attr( get_the_ID() ); ?>">

	<div class="lazhem-form__grid">
		<input type="text" name="name" placeholder="Ad Soyad" required>
		<input type="text" name="phone" placeholder="Telefon" required>
		<input type="email" name="email" placeholder="E-posta" required>
		<input type="date" name="checkin" placeholder="Giriş Tarihi">
		<input type="date" name="checkout" placeholder="Çıkış Tarihi">
		<input type="number" name="guest_count" placeholder="Misafir Sayısı" min="1">
		<input type="text" name="variation" placeholder="İlgilenen varyasyon / oda tipi" style="grid-column:1/-1;">
		<textarea name="message" placeholder="Mesajınız" rows="3"></textarea>
	</div>

	<label class="lazhem-form__kvkk">
		<input type="checkbox" name="kvkk" value="1" required>
		<?php echo esc_html( $kvkk_text ); ?>
	</label>

	<button type="submit" class="lazhem-btn lazhem-btn--primary">Teklif / Müsaitlik Gönder</button>
</form>
