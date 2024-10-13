<?php
/*
SET @user_latitude = ?;  -- Ganti dengan latitude pengguna
SET @user_longitude = ?; -- Ganti dengan longitude pengguna

SELECT *,
    (6371 * ACOS(COS(RADIANS(@user_latitude)) 
    * COS(RADIANS(latitude)) 
    * COS(RADIANS(longitude) - RADIANS(@user_longitude)) 
    + SIN(RADIANS(@user_latitude)) 
    * SIN(RADIANS(latitude)))) AS distance
FROM your_table
ORDER BY distance ASC;
*/


function generateCalendar($month, $year) {
    // Array nama bulan dalam bahasa Indonesia
    $months = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    // Dapatkan timestamp dari tanggal pertama bulan yang dipilih
    $firstDay = mktime(0, 0, 0, $month, 1, $year);
    // Dapatkan hari dalam seminggu dari tanggal pertama bulan yang dipilih
    $firstDayOfWeek = date('w', $firstDay);
    // Dapatkan jumlah hari dalam bulan yang dipilih
    $daysInMonth = date('t', $firstDay);
    
    // Mendapatkan tanggal untuk bulan sebelumnya dan selanjutnya
    $prevMonth = $month - 1;
    $prevYear = $year;
    if ($prevMonth < 1) {
        $prevMonth = 12;
        $prevYear--;
    }
    
    $nextMonth = $month + 1;
    $nextYear = $year;
    if ($nextMonth > 12) {
        $nextMonth = 1;
        $nextYear++;
    }

    // Memulai kalender
    echo "";

    echo "<table>";
    echo "<tr>
            <th colspan='7'>" . $months[$month] . " " . $year . "</th>
          </tr>";
    echo "<tr>
            <th>Min</th>
            <th>Sen</th>
            <th>Sel</th>
            <th>Rab</th>
            <th>Kam</th>
            <th>Jum</th>
            <th>Sab</th>
          </tr>";
    
    // Mengisi minggu pertama dengan tanggal dari bulan sebelumnya jika perlu
    $day = 1;
    for ($week = 0; $week < 5; $week++) {
        echo "<tr>";
        
        for ($dayOfWeek = 0; $dayOfWeek < 7; $dayOfWeek++) {
            // Jika ini adalah minggu pertama, isi dengan tanggal dari bulan sebelumnya
            if ($week === 0 && $dayOfWeek < $firstDayOfWeek) {
                $prevDay = date('t', mktime(0, 0, 0, $prevMonth, 1, $prevYear)) - $firstDayOfWeek + $dayOfWeek + 1;
                echo "<td style='color: gray;'>$prevDay</td>";
            } elseif ($day <= $daysInMonth) {
                // Jika masih dalam bulan yang dipilih
                echo "<td><a href='kehadiran.php?tanggal=" . sprintf("%04d-%02d-%02d", $year, $month, $day) . "'>$day</a></td>";
                $day++;
            } else {
                // Jika sudah melewati bulan yang dipilih, tampilkan tanggal dari bulan berikutnya
                echo "<td style='color: gray;'><a href='kehadiran.php?tanggal=" . sprintf("%04d-%02d-%02d", $nextYear, $nextMonth, $day - $daysInMonth) . "'>" . ($day - $daysInMonth) . "</a></td>";
                $day++;
            }
        }
        
        echo "</tr>";
        // Jika sudah menampilkan semua hari dalam bulan yang dipilih, keluar dari loop
        if ($day > $daysInMonth) break;
    }

    // Menampilkan tombol navigasi di dalam tabel
    echo "<tr>
            <td colspan='7' class='nav-buttons'>
                <form method='get'>
                    <input type='hidden' name='month' value='$prevMonth'>
                    <input type='hidden' name='year' value='$prevYear'>
                    <button type='submit'>Sebelumnya</button>
                </form>
                <form method='get'>
                    <input type='hidden' name='month' value='$nextMonth'>
                    <input type='hidden' name='year' value='$nextYear'>
                    <button type='submit'>Berikutnya</button>
                </form>
            </td>
          </tr>";

    echo "</table>";
}

// Ambil parameter bulan dan tahun dari query string
if (isset($_GET['month']) && isset($_GET['year'])) {
    $month = (int)$_GET['month'];
    $year = (int)$_GET['year'];
} else {
    $month = date('n'); // Bulan saat ini
    $year = date('Y');  // Tahun saat ini
}
?>
<style>
table {
    width: 100%;
    margin: auto;
    max-width: 600px; /* Mengatur lebar maksimum tabel */
    border-collapse: collapse;
    margin: 20px auto; /* Centering table */
    font-family: Arial, sans-serif;
}
th {
    background-color: #4CAF50;
    color: white;
    padding: 6px 8px;
    width: 14.2857%;
}
td {
    border: 1px solid #ddd;
    text-align: center;
}
td a {
    text-decoration: none;
    color: black;
    padding: 8px 8px;
    display: block; 
    text-align: center;
}
td a:hover {
    color: #4CAF50;
    font-weight: bold;
}
tr:nth-child(even) {
    background-color: #f2f2f2;
}
tr:nth-child(odd) {
    background-color: #ffffff;
}
.nav-buttons {
    text-align: center;
    margin: 20px 0;
}
.nav-buttons form {
    display: inline;
}
.nav-buttons button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    margin: 0 5px;
    border-radius: 5px;
}
.nav-buttons button:hover {
    background-color: #45a049;
}
</style>
<?php
generateCalendar($month, $year);
?>

<form method="get" style="text-align: center;">
    <label for="date">Masukkan bulan (m-d): </label>
    <input type="text" name="date" placeholder="mm-dd" required>
    <button type="submit">Tampilkan Kalender</button>
</form>
