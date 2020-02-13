-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.6.26 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for dbinta
CREATE DATABASE IF NOT EXISTS `dbinta` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dbinta`;

-- Dumping structure for table dbinta.tblmerk
CREATE TABLE IF NOT EXISTS `tblmerk` (
  `id_merk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_merk` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_merk`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table dbinta.tblmerk: ~5 rows (approximately)
/*!40000 ALTER TABLE `tblmerk` DISABLE KEYS */;
INSERT INTO `tblmerk` (`id_merk`, `nama_merk`) VALUES
	(1, 'asus'),
	(2, 'oppo'),
	(3, 'samsung'),
	(4, 'vivo'),
	(5, 'xiaomi');
/*!40000 ALTER TABLE `tblmerk` ENABLE KEYS */;

-- Dumping structure for table dbinta.tblreview
CREATE TABLE IF NOT EXISTS `tblreview` (
  `id_review` int(11) NOT NULL,
  `id_merk` int(11) DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `isi_review` text,
  PRIMARY KEY (`id_review`),
  KEY `id_merk` (`id_merk`),
  CONSTRAINT `FK_tblreview_tblmerk` FOREIGN KEY (`id_merk`) REFERENCES `tblmerk` (`id_merk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dbinta.tblreview: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblreview` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblreview` ENABLE KEYS */;

-- Dumping structure for table dbinta.tblsentimen
CREATE TABLE IF NOT EXISTS `tblsentimen` (
  `id_sentimen` int(11) NOT NULL AUTO_INCREMENT,
  `id_merk` int(11) DEFAULT NULL,
  `terms` text,
  `clasification` varchar(50) DEFAULT NULL,
  `desc` text,
  `ket` char(1) DEFAULT '0',
  PRIMARY KEY (`id_sentimen`),
  KEY `id_merk` (`id_merk`),
  CONSTRAINT `FK_tblsentimen_tblmerk` FOREIGN KEY (`id_merk`) REFERENCES `tblmerk` (`id_merk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=445 DEFAULT CHARSET=latin1;

-- Dumping data for table dbinta.tblsentimen: ~84 rows (approximately)
/*!40000 ALTER TABLE `tblsentimen` DISABLE KEYS */;
INSERT INTO `tblsentimen` (`id_sentimen`, `id_merk`, `terms`, `clasification`, `desc`, `ket`) VALUES
	(361, 3, 'gina hp nya jelek tinggal omong bang gampang', 'Negatif', 'samsung-0', '0'),
	(362, 3, 'kls 1 nih jamanya pakai fisheye aplikasi foto retrika pakai hp teman jelek banget kamera pakai c360', 'Negatif', 'samsung-1', '1'),
	(363, 3, 'auto fokus jelek sumpah', 'Negatif', 'samsung-2', '1'),
	(364, 3, 'hp gue filter jelekv', 'Negatif', 'samsung-3', '1'),
	(365, 3, 'ih coba foto pakai jelek', 'Negatif', 'samsung-4', '1'),
	(366, 3, 'gewla iphone boros batrenya pakai android batre 5000 mah jungkir pakai hp bego pakai iphone batas syekali guna batrenya tcktcktck', 'Positif', 'samsung-5', '0'),
	(367, 3, 'bentar mohon maaf note baterenya boros banget hari 2x charge lihat fancam jernih jdnya pengin ganti ipon gaptek bikin tarik ulur', 'Negatif', 'samsung-6', '1'),
	(368, 3, 'a50 kurang ngecharge maenin langsung cabut pas banget penuh bikin batre kembung boros kaya wkwkwk', 'Negatif', 'samsung-7', '1'),
	(369, 3, 'awet boros storage', 'Negatif', 'samsung-8', '1'),
	(370, 3, 'sayang instagram jelek huhu ip', 'Negatif', 'samsung-9', '0'),
	(371, 3, 'ih tahi gue gemar flagship nya cannot deny kamera jelek banget jir', 'Negatif', 'samsung-10', '1'),
	(372, 3, 'batrenya boros banget kntl', 'Negatif', 'samsung-11', '1'),
	(373, 3, 'malah oyy design jelek mending beli motorola razr 2019 inspirasi sono mah follower lihat barang bagus dikit', 'Negatif', 'samsung-12', '1'),
	(374, 3, '5 pakai alhamdulillah awet batreinya boros sih maklum makenya apa makenya barbar wkwkwkwk jatuh berkalikali', 'Positif', 'samsung-13', '1'),
	(375, 3, 'a50 kurang ngecharge maenin langsung cabut pas banget penuh bikin batre kembung boros kaya wkwkwk', 'Negatif', 'samsung-14', '1'),
	(376, 3, 'bagus', 'Positif', 'samsung-15', '1'),
	(377, 3, 'a20s cinta mati produk wkwk ganti hati btw kamera bagus kayak lihat nyata batrenya awet harga murah riah rekomen cari hp under 3jt 25an', 'Positif', 'samsung-16', '1'),
	(378, 3, 'pacar kayak hp awet', 'Negatif', 'samsung-17', '1'),
	(379, 3, 'a71 bagus banget', 'Positif', 'samsung-18', '1'),
	(380, 3, 'pakai galaxy s4 upgrade s5 pas kelas 2 lcd rusak gara gara jatuh pas kuliah sem 3 kamera bagus banget masuk ig pecah samsek kayak pakai ip awet banding android memoristorage hapus app ngaruh pas install hh', 'Positif', 'samsung-19', '1'),
	(381, 3, 'galaxy a51 camera review super steady baik', 'Positif', 'samsung-20', '1'),
	(382, 3, 'yaallah harga galaxy fold bayar ukt gue 6x pusinggg bagus mimpi aja', 'Positif', 'samsung-21', '0'),
	(383, 3, 'guna seharihari series bagus', 'Positif', 'samsung-22', '1'),
	(384, 3, 'realme 5i low budget19an speknya lumayan batre awet puol', 'Positif', 'samsung-23', '1'),
	(385, 3, 'baik', 'Positif', 'samsung-24', '1'),
	(386, 3, 'orisinal bagus kisar 800900 ganti lcd jele 500700 orisinal 12jt mending beli hp nder rugi beli lcd mulu soalnyaa mas samsungnya lcdnya rentan banget j7pro deh ganti 3kali btw', 'Positif', 'samsung-25', '1'),
	(387, 3, 'andro bagus kamera', 'Positif', 'samsung-26', '1'),
	(388, 3, 'halo gina hp tuh galaxy star s5280 kayak nya bagus', 'Positif', 'samsung-27', '0'),
	(389, 3, 'fix pindah berapa kali tolong pakai teman hpku isi emoney hp tulis note feature multifungsi kepake iphone loh kamera hp relatif amp bagus sih fix', 'Positif', 'samsung-28', '0'),
	(390, 3, 'legasi note produk baik mantap bro', 'Positif', 'samsung-29', '1'),
	(391, 3, 'wow nia puk2 sabar alhamdulilah produk sih tuh beli hape 2017 pakai awet tuh paksa ganti tombol powernya rusak hhhaa jrg jajan gadget hhii', 'Positif', 'samsung-30', '0'),
	(392, 3, 'pakai j5 pro sih pakai jatuh lantai 2 tinggi2 banget sih lantai alhamdulilah kondisi masihh bagus', 'Positif', 'samsung-31', '1'),
	(393, 3, 'allah sesak banget lihat pakai hp kuat tahan banting banget jatuh ku ceroboh awet kak', 'Positif', 'samsung-32', '0'),
	(394, 3, 'eww font asli lebi bagus alay deh', 'Positif', 'samsung-33', '1'),
	(395, 3, 'flip bagus lihat harga nya 1920an juta', 'Positif', 'samsung-34', '1'),
	(396, 3, 'senang banget a51 batrenya awet banget pagi batrenya 100 38 cocok brand ambassador nih', 'Positif', 'samsung-35', '1'),
	(397, 3, 'kak pakai nya sih awet', 'Positif', 'samsung-36', '1'),
	(398, 3, 'awet banget kayak jarang bikin laptop', 'Positif', 'samsung-37', '1'),
	(399, 3, 'ih amah bagus banget love sampah habis sampah habis', 'Positif', 'samsung-38', '0'),
	(400, 3, 'ngeri rekam nya pakai mas pantesan kualitas gambar bagus', 'Positif', 'samsung-39', '1'),
	(401, 3, 'a71 bagus', 'Positif', 'samsung-40', '1'),
	(402, 3, 'baik turut', 'Positif', 'samsung-41', '1'),
	(403, 3, 'hp gue finger print layar bagus kalo enggak pakai pakai glass 4 coba pakai lindung eh baret2 gue benar tipe ngejaga hp banget geleta keinjek tas kegaret2 logam payah banget', 'Positif', 'samsung-42', '1'),
	(404, 3, 'semuanyaaaaa sukaaaaa dijelasinn wwkwk inti suka simple j6 is very simple kalo digunain neko neko awet batteray banget layar mini sedeng habis ringan berat suka', 'Positif', 'samsung-43', '1'),
	(405, 3, 'jaman beli hp android mahal mahal bawah 2 jtan bagus realistis fungsi', 'Positif', 'samsung-44', '0'),
	(406, 5, 'beli je high end within price range 1500selang 2 deh tukar beli spec latest beli iphone pakai buruk nak tunggu modal', 'Positif', 'xiaomi-0', '0'),
	(407, 5, 'gue fanboy btw kecewa pengin flagship resmi masuk seri redmi pocophone flagship jelek experiencenya gue pakai amazfit bip harga banding kualitas murah mi band gen mi band 4 kuciwa design nya', 'Negatif', 'xiaomi-1', '1'),
	(408, 5, 'softwarenya jelek kadang muncul bug location api habis diupdate', 'Negatif', 'xiaomi-2', '1'),
	(409, 5, 'yuk yuk gapapa jelek hp', 'Negatif', 'xiaomi-3', '0'),
	(410, 5, 'deh hp pakai kamera jelek banget thanks igs camera', 'Negatif', 'xiaomi-4', '1'),
	(411, 5, 'jelek sih palsu beli duit', 'Negatif', 'xiaomi-5', '1'),
	(412, 5, 'xiamoi yeayy', 'Negatif', 'xiaomi-6', '0'),
	(413, 5, 'cowok hp nya xiamoi buru deh cepat cepat ganti biar bilang fakboi', 'Negatif', 'xiaomi-7', '1'),
	(414, 5, 'deh ganti xiamoi deh gue', 'Negatif', 'xiaomi-8', '0'),
	(415, 2, 'boros aipon', 'Negatif', 'oppo-0', '0'),
	(416, 2, 'kamera jelek banget sih', 'Negatif', 'oppo-1', '1'),
	(417, 2, 'jam tangan item tas selempang item sepatu nike merah jaket gunung kaos merah powerbank hp sinyal jelek kalo vc ganteng walo buram', 'Negatif', 'oppo-2', '1'),
	(418, 2, 'pagi gue beli hp isi dunia bilang cie cie sombong hp derita tau sih awokawok asa salah ganti hp ganti hp buruk banget neo5 bayang betapa sabar', 'Negatif', 'oppo-3', '0'),
	(419, 2, 'lucu gaksi pakai emot mata betkaca kaca enggak ada jelek dasar', 'Negatif', 'oppo-4', '1'),
	(420, 2, 'lo lunayan lucu gue langka jelek', 'Negatif', 'oppo-5', '0'),
	(421, 2, 'emojinya jelek banget ih', 'Negatif', 'oppo-6', '1'),
	(422, 2, 'mundur desain layar fullscreen bagus pakai layar poni', 'Positif', 'oppo-7', '1'),
	(423, 2, 'gue pengin beli iphone giur batre awet cus beli rumah mikir kapai beli iphone android kapai beli android gobs', 'Negatif', 'oppo-8', '0'),
	(424, 2, 'lumayan bagus edit a1k', 'Positif', 'oppo-9', '1'),
	(425, 2, 'amp realme bagus ui kamera', 'Positif', 'oppo-10', '1'),
	(426, 2, 'neo 7 2016 wkwkwkwk bagus banget gila', 'Positif', 'oppo-11', '1'),
	(427, 2, '5 hp baik kamera ciamik content creator mula wajib', 'Positif', 'oppo-12', '1'),
	(428, 2, 'find x2 hadir bawa teknologi layar canggih alam baik konsumen vp brian shen muka kagum teknologi', 'Positif', 'oppo-13', '1'),
	(429, 2, 'pakai oase awet real cas', 'Positif', 'oppo-14', '1'),
	(430, 2, 'awet sorry', 'Positif', 'oppo-15', '1'),
	(431, 2, 'hpku 1 kuliah semester 2 awet', 'Positif', 'oppo-16', '1'),
	(432, 2, 'mirror 5 2015 keluar bilang bagus', 'Positif', 'oppo-17', '1'),
	(433, 2, 'f11 kamera bagus memori internal 128gb ram 4gb 32jt', 'Positif', 'oppo-18', '1'),
	(434, 2, 'rt doitbetter with nikmat kualitas suara baik unggul teknologi audio khas dolby atmos', 'Positif', 'oppo-19', '1'),
	(435, 2, 'a37 kamera bagus nder banyak coba suka kamera a37 sih', 'Positif', 'oppo-20', '1'),
	(436, 2, 'awet banget a57 2016 kendala body doang baret karuan', 'Positif', 'oppo-21', '1'),
	(437, 2, 'terima kasih terima kasih a37 btw pandang bagus', 'Positif', 'oppo-22', '1'),
	(438, 2, 'hp ram 6gb baik spesifikasi fitur mumpuni', 'Positif', 'oppo-23', '1'),
	(439, 2, 'filter 1 lapis snapchat cuman kamera bagus sih cakep wkwk jawab situasi kayak', 'Positif', 'oppo-24', '0'),
	(440, 2, 'gua deh bagus batrenya anjay', 'Positif', 'oppo-25', '0'),
	(441, 2, 'bawa hape 3 awet', 'Positif', 'oppo-26', '0'),
	(442, 2, 'bagus sih kesh tonton review 2020 mending beli sesuai speknya a9a5 2020 edition', 'Positif', 'oppo-27', '0'),
	(443, 2, 'a9 2020batrenya awet', 'Positif', 'oppo-28', '0'),
	(444, 2, 'bagus mbak', 'Positif', 'oppo-29', '0');
/*!40000 ALTER TABLE `tblsentimen` ENABLE KEYS */;

-- Dumping structure for table dbinta.tbltopik
CREATE TABLE IF NOT EXISTS `tbltopik` (
  `id_topik` int(11) NOT NULL AUTO_INCREMENT,
  `terms` text,
  `clasification` varchar(50) DEFAULT NULL,
  `desc` text,
  `ket` char(1) DEFAULT '0',
  PRIMARY KEY (`id_topik`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=latin1;

-- Dumping data for table dbinta.tbltopik: ~5 rows (approximately)
/*!40000 ALTER TABLE `tbltopik` DISABLE KEYS */;
INSERT INTO `tbltopik` (`id_topik`, `terms`, `clasification`, `desc`, `ket`) VALUES
	(198, 'tokopedia asli keren cerdas nih sponsorin indonesian idol pakai bonus 3 vote parah pas tutorial pakai hp ku kalo tokped kerjasama bts makan pakai', 'Non Elektronik', '0', '1'),
	(199, 'kapasitas otak pas comeback sadang minim kayak storage hp hapus data gegara panuah memori huhu liek teori tebar akutu bangga samo cari celah teori nya', 'Elektronik', '1', '1'),
	(200, 'rlt guyss powerbank rusak 5 mending beli saran original mahal mahal kalo pakai pb pic review makasihh', 'Elektronik', '2', '1'),
	(201, 'hp nya maa', 'Non Elektronik', '3', '0'),
	(202, 'spg hp vivo mbx brosurx', 'Non Elektronik', '4', '1');
/*!40000 ALTER TABLE `tbltopik` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
