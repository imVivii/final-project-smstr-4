import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-pendaftaran',
  templateUrl: './pendaftaran.page.html',
  styleUrls: ['./pendaftaran.page.scss'],
})
export class PendaftaranPage implements OnInit {
  pendaftaranList = [
    {
      namaKursus: 'LARAVEL',
      statusPendaftaran: 'Berhasil',
      statusKursus: 'Aktif'
    },
    {
      namaKursus: 'IONIC',
      statusPendaftaran: 'menunggu pembayaran',
      statusKursus: 'Non-Aktif'
    },
    {
      namaKursus: 'FIGMA',
      statusPendaftaran: 'Ditolak',
      statusKursus: 'Aktif'
    },
    {
      namaKursus: 'CYBER',
      statusPendaftaran: 'Berhasil',
      statusKursus: 'Aktif'
    }
  ];

  constructor(private router: Router) {}

  ngOnInit() {}

  bayar(item: any) {
    // Implementasikan logika pembayaran di sini
    console.log('Pembayaran untuk kursus:', item.namaKursus);
    this.router.navigate(['/home/pembayaran']); // Arahkan ke halaman pembayaran
  }
}
