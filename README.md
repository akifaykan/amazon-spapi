## Amazon SP-API Laravel Projesi

Bu proje, Laravel 11 ile Amazon SP-API’ye bağlanmak ve Amazon’dan ürün listesi gibi verileri çekmek için tasarlanmıştır. Modern yazılım prensiplerine uygun olarak geliştirilmiş, test edilebilir ve genişletilebilir bir yapıya sahiptir.

### Kurulum

1. Klonlama:
```
git clone https://github.com/akifaykan/amazon-spapi.git
```

2. Gerekli bağımlılıklar:
```
composer install
```

3. .env dosyası:
```
# Amazon SP-API
SPAPI_BASE_URL=https://sellingpartnerapi-eu.amazon.com
SPAPI_CLIENT_ID=your_client_id
SPAPI_CLIENT_SECRET=your_client_secret
SPAPI_REFRESH_TOKEN=your_refresh_token
SPAPI_REGION=eu-west-1
```

4. Test:
```
php artisan test
```

