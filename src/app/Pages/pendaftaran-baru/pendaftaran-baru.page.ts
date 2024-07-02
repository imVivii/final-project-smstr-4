import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-pendaftaran-baru',
  templateUrl: './pendaftaran-baru.page.html',
  styleUrls: ['./pendaftaran-baru.page.scss'],
})
export class PendaftaranBaruPage implements OnInit {
  form = {
    kursusId: ''
  };

  courses = [
    { id: '1', name: 'LARAVEL' },
    { id: '2', name: 'IONIC' },
    { id: '3', name: 'FIGMA' },
    { id: '4', name: 'CYBER' }
  ];

  constructor(private router: Router) {}

  ngOnInit() {}

  submitForm() {
    console.log('Form submitted:', this.form);
    // Tambahkan logika untuk mengirimkan data form ke backend atau melakukan tindakan lain
    this.router.navigate(['/home/pendaftaran']);
  }
}
