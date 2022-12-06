-- Adminer 4.8.1 MySQL 8.0.27 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `film`;
CREATE TABLE `film` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `durasi` int NOT NULL,
  `tanggal_rilis` date NOT NULL,
  `sinopsis` varchar(4250) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `penulis` varchar(30) DEFAULT NULL,
  `produser` varchar(30) DEFAULT NULL,
  `sutradara` varchar(30) DEFAULT NULL,
  `film_photo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `harga_tiket` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1024;

INSERT INTO `film` (`id`, `judul`, `durasi`, `tanggal_rilis`, `sinopsis`, `penulis`, `produser`, `sutradara`, `film_photo`, `harga_tiket`) VALUES
(1012,	'ELVIS',	159,	'2014-05-17',	'Perjalanan masa kecil di Tupelo, Mississippi hingga awal ketenarannya di Memphis, Tennessee lalu perjalanan sukses besar di Las Vegas, Elvis Presley menjadi bintang rock n roll pertama yang mengubah dunia dengan musiknya.',	'Baz Luhrmann',	'Baz Luhrmann',	'Baz Luhrmann',	'Qcseof7smIC4kcOXucmjv1N0f1nLjd6kZA0hhqwVYD08fWEaeM.jpg',	45000),
(1013,	'JugJugg Jeeyo',	150,	'2016-03-11',	'“JugJugg Jeeyo” adalah cerita yang berlatar di Patiala, serupa dengan kotanya penuh dengan cinta dan tawa, warna, dan drama.\r\nSudah lima tahun sejak Kuku dan Naina menikah setelah saling mengenal hampir sepanjang hidup mereka. Mereka merencanakan perjalanan ke India tanpa menyadari fakta bahwa orang tua Kuku, Bheem dan Geeta, pasangan yang dikagumi semua orang & ternyata mempunyai kejutan untuk semua orang. Semuanya terjadi di tengah berlangsungnya pernikahan saudara perempuan Kuku.\r\n\r\n“JugJugg Jeeyo” is a story set in the heart of Patiala and much like the city, it’s full of love and laughter, colour and drama. Its been five years since Kuku and Naina got married after knowing each other practically all their lives. They plan a travel to India with a lot of surprises unaware about the fact that Kuku’s parents, Bheem and Geeta, a couple that everyone looks upto, have their own set of surprises in store for everybody. All of this in the middle of Kuku’s sister’s wedding underway. It’s about family and its’ values, unresolved yearnings and unexpected reconciliations.',	'Anurag Singh',	'Raj Mehta',	'Raj Mehta',	'oUcrInCwMaePcXIvpABVNFB9rMROgNT2EHg2xiH2jTCNRMt0Ct.jpg',	55000),
(1014,	'THE AMBUSH',	113,	'2017-08-09',	'Ketika tiga tentara Uni Emirat Arab disergap di wilayah yang bermusuhan, komandan mereka memimpin misi berani untuk menyelamatkan mereka.',	'Pierre Morel',	'Pierre Morel',	'Pierre Morel',	'iqFG72tX5p2gIES4DhK2VNNIYRb0UIgs6KRs4kSDRANGzdezyw.jpg',	45000),
(1015,	'INVISIBLE HOPES',	120,	'2015-08-30',	'Invisible Hopes adalah film pertama di Indonesia yang mengungkapkan kehidupan nyata anak-anak yang lahir dari ibu narapidana yang terpaksa hidup dan menjadi korban terselebung dibalik jeruji penjara.\r\n\r\nAnggrek dan banyak anak lainnya, semenjak lahir harus hidup dalam sel kecil yang sempit, kehilangan kebebasan dan diperlakukan seperti narapidana. Mereka menjadi korban terselubung diantara suramnya kehidupan penjara dan perjuangan ibu mereka untuk bertahan hidup dalam penjara dengan cara apapun bahkan dengan cara yang tidak pernah kita bayangkan.\r\n\r\nMasih adakah harapan untuk mereka?',	'Lamtiar Simorangkir',	'Lamtiar Simorangkir',	'Lamtiar Simorangkir',	'kltdF55GqLW37qYZj9BCVllFhGLiiqlOCw6ZBJQjUngVVg3KUo.jpeg',	50000),
(1016,	'SHABAASH MITHU',	305,	'2011-07-11',	'Film biografi berdasarkan kehidupan dan perjuangan Mithali Raj, Pemain Kriket India, dan kapten tim Kriket Nasional wanita India.',	'Srijit Mukherji',	'Srijit Mukherji',	'Srijit Mukherji',	'3kV9ymxbWEmJ1CimFJnkHcjOY70V8a91uqrMKxYGcYrGawTRp1.jpeg',	55000),
(1017,	'TOP GUN: MAVERICK',	130,	'2022-07-29',	'Setelah lebih dari tiga puluh tahun, para awak kembali dengan pesawat tempur baru yang lebih canggih. Dipimpin oleh pilot senior bernama Pete \'Marvick\' Mitchell (Tom Cruise).',	'Joseph Kosinski',	'Joseph Kosinski',	'Joseph Kosinski',	'dkRXlsJCJVqFg7DmFUIdghC9SemT2yQt1823ckQukJ2egDHPZ3.jpg',	55000),
(1018,	'KELUARGA CEMARA 2',	114,	'2016-04-07',	'Setelah jatuh miskin, Emak dan Abah bertahan hidup di desa. Ingin sejahtera, tapi lupa dengan kebahagiaan anak-anaknya.\r\n\r\nAbah sibuk dengan pekerjaan barunya, tak bisa tiap hari antar jemput anak-anaknya. Emak mencari sampingan agar keluarganya punya pendapatan tambahan dan juga tabungan. Sedangkan Euis masuk masa pubernya, ia ingin punya privasi dan tak mau lagi sekamar dengan Ara. Merasa diabaikan, Ara membuat ulah hingga kabur dari rumah. Ia merasa rumahnya bukan lagi istana yang paling indah. Keluarganya sudah berubah.\r\n\r\nBisakah Abah dan Emak melewati masa sulit dan berkumpul lagi dengan harta berharganya?',	'M. Irfan Ramli',	'Ismail Basbeth',	'Ismail Basbeth',	'9kSq3r7Z04uF3J2DaUzodQXkPkVLu5HX2XGiZi7mKENzyDq8ZB.jpg',	60000),
(1019,	'RANAH 3 WARNA',	128,	'2018-07-14',	'Alif Fikri tak pernah ingin bersaing dengan Randai, sahabat satu kampungnya. Namun, entah mengapa, Randai selalu menjadi bayang-bayang pencapaian Alif, baik dalam pendidikan maupun kisah cintanya. Alif berhasil kuliah di UNPAD, namun Randai berhasil masuk ITB lebih dulu, sebagaimana yang dicita-citakan Alif awalnya. Alif jatuh hati pada Raisa yang satu kampus dengannya, namun ternyata Randai jatuh hati juga kepada Raisa dan selalu berusaha mengambil hati Raisa. Beban hidup semakin berat setelah Ayah Alif meninggal dunia, dimana Alif harus berjuang agar bisa terus kuliah, sementara Randai terus melaju lewat prestasinya. Alif benar-benar diuji kesabarannya untuk mempertahankan persahabatan dan cintanya juga menyelesaikan kuliahnya',	'Alim Sudio',	'Guntur Soeharjanto',	'Guntur Soeharjanto',	'Z7bqx7fHmXkendaC29KpmpToo8mqpMG2Pu5iY2NO54Tq7Lu7cd.jpg',	55000),
(1020,	'JURASSIC WORLD DOMINION',	150,	'2014-09-08',	'Empat tahun setelah kehancuran Pulau Nublar, Dinosaurus sekarang hidup dan berburu berdampingan dengan manusia. Keseimbangan yang rentan ini akan menentukan: Apakah manusia akan tetap berada di puncak rantai makanan ketika berbagi teritori dengan makhluk paling menakutkan dalam sejarah bumi?',	'Colin Trevorrow',	'Colin Trevorrow',	'Colin Trevorrow',	'WJ3BaVMDepG979OPFiYZbebTYdWgBPMhVEzwWvpxcCmRttXP5S.jpg',	50000),
(1021,	'IVANNA',	180,	'2022-02-22',	'Sejak kematian ayah dan ibunya, Ambar dan Dika pindah ke sebuah panti jompo milik sahabat orang tua mereka dan anaknya, Agus. Panti Jompo Masa Toea merumahi tiga orang; Nenek Ani, Kakek Farid, dan Oma Ida. Ketiganya diurus oleh Rani, seorang suster yang juga pacar Agus. Tidak lama setelah kepindahan Ambar dan Dika, cucu Oma Ida, Arthur, datang untuk merayakan Idul Fitri bersama sang nenek.\r\n\r\nAmbar yang kini memiliki kemampuan untuk melihat hal-hal mistis, secara tidak sengaja mendapatkan penglihatan dari masa lalu yang terjadi rumah panti tersebut. Ia tanpa sengaja melihat seorang perempuan Belanda yang mengalami sebuah kejadian tragis di masa penjajahan Jepang.\r\n\r\nSetelah kejadian penglihatan tersebut,serangkaian kejadian mistis pun mulai menghantui Ambar dan seluruh penghuni panti jompo, terlebih setelah mereka menemukan sebuah patung tanpa kepala di ruang bawah tanah beserta dengan piringan hitam yang berisi lagu menyeramkan.\r\n\r\nDi Hari Lebaran, keadaan semakin mencekam ketika Ambar dan penghuni panti menemukan salah satu dari mereka meninggal tragis penuh darah. Tragedi kelam di hari lebaran itu membuat semua orang panik,tiba-tiba seluruh keselamatan penghuni panti terancam. Ambar dan sisa penghuni panti dituntut untuk menyelesaikan misteri kelam yang terjadi pada masa lalu di panti tersebut, sebelum entitas jahat yang penuh dendam mengambil kepala mereka.',	'Kimo Stamboel',	'Kimo Stamboel',	'Kimo Stamboel',	'vUM7GHMs5ToNTuos3YaW3GlroOUahIWUus5kKAQRnbkuG760a7.jpg',	45000),
(1022,	'THOR: LOVE AND THUNDER',	120,	'2011-02-24',	'Masa pensiun Thor terganggu oleh kehadiran pembunuh antar galaksi yang dikenal sebagai Gorr the God Butcher, yang yang bertujuan memusnahkan para dewa. Untuk melawan ancaman tersebut, Thor meminta bantuan King Valkyrie, Korg dan mantan pacarnya Jane Foster, yang mengejutkan Thor ternyata menggunakan palu ajaibnya, Mjolnir, The Mighty Thor . Bersama-sama, mereka memulai petualangan kosmik yang menegangkan untuk mengungkap dendam dari sang pembandai dewa dan menghentikannya sebelum terlambat.\r\n\r\nThor\'s retirement is interrupted by a galactic killer known as Gorr the God Butcher, who seeks the extinction of the gods. To combat the threat, Thor enlists the help of King Valkyrie, Korg and ex-girlfriend Jane Foster, who - to Thor\'s surprise - inexplicably wields his magical hammer, Mjolnir, as the Mighty Thor. Together, they embark upon a harrowing cosmic adventure to uncover the mystery of the God Butcher\'s vengeance and stop him before it\'s too late.',	'Stan Lee',	'Taika Waititi',	'Taika Waititi',	'cv1tYJfdNxR1Az2hq5bcDPSol9Quifs0Xy09FiYWIxL4K2iP6A.jpg',	50000),
(1023,	'EVERYTHING EVERYWHERE ALL AT ONCE',	180,	'2020-05-26',	'Disutradarai oleh Daniel Kwan dan Daniel Scheinert, yang lebih dikenal sebagai Daniels, Everything Everywhere All At Once adalah petualangan yang penuh aksi, sci-fi yang lucu dan berjiwa besar tentang seorang wanita Cina-Amerika (Michelle Yeoh), Seorang imigran Tiongkok terbawa dalam petualangan luar biasa, di mana dia sendiri yang dapat menyelamatkan dunia dengan menjelajahi alam semesta lain yang terhubung dengan kehidupan yang bisa dia jalani.\r\n\r\nAll At Once is a hilarious and big-hearted sci-fi action adventure about an exhausted Chinese American woman (Michelle Yeoh) who can\'t seem to finish her taxes.',	'Daniel Scheinert',	'Daniel Scheinert',	'Daniel Scheinert',	'64WYd6dMw2E43uQfK28ldgSrt4xdyGgwMSsnscKhKjSOMV9D5i.jpeg',	50000);

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `jadwal_film`;
CREATE TABLE `jadwal_film` (
  `id_jadwal` int NOT NULL AUTO_INCREMENT,
  `id_film` int NOT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=8;

INSERT INTO `jadwal_film` (`id_jadwal`, `id_film`) VALUES
(7,	1001);

DROP TABLE IF EXISTS `jadwal_kursi`;
CREATE TABLE `jadwal_kursi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_jadwal` int NOT NULL,
  `id_pembelian` int DEFAULT NULL,
  `no_kursi` int NOT NULL,
  `user_id` int NOT NULL,
  `jam` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jadwal` (`id_jadwal`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9142;


DROP TABLE IF EXISTS `jadwal_waktu`;
CREATE TABLE `jadwal_waktu` (
  `id_jadwal` int NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `jam` varchar(100) NOT NULL,
  KEY `id_jadwal` (`id_jadwal`),
  CONSTRAINT `jadwal_waktu_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_film` (`id_jadwal`)
) ENGINE=InnoDB;


DROP TABLE IF EXISTS `pembelian_tiket`;
CREATE TABLE `pembelian_tiket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_jadwal_film` int NOT NULL,
  `id_user` int NOT NULL,
  `status` varchar(30) NULL,
  `total` int NOT NULL,
  `tanggal_tayang` varchar(30) NOT NULL,
  `jam` varchar(30) NOT NULL,
  `tanggal` datetime NOT NULL,
  `judul_film` varchar(50) DEFAULT NULL,
  `durasi_film` int DEFAULT NULL,
  `harga_per_tiket` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_jadwal_film` (`id_jadwal_film`),
  CONSTRAINT `pembelian_tiket_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=523530;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `sebagai` varchar(30) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(30) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9;

INSERT INTO `users` (`id`, `email`, `password`, `sebagai`, `no_hp`, `nama`, `jenis_kelamin`, `alamat`) VALUES
(2,	'u2@pausi.id',	'u2@pausi.id',	'user',	NULL,	'Ahmad Pausi',	NULL,	'Tangerang'),
(4,	'u1@pausi.id',	'u1@pausi.id',	'admin',	'9283923223',	'Pausi Ganteng',	'Laki-laki',	'Tangerang'),
(7,	'zeerx7@gmail.com',	'zeerx7@gmail.com',	'admin',	'08953255855',	'Anji',	'Perempuan',	'Tangerang'),
(8,	'afri@gmail.com',	'afri@gmail.com',	'user',	'0829298322',	'Afri',	'Perempuan',	'Jakarta Selatan');

DROP TABLE IF EXISTS `visitor_counter`;
CREATE TABLE `visitor_counter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `total` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8;

INSERT INTO `visitor_counter` (`id`, `tanggal`, `total`) VALUES
(2,	'2021-06-12',	27),
(3,	'2022-07-12',	104),
(4,	'2022-06-03',	27),
(5,	'2022-07-09',	213),
(6,	'2022-07-04',	10),
(7,	'2022-07-14',	431);

-- 2022-07-14 19:52:30