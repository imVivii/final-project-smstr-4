import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-pembayaran',
  templateUrl: './pembayaran.page.html',
  styleUrls: ['./pembayaran.page.scss'],
})
export class PembayaranPage implements OnInit {
  pembayaranList = [
    {
      namaKursus: 'LARAVEL',
      jumlahPembayaran: '500000',
      buktiPembayaran: 'link_bukti_pembayaran_laravel',
      statusPembayaran: 'berhasil'
    },
    {
      namaKursus: 'IONIC',
      jumlahPembayaran: '400000',
      buktiPembayaran: 'link_bukti_pembayaran_ionic',
      statusPembayaran: 'menunggu'
    },
    {
      namaKursus: 'FIGMA',
      jumlahPembayaran: '300000',
      buktiPembayaran: 'link_bukti_pembayaran_figma',
      statusPembayaran: 'gagal'
    },
    {
      namaKursus: 'CYBER',
      jumlahPembayaran: '450000',
      buktiPembayaran: 'link_bukti_pembayaran_cyber',
      statusPembayaran: 'berhasil'
    }
  ];

  constructor(private router: Router) {}

  ngOnInit() {}

  bayar(item: any) {
    // Implementasikan logika pembayaran di sini
    console.log('Pembayaran untuk kursus:', item.namaKursus);
    this.router.navigate(['/home/pembayaran-kursus']); // Arahkan ke halaman pembayaran kursus
  }
}
