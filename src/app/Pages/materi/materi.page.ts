import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-materi',
  templateUrl: './materi.page.html',
  styleUrls: ['./materi.page.scss'],
})
export class MateriPage implements OnInit {
  materiList = [
    { id: 1, namaKursus: 'LARAVEL' },
    { id: 2, namaKursus: 'IONIC' },
    { id: 3, namaKursus: 'FIGMA' },
    { id: 4, namaKursus: 'CYBER' },
  ];

  constructor(private router: Router) {}

  ngOnInit() {}

  lihatMateri(id: number) {
    this.router.navigate(['/home/lihat-materi']); // Arahkan ke halaman lihat materi
  }
}
