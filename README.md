# Lazhem Turizm

Lazhem Turizm, WordPress tabanli bir turizm ilan ve lead toplama projesidir.
Bu repoda hem tema tarafi hem de ozel eklenti tarafi birlikte gelistirilmektedir.

## Proje Ozeti

Bu sistem bir **e-ticaret/odeme** sistemi degildir.
Odak noktasi:

- Bungalov, tur ve paket iceriklerinin yonetimi
- Icerikler arasi iliski kurulmasi (paket icinde tur + bungalov)
- WhatsApp yonlendirme
- Teklif/musaitlik formu ile talep toplama
- Taleplerin admin panelinden takip edilmesi

## Teknoloji Yigini

- WordPress (monolitik kurulum, core dosyalari repo icinde)
- PHP 8.x
- MariaDB
- Docker Compose (local development)
- Ozel tema: `wp-content/themes/nextcore`
- Ozel eklenti: `wp-content/plugins/lazhem-listings`

## Mevcut Dizin Yapisi (Ana)

- `wp-content/themes/nextcore`: mevcut site tasarimi/tema
- `wp-content/plugins/lazhem-listings`: ilan yonetim eklentisi
- `public/detail.html`: referans detay sayfasi tasarimi
- `docker-compose.yml`: WordPress + MariaDB lokal ortami
- `wp-config.php`: Docker/env uyumlu WordPress ayarlari

## Son Yapilanlar

### 1) Site ayaga kaldirildi

- `localhost` acilmama problemi cozuldu.
- `wp-config.php` icinde DB ayarlari Docker env ile uyumlu hale getirildi.
- Son durum: `http://localhost` HTTP 200 donuyor.

### 2) Lazhem Listings eklentisi olusturuldu

Eklenti yolu:

- `wp-content/plugins/lazhem-listings`

Olusturulan temel moduller:

- Ana bootstrap: `lazhem-listings.php`
- Cekirdek sinif: `includes/class-lazhem-listings.php`
- Yardimci fonksiyonlar: `includes/helpers/class-lazhem-utils.php`
- CPT kayitlari: `includes/cpt/class-lazhem-cpt.php`
- Meta box + save yapisi: `includes/meta/class-lazhem-meta-boxes.php`
- Ayarlar sayfasi: `includes/admin/class-lazhem-settings.php`
- Talepler admin listeleme: `includes/admin/class-lazhem-inquiries.php`
- Frontend + form handler + template include: `includes/frontend/class-lazhem-frontend.php`
- Shortcode yapisi: `includes/shortcodes/class-lazhem-shortcodes.php`
- Template: `templates/detail.php`
- Form parcasi: `templates/parts/inquiry-form.php`

### 3) Icerik tipleri eklendi (CPT)

- `bungalov`
- `tur`
- `paket`
- `lazhem_talep` (adminde talep kayitlari)

### 4) Meta alan ve repeater sistemleri

- Ortak alanlar (durum, fiyat, CTA, WhatsApp mesaji, dahil/dahil degil vb.)
- Bungalov alanlari + varyasyon repeater
- Tur alanlari + tur programi repeater
- Paket alanlari + bungalov/tur iliski secimleri

### 5) Frontend detay sistemi

- `template_include` ile tekil detaylar plugin template'ine yonlendiriliyor.
- Kullanilan ortak template: `templates/detail.php`
- Tema override destegi var:
  - Theme icinde `lazhem-listings/detail.php` varsa onu kullanir.

### 6) Form/lead toplama altyapisi

- Form action: `admin-post.php`
- Hooklar:
  - `admin_post_lazhem_inquiry_submit`
  - `admin_post_nopriv_lazhem_inquiry_submit`
- Form datasi:
  - DB'ye `lazhem_talep` olarak kaydedilir
  - Ilgili ilan ile iliskilendirilir
  - IP ve temel metadata saklanir
  - Yonetici e-postasina bildirim gider

### 7) Shortcode'lar

- `[lazhem_listings type="bungalov"]`
- `[lazhem_listings type="tur"]`
- `[lazhem_listings type="paket"]`
- `[lazhem_featured type="..."]`
- `[lazhem_inquiry_form]`
- `[lazhem_related_items]`

### 8) Ornek veri eklendi

Sisteme 5'er adet kayit eklendi:

- Bungalov ID: `16, 17, 18, 19, 20`
- Tur ID: `21, 22, 23, 24, 25`
- Paket ID: `26, 27, 28, 29, 30`

Paket kayitlarinda ilgili tur/bungalov iliskileri de baglandi.

## Sistem Mimarisi

### Ust Seviye Mimari

1. **Icerik katmani**
- WordPress CPT: bungalov/tur/paket
- Meta box ile ozel alanlar
- Repeater alanlar JSON-vari array olarak post_meta icinde

2. **Iliski katmani**
- Paket -> secili bungalovlar (post ID listesi)
- Paket -> secili turlar (post ID listesi)

3. **Sunum katmani**
- Theme + plugin template entegrasyonu
- Ortak detay template
- Icerik tipine gore kosullu bolumler

4. **Lead katmani**
- Form submit -> `lazhem_talep` kaydi
- Admin takip sureci
- E-posta bildirimi

5. **Iletisim katmani**
- Ilandan ozel WhatsApp mesaji
- Ozel mesaj yoksa varsayilan ayar mesaji

## Guvenlik Yaklasimi

Mevcut eklenti altyapisinda su kontroller uygulanmistir:

- Nonce kontrolu (metabox save + form submit)
- Capability kontrolu (`current_user_can`)
- Input sanitize (`sanitize_text_field`, `sanitize_email`, `sanitize_textarea_field`)
- Output escape (`esc_html`, `esc_attr`, `esc_url`)
- Template tarafinda kontrollu render

## Lokal Kurulum

### 1) Konteynerleri baslat

```bash
docker compose up -d
```

### 2) Durumu kontrol et

```bash
docker compose ps
```

### 3) Siteye gir

- `http://localhost`

### 4) Gerekirse log incele

```bash
docker compose logs -f wordpress
docker compose logs -f db
```

## Admin Kullanim Akisi

1. `Lazhem Ilanlari > Ayarlar` ekranindan global ayarlari yap
2. `Bungalovlar`, `Turlar`, `Paketler` altindan icerik ekle
3. Paket detayinda ilgili bungalov/tur secimlerini yap
4. Detay sayfalarinda WhatsApp + Form CTA calisir
5. Gelen talepleri `Talepler` ekranindan takip et

## Bilinen Notlar / Yol Haritasi

- `public/detail.html` cok buyuk bir referans dosya; su an plugin template dinamik ortak yapiyi sagliyor.
- Bir sonraki adimda `detail.html` icindeki tum section'lar birebir 1:1 tasinabilir.
- Listeleme filtreleri su an temel seviyede; bolge/fiyat/sure gibi tum filtreler gelistirilebilir.
- Medya secici (galeri) UX'i adminde daha da iyilestirilebilir.
- Talep durum yonetimi icin ozel admin aksiyonlari/genisletilmis workflow eklenebilir.

## Lisans / Not

Bu repo proje odakli ozel gelistirme icerir. WordPress core dosyalari kendi lisanslari kapsamindadir.
