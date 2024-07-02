import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-lihat-materi',
  templateUrl: './lihat-materi.page.html',
  styleUrls: ['./lihat-materi.page.scss'],
})
export class LihatMateriPage implements OnInit {
  namaKursus: string = '';
  materiList: any[] = [];

  constructor(private route: ActivatedRoute) {}

  ngOnInit() {
    this.namaKursus = 'Laravel'; // Ganti dengan nama kursus yang sesuai dari data

    this.materiList = [
      {
        nama: 'Materi 1',
        detail: {
          nama: 'Introduction Laravel',
          deskripsi: 'Pengenalan Laravel',
          link: '#'
        }
      },
      {
        nama: 'Materi 2',
        detail: {
          nama: 'Setup Laravel',
          deskripsi: 'Cara instalasi Laravel',
          link: '#'
        }
      },
      {
        nama: 'Materi 3',
        detail: {
          nama: 'Routing Laravel',
          deskripsi: 'Penjelasan tentang routing di Laravel',
          link: '#'
        }
      },
      {
        nama: 'Materi 4',
        detail: {
          nama: 'Controllers Laravel',
          deskripsi: 'Cara kerja controllers di Laravel',
          link: '#'
        }
      }
    ];
  }
}
