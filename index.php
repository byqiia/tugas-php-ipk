<?php
// data mata kuliah
$matkul = [
    ["nama" => "Pemrograman Web",     "sks" => 3, "nilai" => 88],
    ["nama" => "Sistem Data",         "sks" => 3, "nilai" => 78],
    ["nama" => "Jaringan Komputer",   "sks" => 3, "nilai" => 65],
    ["nama" => "Struktur Data",       "sks" => 3, "nilai" => 82],
    ["nama" => "Statistika",          "sks" => 2, "nilai" => 45],
    ["nama" => "Pendidikan Pancasila", "sks" => 2, "nilai" => 90],
];

// ubah nilai angka jadi huruf dan bobot
function hitungBobot($nilai) {
    if ($nilai >= 80) {
        return ["huruf" => "A", "bobot" => 4.0];
    } elseif ($nilai >= 70) {
        return ["huruf" => "B", "bobot" => 3.0];
    } elseif ($nilai >= 60) {
        return ["huruf" => "C", "bobot" => 2.0];
    } elseif ($nilai >= 50) {
        return ["huruf" => "D", "bobot" => 1.0];
    } else {
        return ["huruf" => "E", "bobot" => 0.0];
    }
}

// hitung IPS
$total_sks = 0;
$total_mutu = 0;

foreach ($matkul as $mk) {
    $b = hitungBobot($mk["nilai"]);
    $total_sks += $mk["sks"];
    $total_mutu += $b["bobot"] * $mk["sks"];
}

$ips = $total_mutu / $total_sks;

// batas sks semester depan
if ($ips >= 3.00) {
    $maks_sks = 24;
} else {
    $maks_sks = 20;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Nilai Semester</title>
    <style>
        table { border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 6px 12px; }
        .merah { background-color: red; color: white; }
    </style>
</head>
<body>
    <h2>Daftar Nilai Semester</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai</th>
            <th>Huruf</th>
            <th>Status</th>
        </tr>
        <?php foreach ($matkul as $i => $mk):
            $b = hitungBobot($mk["nilai"]);
            $status = $b["bobot"] >= 2.0 ? "LULUS" : "MENGULANG";
        ?>
        <tr class="<?= $status == 'MENGULANG' ? 'merah' : '' ?>">
            <td><?= $i + 1 ?></td>
            <td><?= $mk["nama"] ?></td>
            <td><?= $mk["sks"] ?></td>
            <td><?= $mk["nilai"] ?></td>
            <td><?= $b["huruf"] ?></td>
            <td><?= $status ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Ringkasan IPS</h3>
    <p>Total SKS: <?= $total_sks ?></p>
    <p>IPS: <?= number_format($ips, 2) ?></p>
    <p>Maksimal SKS semester depan: <?= $maks_sks ?> SKS</p>
</body>
</html>
