<?php

namespace Database\Seeders;

use App\Models\Companyy;
use Illuminate\Database\Seeder;

class UserCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyy = new UserCompanySeeder();
        $companyy->nama = "address";
        $companyy->content = "Jl. Anggajaya 2 No.105, Sanggrahan, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281";

        $companyy = new UserCompanySeeder();
        $companyy->nama = "nomor whatsapp";
        $companyy->content = "0811-2643-949";

        $companyy = new UserCompanySeeder();
        $companyy->nama = "nomor handphone";
        $companyy->content = "0811-3187-055";

        $companyy = new UserCompanySeeder();
        $companyy->nama = "description 1";
        $companyy->content = "PT Widya Informasi Nusantara atau Widya Wicara merupakan bagian dari Widya Indonesia Group yang didirikan pada tanggal 26 Februari 2019. Kami menciptakan solusi untuk berbagai kebutuhan masyarakat Indonesia terkait dengan pengolahan ucapan atau bahasa. Kami telah menciptakan empat inovasi produk berbasis teknologi wicara: Smart Speakers Widya Wicara, Text to Speech Widya Wicara, Speech to Text Widya Wicara, dan Chatbot.";


    }
}
