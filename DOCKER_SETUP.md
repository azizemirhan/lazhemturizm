# Docker Setup - Lazhem Turizm

Bu proje Docker Compose ile çalıştırılabilir hale getirilmiştir.

## Gereksinimler

- Docker Desktop (Mac/Windows) veya Docker Engine + Docker Compose (Linux)
- Docker Compose 3.8+

## Kurulum ve Çalıştırma

### 1. Docker Images'ı İndir ve Başlat

```bash
docker-compose up -d
```

Containers başlatılırken, MariaDB veritabanı başlatılıncaya kadar beklenir.

### 2. Site Adresine Erişim

- **WordPress Sitesi**: http://localhost
- **MariaDB**: localhost:3306

### 3. WordPress İlk Kurulumu (Eğer Yeniyse)

- http://localhost adresine git
- WordPress kurulum sihirbazını tamamla
- Admin panele erişim sağla

### Veritabanından Restore Etme

Eğer mevcut `lazhem-2026-05-09.sql` dosyasından verileri yüklemek istersen:

```bash
# SQL dosyasını MariaDB container'ına kopyala ve import et
docker-compose exec db mysql -u wordpress -pwordpress_password_change_me lazhemturizm < lazhem-2026-05-09.sql
```

**Not**: `.env` dosyasındaki şifreler ile uyumlu olmalıdır.

## Yararlı Docker Komutları

```bash
# Containers'ı görüntüle
docker-compose ps

# Logs'ları takip et (gerçek zamanlı)
docker-compose logs -f

# Specific container'ın logs'larını gör
docker-compose logs wordpress
docker-compose logs db

# Container'a shell erişimi sağla
docker-compose exec wordpress bash
docker-compose exec db bash

# Containers'ı durdur
docker-compose stop

# Containers'ı sil (volumes'i tutmak için -v olmadan)
docker-compose down

# Containers'ı ve volumes'i sil
docker-compose down -v

# Rebuild containers
docker-compose up -d --build
```

## Ortam Değişkenleri (.env)

`.env` dosyasında şu değerler ayarlanmıştır:

- `MYSQL_ROOT_PASSWORD`: MySQL root şifresi
- `MYSQL_DATABASE`: Veritabanı adı
- `MYSQL_USER`: MySQL kullanıcısı
- `MYSQL_PASSWORD`: MySQL kullanıcı şifresi
- `WORDPRESS_DB_*`: WordPress veritabanı bağlantısı

**Önemli**: Production'da şifreleri güvenli değerlerle değiştir!

## Sorun Giderme

### Port 80 zaten kullanımda ise

Docker-compose.yml dosyasında port değiştir:
```yaml
ports:
  - "8080:80"  # Dış port:İç port
```

Sonra http://localhost:8080 adresine erişim sağla.

### Database bağlantı hatası

```bash
# Database'in çalışıp çalışmadığını kontrol et
docker-compose logs db

# Database'i yeniden başlat
docker-compose restart db
```

### WordPress dosya izni hatası

```bash
# WordPress container'ına gir
docker-compose exec wordpress bash

# İzinleri düzelt
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html
chmod -R 644 /var/www/html/*.php
```

## Veritabanı Yedekleme

```bash
# Güncel dump oluştur
docker-compose exec db mysqldump -u wordpress -pwordpress_password_change_me lazhemturizm > backup-$(date +%Y-%m-%d).sql
```

## Production Notları

- Tüm şifreleri `.env` dosyasında güvenli, karmaşık değerlerle değiştir
- `WORDPRESS_AUTH_KEY` vb. güvenlik anahtarlarını https://api.wordpress.org/secret-key/1.1/salt/ adresinden yenile
- Volume'leri (db_data vb.) düzenli olarak yedekle
- HTTPS sertifikası ekle (Nginx reverse proxy veya Let's Encrypt kullan)
