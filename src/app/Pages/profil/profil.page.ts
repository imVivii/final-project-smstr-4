import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-profil',
  templateUrl: 'profil.page.html',
  styleUrls: ['profil.page.scss'],
})
export class ProfilPage { // Pastikan nama kelas adalah 'ProfilPage'
  constructor(private router: Router) {}

  editProfile() {
    this.router.navigate(['/home/edit-profil']);
  }
}
