<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbarsideleft = array(
		array(
			'path' => 'home', 
			'label' => 'Dashboard', 
			'icon' => '<i class="fa fa-dashboard "></i>'
		),
		
		array(
			'path' => 'menu19', 
			'label' => 'Master', 
			'icon' => '<i class="fa fa-gear "></i>',
'submenu' => array(
		array(
			'path' => 'penerima', 
			'label' => 'Ruangan', 
			'icon' => '<i class="fa fa-users "></i>'
		),
		
		array(
			'path' => 'pemberi', 
			'label' => 'Pemberi', 
			'icon' => '<i class="fa fa-user "></i>'
		),
		
		array(
			'path' => 'goldar', 
			'label' => 'Goldar', 
			'icon' => '<i class="fa fa-tint "></i>'
		),
		
		array(
			'path' => 'jenis_darah', 
			'label' => 'Jenis Darah', 
			'icon' => '<i class="fa fa-tint "></i>'
		),
		
		array(
			'path' => 'perawat', 
			'label' => 'Perawat', 
			'icon' => '<i class="fa fa-user-md "></i>'
		),
		
		array(
			'path' => 'petugas_lab', 
			'label' => 'Petugas Lab', 
			'icon' => '<i class="fa fa-user-secret "></i>'
		)
	)
		),
		
		array(
			'path' => 'transaksi', 
			'label' => 'Bank Darah', 
			'icon' => '<i class="fa fa-tint "></i>',
'submenu' => array(
		array(
			'path' => 'transaksi', 
			'label' => 'Transaksi', 
			'icon' => '<i class="fa fa-exchange "></i>'
		),
		
		array(
			'path' => 'transaksi/pengembalian', 
			'label' => 'Pengembalian', 
			'icon' => '<i class="fa fa-sign-out "></i>'
		),
		
		array(
			'path' => 'transaksi/rujukanpmi', 
			'label' => 'Rekap Rujukan PMI', 
			'icon' => '<i class="fa fa-book "></i>'
		),
		
		array(
			'path' => 'transaksi/reaksi_transfusi', 
			'label' => 'Reaksi Transfusi', 
			'icon' => '<i class="fa fa-user-times "></i>'
		),
		
		array(
			'path' => 'transaksi/phlebotomy_list', 
			'label' => 'Phlebotomy', 
			'icon' => '<i class="fa fa-tint "></i>'
		)
	)
		),
		
		array(
			'path' => 'menu6', 
			'label' => 'Dropping', 
			'icon' => '<i class="fa fa-sign-in "></i>',
'submenu' => array(
		array(
			'path' => 'transaksi/tambahdropping', 
			'label' => 'Tambah Data Dropping', 
			'icon' => '<i class="fa fa-plus-square "></i>'
		),
		
		array(
			'path' => 'v_dropping_bulan_ini', 
			'label' => 'Dropping Rekap', 
			'icon' => '<i class="fa fa-file-text "></i>'
		),
		
		array(
			'path' => 'transaksi/dropping', 
			'label' => 'Dropping Detail', 
			'icon' => '<i class="fa fa-sign-in "></i>'
		)
	)
		),
		
		array(
			'path' => 'detail_labu', 
			'label' => 'Pengambilan Darah', 
			'icon' => '<i class="fa fa-hand-lizard-o "></i>'
		),
		
		array(
			'path' => 'transaksi/registerbdrs', 
			'label' => 'Register Bank Darah', 
			'icon' => '<i class="fa fa-book "></i>'
		),
		
		array(
			'path' => 'rekap_stok', 
			'label' => 'Rekap Stok', 
			'icon' => '<i class="fa fa-calculator "></i>'
		),
		
		array(
			'path' => 'menu7', 
			'label' => 'Laporan', 
			'icon' => '<i class="fa fa-file-text "></i>',
'submenu' => array(
		array(
			'path' => 'v_register_bankdarah', 
			'label' => 'Register Bank Darah', 
			'icon' => '<i class="fa fa-file-text "></i>'
		),
		
		array(
			'path' => 'kultur', 
			'label' => 'Kultur', 
			'icon' => '<i class="fa fa-file-text "></i>'
		),
		
		array(
			'path' => 'v_pengembalian', 
			'label' => 'Rekap Pengembalian Darah', 
			'icon' => '<i class="fa fa-file-text "></i>'
		),
		
		array(
			'path' => 'v_rekaprujukanpmi', 
			'label' => 'Rekap Rujukan PMI', 
			'icon' => '<i class="fa fa-file-text "></i>'
		),
		
		array(
			'path' => 'dropping', 
			'label' => 'Dropping Rekap', 
			'icon' => '<i class="fa fa-file-text "></i>'
		),
		
		array(
			'path' => 'v_dropping_detail', 
			'label' => 'Dropping Detail', 
			'icon' => '<i class="fa fa-file-text "></i>'
		),
		
		array(
			'path' => 'v_reaksi_transfusi', 
			'label' => 'Reaksi Transfusi', 
			'icon' => '<i class="fa fa-file-text "></i>'
		),
		
		array(
			'path' => 'rekap_harian', 
			'label' => 'Rekap Harian', 
			'icon' => '<i class="fa fa-file-text "></i>'
		),
		
		array(
			'path' => 'incompatible', 
			'label' => 'Incompatible', 
			'icon' => '<i class="fa fa-file-text "></i>'
		),
		array(
			'path' => 'thalasemiamayor', 
			'label' => 'Thalasemia Mayor', 
			'icon' => '<i class="fa fa-file-text "></i>'
		)
	)
		),
		
		array(
			'path' => 'formulir', 
			'label' => 'Formulir', 
			'icon' => '<i class="fa fa-file-text "></i>'
		)
	);
		
	
	
			public static $pmi = array(
		array(
			"value" => "Kota", 
			"label" => "Kota", 
		),
		array(
			"value" => "Kabupaten", 
			"label" => "Kabupaten", 
		),);
		
			public static $kondisi = array(
		array(
			"value" => "Belum", 
			"label" => "Belum Terpenuhi", 
		),
		array(
			"value" => "Ready", 
			"label" => "Ready", 
		),
		array(
			"value" => "Dropping", 
			"label" => "Dropping", 
		),
		array(
			"value" => "Selesai", 
			"label" => "Selesai", 
		),
		array(
			"value" => "StockAwal", 
			"label" => "Stok Awal", 
		),);
		
			public static $pengembalian = array(
		array(
			"value" => "Ya", 
			"label" => "Ya", 
		),
		array(
			"value" => "Tidak", 
			"label" => "Tidak", 
		),);
		
			public static $harga = array(
		array(
			"value" => "335000", 
			"label" => "Rp. 335.000", 
		),
		array(
			"value" => "360000", 
			"label" => "Rp. 360.000", 
		),
		array(
			"value" => "450000", 
			"label" => "Rp. 450000", 
		),
		array(
			"value" => "490000", 
			"label" => "Rp. 490000", 
		),
		array(
			"value" => "740000", 
			"label" => "Rp. 740000", 
		),
		array(
			"value" => "660000", 
			"label" => "Rp. 660000", 
		),
		array(
			"value" => "635000", 
			"label" => "Rp. 635000", 
		),
		array(
			"value" => "100000", 
			"label" => "Rp. 100000", 
		),);
		
			public static $crosscheck = array(
		array(
			"value" => "Belum", 
			"label" => "Belum", 
		),
		array(
			"value" => "Sudah", 
			"label" => "Sudah", 
		),);
		
			public static $mayor = array(
		array(
			"value" => "Negatif", 
			"label" => "Negatif", 
		),
		array(
			"value" => "Positif 1", 
			"label" => "Positif 1", 
		),
		array(
			"value" => "Positif 2", 
			"label" => "Positif 2", 
		),
		array(
			"value" => "Positif 3", 
			"label" => "Positif 3", 
		),
		array(
			"value" => "Positif 4", 
			"label" => "Positif 4", 
		),
		array(
			"value" => "Backtyping", 
			"label" => "Backtyping", 
		),);
		
			public static $kesimpulan = array(
		array(
			"value" => "Compatible", 
			"label" => "Compatible", 
		),
		array(
			"value" => "Incompatible", 
			"label" => "Incompatible", 
		),);
		
			public static $jaminan = array(
		array(
			"value" => "JKN", 
			"label" => "JKN", 
		),
		array(
			"value" => "Asuransi", 
			"label" => "Asuransi", 
		),
		array(
			"value" => "Pribadi", 
			"label" => "Pribadi", 
		),);
		
			public static $status = array(
		array(
			"value" => "In", 
			"label" => "In", 
		),
		array(
			"value" => "Out", 
			"label" => "Out", 
		),);
		
			public static $harga2 = array(
		array(
			"value" => "335000", 
			"label" => "Rp. 335.000", 
		),
		array(
			"value" => "360000", 
			"label" => "Rp. 360.000", 
		),
		array(
			"value" => "450000", 
			"label" => "Rp. 450.000", 
		),
		array(
			"value" => "490000", 
			"label" => "Rp. 490.000", 
		),
		array(
			"value" => "740000", 
			"label" => "Rp. 740.000", 
		),
		array(
			"value" => "660000", 
			"label" => "Rp. 660.000", 
		),
		array(
			"value" => "635000", 
			"label" => "Rp. 635.000", 
		),
		array(
			"value" => "100000", 
			"label" => "Rp. 100.000", 
		),
		array(
			"value" => "200000", 
			"label" => "Rp. 200.000", 
		),);
		
			public static $jk = array(
		array(
			"value" => "L", 
			"label" => "Laki-Laki", 
		),
		array(
			"value" => "P", 
			"label" => "Perempuan", 
		),);
		
			public static $jenis = array(
		array(
			"value" => "PRC", 
			"label" => "PRC", 
		),
		array(
			"value" => "TC", 
			"label" => "TC", 
		),
		array(
			"value" => "FFP", 
			"label" => "FFP", 
		),
		array(
			"value" => "WB", 
			"label" => "WB", 
		),
		array(
			"value" => "LP", 
			"label" => "LP", 
		),);
		
			public static $kultur_jenis_pemeriksaan = array(
		array(
			"value" => "Darah", 
			"label" => "Darah", 
		),
		array(
			"value" => "Feases", 
			"label" => "Feases", 
		),
		array(
			"value" => "Urine", 
			"label" => "Urine", 
		),
		array(
			"value" => "Pus", 
			"label" => "Pus", 
		),
		array(
			"value" => "Sputum", 
			"label" => "Sputum", 
		),
		array(
			"value" => "Cairan", 
			"label" => "Cairan", 
		),);
		
			public static $transaksi_kondisi = array(
		array(
			"value" => "Belum", 
			"label" => "Belum Terpenuhi", 
		),
		array(
			"value" => "Ready", 
			"label" => "Ready", 
		),
		array(
			"value" => "Dropping", 
			"label" => "Dropping", 
		),
		array(
			"value" => "Selesai", 
			"label" => "Selesai", 
		),
		array(
			"value" => "StockAwal", 
			"label" => "Stock Awal", 
		),);
		
			public static $rekap_harian_kondisi = array(
		array(
			"value" => "Ready", 
			"label" => "Ready", 
		),
		array(
			"value" => "Selesai", 
			"label" => "Selesai", 
		),);
		
}