<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\CategoryContest;
use App\Models\CategoryCourse;
use App\Models\CategoryVideo;
use App\Models\Tag;
use App\Models\TagContest;
use App\Models\TagCourse;
use App\Models\TagVideo;
use App\Models\App;
use App\Models\Video;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Irham Dinata',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'roles' => 'Administrator'
        ]);

        User::create([
            'name' => 'Valeria Luna',
            'email' => 'penulis@gamil.com',
            'password' => bcrypt('penulis123'),
            'roles' => 'Penulis'
        ]);

        Category::create([
            'name' => 'Berita',
            'slug' => 'berita'
        ]);

        Category::create([
            'name' => 'Internet',
            'slug' => 'internet'
        ]);

        Category::create([
            'name' => 'Gadget',
            'slug' => 'gadget'
        ]);

        Category::create([
            'name' => 'Sains',
            'slug' => 'sains'
        ]);

        Category::create([
            'name' => 'Game',
            'slug' => 'game'
        ]);

        Category::create([
            'name' => 'Tutorial',
            'slug' => 'tutorial'
        ]);

        Tag::create([
            'name' => 'Berita Terbaru',
            'slug' => 'berita-terbaru'
        ]);

        Tag::create([
            'name' => 'Berita Teknologi',
            'slug' => 'berita-teknologi'
        ]);

        CategoryContest::create([
            'name' => 'Agama',
            'slug' => 'agama'
        ]);

        CategoryContest::create([
            'name' => 'Akuntansi',
            'slug' => 'akuntansi'
        ]);

        CategoryContest::create([
            'name' => 'Ambassador',
            'slug' => 'ambassador'
        ]);

        CategoryContest::create([
            'name' => 'Artikel',
            'slug' => 'artikel'
        ]);

        CategoryContest::create([
            'name' => 'Beasiswa',
            'slug' => 'beasiswa'
        ]);

        CategoryContest::create([
            'name' => 'Bisnis',
            'slug' => 'bisnis'
        ]);

        CategoryContest::create([
            'name' => 'Cerdas Cermat',
            'slug' => 'cerdas-cermat'
        ]);

        TagContest::create([
            'name' => 'Lomba Nasional',
            'slug' => 'lomba-nasional'
        ]);

        CategoryCourse::create([
            'name' => 'Marketing',
            'slug' => 'marketing'
        ]);

        TagCourse::create([
            'name' => 'Marketing',
            'slug' => 'marketing'
        ]);

        CategoryVideo::create([
            'name' => 'Video',
            'slug' => 'video'
        ]);

        TagVideo::create([
            'name' => 'Video',
            'slug' => 'video'
        ]);

        Video::create([
            'users_id' => '1',
            'categories_id' => '1',
            'post_title' => 'Dr. Sri Margana: Menelusuri Jejak Literasi, Sejarah, dan Perlawanan Kolonial dalam Sastra Jawa',
            'post_content' => '
                <p class="" data-start="142" data-end="658">Literasi bukan sekadar kemampuan membaca dan menulis, melainkan cermin peradaban yang menunjukkan bagaimana masyarakat merekam, merawat, dan mewariskan ingatan kolektif mereka. Di dalamnya tersimpan warisan budaya, serta ketegangan sosial dan politik yang membentuk setiap zaman. Hal ini tercermin jelas dalam tradisi sastra Jawa, yang tak hanya kaya nilai estetika, tetapi juga menyimpan gagasan-gagasan yang menghubungkan dunia batin para penguasa dengan realitas sosial yang dinamis dan sering kali penuh gejolak.</p>
                <p class="" data-start="660" data-end="1376">Tradisi sastra Jawa berkembang sejak era keraton, ketika para raja, bangsawan, dan pujangga menulis karya dalam bentuk serat. Karya-karya tersebut tidak hanya menggambarkan kehidupan istana, tetapi juga menjadi wadah untuk menyuarakan keresahan politik. Melalui serat-serat inilah, kegelisahan itu didokumentasikan sekaligus digunakan untuk membangun ulang legitimasi kekuasaan mereka.</p>
                <p class="" data-start="660" data-end="1376">Seiring waktu, pengaruh Islam turut memperkaya tradisi literasi. Melalui jaringan pesantren, penulisan kitab-kitab dalam aksara Pegon (aksara Arab dengan bahasa Jawa) menjadi saluran penting penyebaran ilmu keislaman lokal. Penulisan teks agama, tafsir sosial dan politik di pesantren menjadi bentuk perlawanan terhadap dominasi pengetahuan Barat dan kolonialisme.<br /><br />Sementara itu, kehadiran kolonialisme Belanda membawa dampak besar. Mereka mengintervensi sistem kekuasaan Jawa, memaksakan administrasi modern dan penggunaan bahasa Belanda, serta mengarahkan narasi sejarah melalui proyek orientalisme. Sarjana-sarjana Eropa kerap menafsirkan budaya Jawa dari sudut pandang luar, yang justru sering kali mengaburkan makna asli teks-teks lokal.<br /><br />Sejarah literasi Jawa, pada akhirnya, adalah sejarah dialog antara tradisi lokal, Islam, dan kolonialisme. Sastra Jawa bukan sekadar refleksi masa lalu, melainkan juga medium perjuangan identitas dan bentuk perlawanan terhadap dominasi luar. Di tengah berbagai tantangan, literasi tetap menjadi sarana penting untuk menjaga ingatan kolektif bangsa.<br /><br />Simak obrolan seru Kepala Suku Mojok bersama Dr. Sri Margana dalam episode terbaru&nbsp;Putcast&nbsp;untuk mengenal lebih dalam warisan ini,&nbsp;karena belajar sejarah bukan hanya tentang masa lalu, tapi juga memahami akar budaya yang membentuk kita hari ini.</p>
            ',
            'slug' => 'dr-sri-margana-menelusuri-jejak-literasi-sejarah-dan-perlawanan-kolonial-dalam-sastra-jawa',
            'post_status' => 'Published',
            'embed_link' => 'Giq5rbmmXD0',
            'published_at' => '2025-05-09 22:50:18',
        ]);

        Video::create([
            'users_id' => '1',
            'categories_id' => '1',
            'post_title' => 'Ketika Negara Membungkam: Fakta Kelam Peristiwa Genosida Papua 1977',
            'post_content' => '
                <p>Episode&nbsp;JasMerah&nbsp;kali ini, Muhidin M. Dahlan mengangkat kembali sebuah tragedi kelam yang hampir terhapus dari memori nasional,&nbsp;&ldquo;Genosida Papua tahun 1977&rdquo;. Tragedi ini terjadi menjelang Pemilu Orde Baru, tepat di masa &ldquo;minggu tenang&rdquo;. Saat itu, operasi militer besar-besaran digelar di Lembah Baliem, Wamena. Ribuan warga sipil menjadi korban, dibantai, disiksa, dan desa-desa mereka dibom dari udara.<br /><br />Namun, semua kekejaman genosida ini nyaris tak tercatat dalam sejarah resmi. Media nasional seperti Kompas, Tempo, dan Sinar Harapan tidak memberikan sorotan berarti. Peristiwa sebesar itu hanya muncul samar di pojok-pojok berita, dan para korban justru dilabeli sebagai &ldquo;pengacau&rdquo;, bukan sebagai manusia yang dizalimi.<br /><br />Laporan-laporan dari luar negeri justru memberi gambaran yang lebih jelas tentang tragedi ini. Komisi HAM Asia dan organisasi TAPOL di Inggris mencatat bahwa korban jiwa diperkirakan mencapai 5.000 hingga 10.000 orang. Ribuan warga terpaksa mengungsi ke Papua Nugini akibat kekejaman aparat.<br /><br />Bahkan, pesawat tempur OV-10 Bronco yang merupakan bantuan militer dari Amerika Serikat, yang seharusnya hanya digunakan untuk latihan, digunakan untuk membombardir kampung-kampung. Semua kekerasan ini terjadi demi mengamankan wilayah sekitar Freeport, tambang emas dan tembaga yang menjadi pusat kepentingan ekonomi elite Jakarta dan mitra-mitra globalnya.<br /><br />Lantas mengapa tragedi genosida ini begitu sunyi? Mengapa ribuan nyawa melayang, tetapi hanya menjadi catatan kecil di halaman belakang surat kabar?, dan Siapa yang diuntungkan dari penghapusan ingatan kolektif ini? Temukan jawabannya di JasMerah, karena mengingat adalah bentuk paling radikal dari melawan.</p>
            ',
            'slug' => 'ketika-negara-membungkam-fakta-kelam-peristiwa-genosida-papua-1977',
            'post_status' => 'Published',
            'embed_link' => 'y1tFJBYJ4WI',
            'published_at' => '2025-05-09 22:50:18',
        ]);

        // Video::create([
        //     'users_id' => '1',
        //     'categories_id' => '1',
        //     'post_title' => '',
        //     'post_content' => '
                
        //     ',
        //     'slug' => '',
        //     'post_status' => 'Published',
        //     'embed_link' => 'Giq5rbmmXD0',
        //     'published_at' => '2025-05-09 22:50:18',
        // ]);

        App::create([
            'name' => 'Arena Lomba',
            'logo' => 'assets/apps/P43W9WskyGImWYiQHyKQJZAI5i6vTTkeYmhs1JOn.jpg',
            'favicon' => 'assets/apps/QJUtZZ6sq2D6P6udmkq2UhB8ynAZQTiEAV2wiCBN.jpg',
            'title' => 'Portal Berita Seputar Arena Lomba',
            'description' => 'Portal Berita Arena Lomba',
            'link_web' => 'https://arenalomba.com',
        ]);

        $this->call(LocationSeeder::class);
    }
}
