<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->username = "admin";
        $user->name = "admin";
        $user->level = "admin";
        $user->password = bcrypt('12345');
        $user->save();

        $user = new User();
        $user->username = "sadmin";
        $user->name = "sadmin";
        $user->level = "super_admin";
        $user->password = bcrypt('12345');
        $user->save();

        $user = new User();
        $user->kebutuhan = "alamat";
        $user->keterangan = "Jl. Anggajaya 2 No.105, Sanggrahan, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281
        ";
        $user->save();

        $user = new User();
        $user->kebutuhan = "nomor whatsapp";
        $user->keterangan = "+62 811-2643-949";
        $user->save();

        $user = new User();
        $user->kebutuhan = "nomor handphone";
        $user->keterangan = "0811-3187-055";
        $user->save();

        $user = new User();
        $user->kebutuhan = "deskripsi";
        $user->keterangan = "Tentang kami PT Widya Informasi Nusantara atau Widya Wicara merupakan bagian dari Widya Indonesia Group yang didirikan pada tanggal 26 Februari 2019. Kami menciptakan solusi untuk berbagai kebutuhan masyarakat Indonesia terkait dengan pengolahan ucapan atau bahasa. Kami telah menciptakan empat inovasi produk berbasis teknologi wicara: Smart Speakers Widya Wicara, Text to Speech Widya Wicara, Speech to Text Widya Wicara, dan Chatbot.";
        $user->save();

        $user = new User();
        $user->kebutuhan = "testing1";
        $user->keterangan = "testing2";
        $user->save();
    }
}
