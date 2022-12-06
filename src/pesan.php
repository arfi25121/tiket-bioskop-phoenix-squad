<?php
require __DIR__ . '/include/lib.php';
$title = 'Pesan Tiket';
require __DIR__ . '/include/header_user.php';
$path_to_img_film = './static/images/';

$q = $db->prepare("SELECT * FROM `film` where id=:id");
$q->execute(['id' => $_GET['id']]);
$row = $q->fetch();
if (!$row) {
    exit('Film tidak ditemukan!');
}

$q = $db->prepare("SELECT no_kursi FROM `jadwal_kursi` where id_jadwal=:id_jadwal and jam=:jam");
$q->execute(['id_jadwal' => $_GET['id_jadwal'], 'jam' => $_GET['jam']]);
$kursi_terisi = $q->fetchAll();
$tmp = [];
foreach ($kursi_terisi as $k) {
    $tmp[] = $k['no_kursi'];
}
$kursi_terisi = $tmp;
?>
<script src="/static/js/vue.global.js"></script>
<script src="/static/js/axios.min.js"></script>

<style>
    td:hover {
        background-color: antiquewhite;
    }

    .pointer {
        cursor: pointer;
    }

    table td {
        cursor: pointer;
    }
</style>
<div class="main-container" id="app">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <!-- multiple select row Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h1 class="text-dark h3">Pesan Tiket</h1>
                    <p>Judul Film: <?= $row['judul'] ?></p>
                </div>
                <div class="pb-20 row">
                    <div class="col-12 col-lg-6">
                        <span class="px-4">Pilih posisi kursi yang ingin dipesan</span>
                        <div class="p-3">
                            <table border="1" class="table nowrap text-center">
                                <?php
                                $number = range(1, $total_kursi);
                                $number = custom_chunk($number, $total_kursi / 10);
                                foreach ($number as $num) {
                                    echo '<tr>';
                                    foreach ($num as $no) {
                                        if (in_array($no, $kursi_terisi)) {
                                            echo '<td style="background-color: #de2121;color:white">' . $no . '</td>';
                                        } else {
                                            echo "<td @click=\"tambah($no)\" id='s$no' ref=\"$no\">$no</td>";
                                        }
                                    }
                                    echo '</tr>';
                                }
                                ?>
                                <!-- echo "
                                -->
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="px-4">
                            <span class="h3">Booking Summary</span>
                            <div class="row">
                                <div class="d-flex col-12" v-for="kursi in pilih_kursi">
                                    <div class="col-3">
                                        Kursi #{{kursi}}
                                    </div>
                                    <div class="col-4 p-0">
                                        Rp{{per_bangku}}
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-danger btn-sm p-0 m-0 px-2 mx-0" @click=hapus({kursi})>Hapus</button>
                                    </div>
                                </div>

                            </div>
                            <div class="mt-5">Total Rp{{pilih_kursi.length*per_bangku}}</div>
                            <button class="btn btn-success btn-sm my-2 w-100" @click=bayar>Bayar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            const {
                createApp
            } = Vue

            createApp({
                data() {
                    return {
                        per_bangku: <?= $row['harga_tiket'] ?>,
                        pilih_kursi: [],
                        id_pembelian: false
                    }
                },
                methods: {
                    bayar() {

                        const urlParams = new URLSearchParams(window.location.search);
                        const id = urlParams.get('id');
                        const id_jadwal = urlParams.get('id_jadwal');
                        const jam = urlParams.get('jam');
                        const tanggal = urlParams.get('tanggal');

                        // join pilih_kursi to string
                        var kursi_data = this.pilih_kursi.join(',');
                        var params = new URLSearchParams();
                        params.append('kursi', kursi_data)
                        params.append('id_film', id)
                        params.append('id_jadwal', id_jadwal)
                        params.append('jam', jam)
                        params.append('tanggal', tanggal)
                        axios.post('/api.php?order=ticket', params)
                            .then((response) => {
                                // console.log(response);
                                // this.id_pembelian = response.data.id_pembelian;
                                window.location.href = '/invoice?id=' + response.data.id_pembelian;
                            })
                            .catch(function(error) {
                                console.log(error);
                            });
                    },
                    'hapus': function(kursi) {
                        let kur = kursi.kursi
                        let c = document.getElementById('s' + kursi.kursi)
                        console.log(c)
                        c.style.background = 'white'
                        c.style.color = 'black'
                        let tmp = [];
                        this.pilih_kursi.map(function(value, key) {
                            if (value != kur) {
                                tmp.push(value)
                            }
                        });
                        this.pilih_kursi = tmp
                    },
                    'cek': function(kursi) {
                        let a = true
                        for (let i = 0; i < this.pilih_kursi.length; i++) {
                            if (this.pilih_kursi[i] == kursi) {
                                a = false
                            }
                        }
                        return a
                    },
                    'tambah': function(kursi) {
                        console.log(kursi)
                        if (this.cek(kursi)) {
                            let x = document.getElementById('s' + kursi);
                            x.style.background = 'green'
                            x.style.color = 'white'
                            this.pilih_kursi.push(kursi)
                            console.log(this.pilih_kursi.indexOf(kursi))
                        } else {
                            // alert('sudah ditambahkan')
                        }

                    },
                    'alert': function(id) {
                        alert(id);
                    }
                }
            }).mount('#app')
        </script>


        <?php require __DIR__ . '/include/footer.php'; ?>