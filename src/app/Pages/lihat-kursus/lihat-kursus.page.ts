import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-lihat-kursus',
  templateUrl: './lihat-kursus.page.html',
  styleUrls: ['./lihat-kursus.page.scss'],
})
export class LihatKursusPage implements OnInit {
  kursusId: string = '';
  kursus: any;

  courses = [
    { id: '1', name: 'LARAVEL', category: 'Web Development', price: '500000', media: 'link Zoom', teacher: 'Ahmad Muzaki', description: 'Belajar framework Laravel dari dasar hingga mahir.' },
    { id: '2', name: 'IONIC', category: 'Mobile Development', price: '400000', media: 'link Zoom', teacher: 'John Doe', description: 'Belajar membuat aplikasi mobile menggunakan Ionic.' },
    { id: '3', name: 'FIGMA', category: 'UI/UX Design', price: '300000', media: 'link Zoom', teacher: 'Jane Doe', description: 'Belajar desain antarmuka pengguna dengan Figma.' },
    { id: '4', name: 'CYBER', category: 'Cyber Security', price: '450000', media: 'link Zoom', teacher: 'Alice', description: 'Belajar dasar-dasar keamanan siber.' }
  ];

  constructor(private route: ActivatedRoute, private router: Router) {}

  ngOnInit() {
    this.kursusId = this.route.snapshot.paramMap.get('id') || '';
    this.loadKursusDetail();
  }

  loadKursusDetail() {
    this.kursus = this.courses.find(course => course.id === this.kursusId);
  }

  navigateToPendaftaran() {
    this.router.navigate(['/home/pendaftaran-baru']);
  }
}
