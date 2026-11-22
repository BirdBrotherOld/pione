@component('mail::message')
    <table align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
        <td align="center">
            <img
                src="https://cakra-it-bucket.s3.ap-southeast-1.amazonaws.com/images/originals/RpBr6qYbmFJO3UIyNLF8x5Wzy5Rhq0wW897WOCHB.png"
                alt="email icon" style="width: 100px; margin-bottom: 32px;" class="image">
        </td>
        <tr>
    </table>

Dear {{$email}},

Selamat, Anda Telah Berhasil Daftar Sebagai Calon Membership dari Pajero Indonesia. Sebelum anda menjadi Membership, anda diwajibkan untuk membayar biaya pertama sebesar Rp. 600.000. Untuk lebih detailnya anda bisa menekan tombol di bawah ini.
@component('mail::button', ['url' => 'enter your desired url'])
Whatsapp Admin PIone
@endcomponent

Thanks,<br>
@endcomponent