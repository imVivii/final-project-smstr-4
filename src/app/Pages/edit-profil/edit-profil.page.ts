import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-edit-profil',
  templateUrl: 'edit-profil.page.html',
  styleUrls: ['edit-profil.page.scss'],
})
export class EditProfilPage {
  profile = {
    name: 'John Doe',
    email: 'john.doe@example.com',
    role: 'Student',
    description: 'Lorem ipsum dolor sit amet.',
    phone: '+1234567890'
  };

  constructor(private router: Router) {}

  saveProfile() {
    console.log('Profil disimpan', this.profile);
    // Simpan data dan kembali ke halaman profil
    this.router.navigate(['/home/profil']);
  }
}
