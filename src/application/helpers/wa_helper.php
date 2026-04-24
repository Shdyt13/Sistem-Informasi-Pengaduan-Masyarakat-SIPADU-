<?php


function kirim_wa($nomor, $pesan)
{
    $curl = curl_init();
    
    //TOKEN DARI FONNTE
    $token = "UAK5Jp6eUc3N7V6921HU"; 

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.fonnte.com/send',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array(
        'target' => $nomor,
        'message' => $pesan,
        'countryCode' => '62', // Ini fitur ajaib agar nomor 08... otomatis jadi 628...
      ),
      CURLOPT_HTTPHEADER => array(
        "Authorization: $token"
      ),
    ));

    $response = curl_exec($curl);
    
    // (Opsional) Uncomment baris di bawah ini jika ingin melihat error asli dari Fonnte saat testing
    // echo $response; die; 532E48647974
    
    curl_close($curl);
    return $response;
}