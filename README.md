# NewsAggregator

Haber toplama ve yönetimi için geliştirilmiş bir web uygulamasıdır.

Bu proje, farklı kaynaklardan haberleri toplayıp bir araya getirerek yönetilebilir bir arayüz sunar.

## İçindekiler

- [Proje Tanımı](#proje-tanımı)
- [Kurulum](#kurulum)
- [Çalıştırma](#çalıştırma)
- [Bağımlılıklar](#bağımlılıklar)
- [Katkıda Bulunma](#katkıda-bulunma)
- [Lisans](#lisans)
- [package.json ve requirements.txt](#packagejson-ve-requirementstxt)
- [Konfigürasyon Dosyaları](#konfigürasyon-dosyaları)
- [API Referansı](#api-referansı)

## Proje Tanımı

Bu repository, bir haber toplama uygulamasının backend kısmını içermektedir.

**Temel Özellikler:**

*   **Haber Toplama:** Belirli kaynaklardan haber başlıklarını ve içeriklerini toplar.
*   **Yönetim Paneli:** Admin kullanıcıları için haberleri yönetme ve görüntüleme arayüzü sağlar.
*   **API:** Dış uygulamalar için haber verilerine erişim sağlayan API uç noktaları sunar.
*   **Kullanıcı Yönetimi:** Admin kullanıcılarının rollerini ve izinlerini yönetme imkanı sunar.
*   **Logging:** Gelen log kayıtlarını tutar.

## Kurulum

1.  Depoyu klonlayın:

    ```bash
    git clone https://github.com/muhammetalifidan/NewsAggregator.git
    ```
2.  `src/backend-ui` dizinine gidin:

    ```bash
    cd NewsAggregator/src/backend-ui
    ```

3.  Composer bağımlılıklarını yükleyin:

    ```bash
    composer install
    ```

4.  `.env.example` dosyasını `.env` olarak kopyalayın ve gerekli çevre değişkenlerini yapılandırın:

    ```bash
    cp .env.example .env
    ```

5.  Uygulama anahtarını oluşturun:

    ```bash
    php artisan key:generate
    ```

6.  Veritabanı yapılandırması:

    `.env` dosyasında veritabanı bağlantı ayarlarını yapılandırın. Örnek olarak SQLite kullanabilirsiniz:

    ```
    DB_CONNECTION=sqlite
    DB_DATABASE=database.sqlite
    ```

7. Veritabanı oluşturun:

    ```bash
    touch database/database.sqlite
    ```

8.  Veritabanı migrasyonlarını çalıştırın:

    ```bash
    php artisan migrate
    ```
   Eğer `permission` tabloları oluşturulmadı ise bu komutu çalıştırın:

      ```bash
    php artisan migrate --path=/database/migrations/2024_12_04_093554_create_permission_tables.php
    ```

9.  Gerekli rolleri ve izinleri oluşturmak için seed komutunu çalıştırın:

    ```bash
    php artisan db:seed
    ```

10. Frontend bağımlılıklarını yükleyin:

    ```bash
    npm install
    ```

### Çevre Değişkenleri

`.env` dosyasında aşağıdaki çevre değişkenlerini yapılandırın:

*   `APP_NAME`: Uygulama adı.
*   `APP_ENV`: Uygulama ortamı (`local`, `production`, vb.).
*   `APP_KEY`: Uygulama anahtarı (php artisan key:generate komutu ile oluşturulur).
*   `APP_DEBUG`: Debug modunu etkinleştirme/devre dışı bırakma.
*   `APP_URL`: Uygulama URL'si.
*   `DB_CONNECTION`: Veritabanı bağlantı türü (`mysql`, `sqlite`, `pgsql`, `sqlsrv`).
*   `DB_DATABASE`: Veritabanı adı.
*   `DB_USERNAME`: Veritabanı kullanıcı adı.
*   `DB_PASSWORD`: Veritabanı parolası.
*   `MAIL_MAILER`: E-posta gönderme servisi (`smtp`, `log`, vb.).
*   `MAIL_HOST`: E-posta sunucu adresi.
*   `MAIL_PORT`: E-posta sunucu portu.
*   `MAIL_USERNAME`: E-posta kullanıcı adı.
*   `MAIL_PASSWORD`: E-posta parolası.

## Çalıştırma

1.  Geliştirme sunucusunu başlatın:

    ```bash
    php artisan serve
    ```

2.  Frontend geliştirme sunucusunu başlatın:

    ```bash
    npm run dev
    ```

3. Tarayıcıda uygulamayı açın: `http://localhost:8000`

Ayrıca `composer.json` dosyasında tanımlı olan `dev` script'ini kullanarak hem backend hem de frontend sunucularını aynı anda başlatabilirsiniz:

```bash
composer dev
```

Bu komut aşağıdaki işlemleri eş zamanlı olarak gerçekleştirir:

*   `php artisan serve`: Laravel geliştirme sunucusunu başlatır.
*   `php artisan queue:listen --tries=1`: Kuyruk dinleyicisini başlatır.
*   `php artisan pail --timeout=0`: Laravel Pail'i başlatır (log izleme aracı).
*   `npm run dev`: Vite ile frontend geliştirme sunucusunu başlatır.

## API Referansı

| Uç Nokta    | HTTP Metodu | Parametreler                                                                                                     | Açıklama                                                                                                                     | Tip      |
| :---------- | :---------- | :--------------------------------------------------------------------------------------------------------------- | :--------------------------------------------------------------------------------------------------------------------------- | :------- |
| `/api/login` | POST        | `email` (string, gerekli), `password` (string, gerekli)                                                        | Admin kullanıcısı için oturum açma.                                                                                        | Public   |
| `/api/callback` | POST        | Haber verisi (JSON formatında)                                                                                | Haber verilerini almak için kullanılır. `auth:sanctum` middleware ile korunmaktadır, yani geçerli bir API token'ı gerektirir. | Protected|

## Bağımlılıklar

*   **Backend (backend-ui):**
    *   PHP >= 8.2
    *   Laravel Framework ^11.31
    *   Laravel Sanctum
    *   Laravel Tinker
    *   spatie/laravel-permission
    *   Faker
    *   Laravel Pail
    *   Laravel Pint
    *   Laravel Sail
    *   Mockery
    *   nunomaduro/collision
    *   pestphp/pest
    *   phpunit/phpunit
    *   Node.js
    *   npm
    *   Vite
    *   tailwindcss
*   **Scraper:**
    *   Node.js
    *   npm veya pnpm
    *   puppeteer-core
    *   axios
    *   dotenv
    *   winston

## Katkıda Bulunma

1.  Projeyi fork edin.
2.  Yeni bir branch oluşturun (`git checkout -b feature/yenilik`).
3.  Değişikliklerinizi yapın ve commit'leyin (`git commit -am 'Yenilik eklendi'`).
4.  Branch'inizi push edin (`git push origin feature/yenilik`).
5.  Pull Request oluşturun.

## Lisans

Proje MIT lisansı altında lisanslanmıştır. Detaylar için [LICENSE](https://opensource.org/licenses/MIT) dosyasına bakabilirsiniz.

## `package.json` ve `requirements.txt`

*   `package.json` (scraper ve backend-ui): JavaScript bağımlılıklarını ve script'lerini tanımlar. `npm install` komutu ile yüklenir.

    *   `scripts`:
        *   `build`: Vite ile frontend dosyalarını derler.
        *   `dev`: Vite geliştirme sunucusunu başlatır.
        *    `test`: Scraper için test komutunu tanımlar.
        *   `start`: Scraper uygulamasını nodemon ile başlatır.
*   `composer.json` (backend-ui): PHP bağımlılıklarını ve script'lerini tanımlar. `composer install` komutu ile yüklenir.

    *   `scripts`:
        *   `post-autoload-dump`: Autoload dosyalarını günceller ve paketleri keşfeder.
        *   `post-update-cmd`: Vendor dosyalarını yayınlar.
        *   `post-root-package-install`: `.env` dosyasını oluşturur.
        *   `post-create-project-cmd`: Uygulama anahtarını oluşturur ve veritabanı migrasyonlarını çalıştırır.
        *   `dev`: Geliştirme sunucusu, kuyruk dinleyicisi, log izleme aracı ve frontend geliştirme sunucusunu aynı anda başlatır.

## Konfigürasyon Dosyaları

*   `config/app.php`: Uygulama genel yapılandırmalarını içerir (isim, ortam, zaman dilimi, vb.).
*   `config/auth.php`: Kimlik doğrulama yapılandırmalarını içerir (guard'lar, provider'lar, vb.).
*   `config/cache.php`: Önbellekleme yapılandırmalarını içerir (sürücüler, ön ekler, vb.).
*   `config/cors.php`: CORS yapılandırmalarını içerir (izin verilen kaynaklar, metotlar, başlıklar, vb.).
*   `config/filesystems.php`: Dosya sistemi yapılandırmalarını içerir (diskler, sürücüler, sembolik bağlantılar, vb.).
*   `config/logging.php`: Loglama yapılandırmalarını içerir (kanallar, sürücüler, formatlar, vb.).
*   `config/mail.php`: E-posta yapılandırmalarını içerir (mailer'lar, transport'lar, adresler, vb.).
*   `config/queue.php`: Kuyruk yapılandırmalarını içerir (bağlantılar, sürücüler, tablolar, vb.).
*   `config/sanctum.php`: Sanctum yapılandırmalarını içerir (durumlu alan adları, middleware'ler, vb.).
*   `config/services.php`: Üçüncü parti servislerin kimlik bilgilerini içerir (Mailgun, Postmark, AWS, vb.).
*   `.env` (scraper ve backend-ui): Uygulama ortamına özel değişkenleri tanımlar (API anahtarları, veritabanı bağlantıları, vb.).