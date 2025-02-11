## Genel Bakış
Bu proje, Laravel 10 ile geliştirilmiş olup, kullanıcıların kendi profilleriyle giriş yaparak özel notlarını tutabilecekleri kişisel bir alan sunmaktadır. Arayüz tasarımında CSS ve Laravel Blade kullanılmıştır, böylece hem şık hem de işlevsel bir kullanıcı deneyimi hedeflenmiştir.

### Route ve Güvenlik Yapısı
Projede Laravel’in Controller grubu kullanılarak tüm yönlendirmeler düzenli bir yapıya oturtulmuştur. Kullanıcıdan gelen tüm istekler, Laravel Validation ile doğrulanarak güvenlik önlemleri üst seviyeye çıkarılmıştır.

Ayrıca, tüm task işlemleri yalnızca kimliği doğrulanmış (authenticated) kullanıcılara ait olduğundan, tüm ilgili rotalara auth middleware uygulanmıştır. Bu sayede yetkisiz erişimler engellenmiş ve her kullanıcının yalnızca kendi verilerine erişmesi sağlanmıştır.

### Geri Bildirim Mekanizması
Gerçekleştirilen her işlem sonucunda, kullanıcıya dinamik bir alert mesajı gösterilerek yapılan işlemler hakkında bilgilendirme sağlanmıştır. Bu sayede kullanıcı deneyimi geliştirilmiş, interaktif bir sistem oluşturulmuştur.

### Controller Yapısı ve Performans Optimizasyonu
Projede Controller içinde Model kullanımı için Constructor Injection (Bağımlılık Enjeksiyonu) yöntemi tercih edilmiştir. Böylece her metod içinde tekrar tekrar model çağrılmasının önüne geçilmiş, performans iyileştirmesi sağlanmıştır. Bu yaklaşım sayesinde kod okunabilirliği ve sürdürülebilirliği artırılmış, uygulamanın daha verimli çalışması sağlanmıştır.

## Proje Çalıştırma
Projenin kendi bilgisayarınızda sorunsuz çalışabilmesi için öncelikle .env.example dosyasını kopyalayarak .env olarak yeniden adlandırın. Daha sonra, kendi veritabanı bilgilerinizi .env dosyasında yapılandırın.

Tüm tabloların veritabanına aktarılması için aşağıdaki komutu çalıştırmanız gerekmektedir:
`php artisan migrate`

Artık tüm ayarlar hazır olduğuna göre `php artisan serve` komutunu çalıştırıp, login olarak projeyi inceleyebilirsiniz.

Hasan Basri Akcıl
Full-Stack Developer