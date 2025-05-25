<?php

namespace Database\Seeders;

use App\Models\PanasQuestion;
use Illuminate\Database\Seeder;

class PanasQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            // Emosi Positif
            ['emotion' => 'interested', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa penasaran dan ingin tahu lebih banyak terhadap sesuatu hal?'],
            ['emotion' => 'interested', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa tertarik pada hal baru atau ide yang menarik?'],
            ['emotion' => 'excited', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa tidak sabar untuk melakukan sesuatu yang Anda sukai?'],
            ['emotion' => 'excited', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa sangat bersemangat ketika ada hal seru yang akan terjadi?'],
            ['emotion' => 'strong', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa percaya diri dan siap menghadapi tantangan?'],
            ['emotion' => 'strong', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa kuat, baik secara fisik maupun mental?'],
            ['emotion' => 'enthusiastic', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa semangat untuk menjalani hari?'],
            ['emotion' => 'enthusiastic', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa penuh antusiasme hingga sulit diam?'],
            ['emotion' => 'proud', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa bangga atas pencapaian Anda, sekecil apa pun itu?'],
            ['emotion' => 'proud', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa puas dengan upaya yang telah Anda lakukan?'],
            ['emotion' => 'alert', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa fokus dan waspada terhadap lingkungan sekitar?'],
            ['emotion' => 'alert', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa siap siaga untuk menghadapi situasi apa pun?'],
            ['emotion' => 'inspired', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda tiba-tiba mendapatkan ide kreatif dan ingin segera mengerjakannya?'],
            ['emotion' => 'inspired', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa termotivasi oleh sesuatu yang Anda lihat atau dengar?'],
            ['emotion' => 'determined', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa yakin dan tidak mudah menyerah untuk mengejar tujuan Anda?'],
            ['emotion' => 'determined', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa sangat bertekad untuk menyelesaikan sesuatu hingga tuntas?'],
            ['emotion' => 'attentive', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa dapat fokus sepenuhnya pada sesuatu yang sedang Anda kerjakan?'],
            ['emotion' => 'attentive', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa benar-benar memperhatikan detail dari hal yang Anda lakukan?'],
            ['emotion' => 'active', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa penuh energi dan tidak mudah lelah?'],
            ['emotion' => 'active', 'type' => 'positive', 'question_text' => 'Seberapa sering Anda merasa ingin terus bergerak dan sulit diam?'],

            // Emosi Negatif
            ['emotion' => 'distressed', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa memiliki banyak beban pikiran sehingga sulit bersantai?'],
            ['emotion' => 'distressed', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa kelelahan, baik secara fisik maupun mental?'],
            ['emotion' => 'upset', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa jengkel atau tidak bersemangat karena sesuatu?'],
            ['emotion' => 'upset', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa kecewa dan sulit untuk merasa lebih baik?'],
            ['emotion' => 'guilty', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa bersalah setelah melakukan atau tidak melakukan sesuatu?'],
            ['emotion' => 'guilty', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda terus-menerus memikirkan kesalahan yang Anda lakukan?'],
            ['emotion' => 'scared', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa takut menghadapi sesuatu yang tidak pasti?'],
            ['emotion' => 'scared', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa cemas bahwa sesuatu yang buruk akan terjadi?'],
            ['emotion' => 'irritable', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda mudah marah pada orang lain tanpa alasan yang jelas?'],
            ['emotion' => 'irritable', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa terganggu atau sensitif terhadap hal-hal kecil?'],
            ['emotion' => 'ashamed', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa sangat malu karena sesuatu yang Anda lakukan?'],
            ['emotion' => 'ashamed', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda berharap bisa menghilang karena rasa malu?'],
            ['emotion' => 'nervous', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa gugup sebelum melakukan sesuatu?'],
            ['emotion' => 'nervous', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa tegang dan sulit rileks?'],
            ['emotion' => 'jittery', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa gelisah tanpa alasan yang jelas?'],
            ['emotion' => 'jittery', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa tidak nyaman karena sesuatu yang mengganggu?'],
            ['emotion' => 'hostile', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa kesal atau tidak menyukai seseorang?'],
            ['emotion' => 'hostile', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa sulit bersabar terhadap orang lain?'],
            ['emotion' => 'afraid', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa sangat takut menghadapi sesuatu dalam hidup?'],
            ['emotion' => 'afraid', 'type' => 'negative', 'question_text' => 'Seberapa sering Anda merasa tidak siap menghadapi situasi yang sulit?'],
        ];

        foreach ($questions as $question) {
            PanasQuestion::create($question);
        }
    }
}
