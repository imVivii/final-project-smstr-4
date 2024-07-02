import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-pembayaran-kursus',
  templateUrl: './pembayaran-kursus.page.html',
  styleUrls: ['./pembayaran-kursus.page.scss'],
})
export class PembayaranKursusPage implements OnInit {
  paymentForm = {
    namaKursus: '',
    jumlahPembayaran: '',
    buktiPembayaran: null
  };

  courses = ['LARAVEL', 'IONIC', 'FIGMA', 'CYBER'];

  constructor(private router: Router) {}

  ngOnInit() {}

  onFileChange(event: any) {
    if (event.target.files.length > 0) {
      this.paymentForm.buktiPembayaran = event.target.files[0];
    }
  }

  submitPayment() {
    const formData = new FormData();
    formData.append('namaKursus', this.paymentForm.namaKursus);
    formData.append('jumlahPembayaran', this.paymentForm.jumlahPembayaran);
    if (this.paymentForm.buktiPembayaran) {
      formData.append('buktiPembayaran', this.paymentForm.buktiPembayaran);
    }

    console.log('Payment submitted:', formData);
    // Implementasikan logika untuk mengirimkan data pembayaran ke backend atau tindakan lain
    this.router.navigate(['/home/pendaftaran']); // Arahkan ke halaman pendaftaran setelah submit
  }
}
