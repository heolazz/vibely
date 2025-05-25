<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        Article::create([
            'title' => 'Apa Itu Kesehatan Mental?',
            'excerpt' => 'Pelajari definisi, pentingnya menjaga kesehatan mental, dan bagaimana mengidentifikasi masalah sejak dini.',
            'content' => '
                <p>Kesehatan mental mencakup kondisi emosional, psikologis, dan sosial seseorang. Ini memengaruhi bagaimana kita berpikir, merasa, dan bertindak ketika menghadapi kehidupan sehari-hari. Kesehatan mental juga membantu menentukan bagaimana kita menangani stres, berhubungan dengan orang lain, dan membuat keputusan.</p>
                <p>Menjaga kesehatan mental sama pentingnya dengan menjaga kesehatan fisik. Seseorang yang mentalnya sehat mampu menghadapi tekanan, bekerja secara produktif, dan memberikan kontribusi positif pada komunitasnya. Sayangnya, banyak orang masih mengabaikan tanda-tanda awal gangguan mental.</p>
                <p>Beberapa langkah yang bisa dilakukan untuk menjaga kesehatan mental meliputi: tidur cukup, menjaga pola makan, berolahraga teratur, bersosialisasi, dan mencari bantuan profesional jika diperlukan.</p>
            ',
        ]);

        Article::create([
            'title' => 'Musik Sebagai Terapi',
            'excerpt' => 'Temukan bagaimana musik bisa membantu mengurangi stres dan meningkatkan suasana hati.',
            'content' => '
                <p>Musik telah lama digunakan sebagai alat terapi untuk menenangkan pikiran dan menyalurkan emosi. Dalam terapi musik, individu dapat mendengarkan, menciptakan, atau memainkan musik sebagai bagian dari proses penyembuhan.</p>
                <p>Penelitian menunjukkan bahwa musik dapat menurunkan kadar hormon stres, menurunkan tekanan darah, dan meningkatkan mood. Musik klasik, instrumental, atau alam sering digunakan dalam sesi meditasi atau relaksasi.</p>
                <p>Tak hanya itu, musik juga membantu penderita gangguan kecemasan, depresi, hingga trauma untuk mengekspresikan perasaan yang sulit diungkapkan dengan kata-kata.</p>
            ',
        ]);

        Article::create([
            'title' => 'Kenali Ciri-ciri Gangguan Mental',
            'excerpt' => 'Waspadai tanda-tanda seperti kelelahan emosional, cemas berlebih, atau sulit tidur.',
            'content' => '
                <p>Mengenali gejala gangguan mental sejak dini sangat penting agar dapat ditangani dengan cepat dan tepat. Beberapa ciri umum meliputi: perubahan suasana hati yang ekstrem, perasaan sedih berkepanjangan, kecemasan tanpa sebab jelas, sulit tidur atau tidur berlebihan, serta menarik diri dari pergaulan sosial.</p>
                <p>Gejala lainnya bisa berupa kesulitan berkonsentrasi, perubahan pola makan, merasa tidak berguna, atau bahkan keinginan untuk menyakiti diri sendiri. Setiap orang bisa mengalami gejala yang berbeda-beda tergantung pada kondisi dan latar belakangnya.</p>
                <p>Jika kamu atau orang terdekat menunjukkan tanda-tanda tersebut, penting untuk segera mencari bantuan dari tenaga profesional seperti psikolog atau psikiater.</p>
            ',
        ]);

        Article::create([
            'title' => 'Manfaat Menulis Jurnal Emosi',
            'excerpt' => 'Menulis dapat menjadi alat untuk mengenali dan mengelola perasaan secara lebih sehat.',
            'content' => '
                <p>Menulis jurnal emosi adalah cara sederhana namun efektif untuk memahami apa yang sedang kamu rasakan. Dengan menuliskannya, kamu bisa mengenali pola pikir negatif, mencatat momen bahagia, atau melacak pemicu stres yang kamu alami.</p>
                <p>Kegiatan ini terbukti membantu menurunkan tingkat kecemasan, meningkatkan self-awareness, dan mendukung proses pemulihan emosional. Jurnal tidak harus panjang — cukup tulis apa yang kamu pikirkan dan rasakan hari itu.</p>
                <p>Coba luangkan waktu setiap malam untuk menulis selama 5–10 menit, dan lihat bagaimana kebiasaan ini membantu mengklarifikasi pikiranmu.</p>
            ',
        ]);
    }
}
