import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomePage } from './home.page';

const routes: Routes = [
  {
    path: '',
    component: HomePage,
    children: [
      {
        path: 'dashboard',
        loadChildren: () => import('../dashboard/dashboard.module').then(m => m.DashboardPageModule)
      },
      {
        path: 'menu',
        loadChildren: () => import('../menu/menu.module').then(m => m.MenuPageModule)
      },
      {
        path: 'profil',
        loadChildren: () => import('../profil/profil.module').then(m => m.ProfilPageModule)
      },
      {
        path: 'edit-profil',
        loadChildren: () => import('../edit-profil/edit-profil.module').then(m => m.EditProfilPageModule)
      },
      {
        path: 'kursus',
        loadChildren: () => import('../kursus/kursus.module').then(m => m.KursusPageModule)
      },
      {
        path: 'lihat-kursus/:id',
        loadChildren: () => import('../lihat-kursus/lihat-kursus.module').then(m => m.LihatKursusPageModule)
      },
      {
        path: 'pendaftaran',
        loadChildren: () => import('../pendaftaran/pendaftaran.module').then(m => m.PendaftaranPageModule)
      },
      {
        path: 'pembayaran',
        loadChildren: () => import('../pembayaran/pembayaran.module').then(m => m.PembayaranPageModule)
      },
      {
        path: 'materi',
        loadChildren: () => import('../materi/materi.module').then(m => m.MateriPageModule)
      },
      {
        path: 'tugas',
        loadChildren: () => import('../tugas/tugas.module').then(m => m.TugasPageModule)
      },
      {
        path: 'kehadiran',
        loadChildren: () => import('../kehadiran/kehadiran.module').then(m => m.KehadiranPageModule)
      },
      {
        path: 'penilaian',
        loadChildren: () => import('../penilaian/penilaian.module').then(m => m.PenilaianPageModule)
      },
      {
        path: 'informasi',
        loadChildren: () => import('../informasi/informasi.module').then(m => m.InformasiPageModule)
      },
      {
        path: 'kursus-saya',
        loadChildren: () => import('../kursus-saya/kursus-saya.module').then(m => m.KursusSayaPageModule)
      },
      {
        path: 'lihat-materi',
        loadChildren: () => import('../lihat-materi/lihat-materi.module').then(m => m.LihatMateriPageModule)
      },
      {
        path: 'lihat-tugas',
        loadChildren: () => import('../lihat-tugas/lihat-tugas.module').then(m => m.LihatTugasPageModule)
      },
      {
        path: 'kirim-tugas',
        loadChildren: () => import('../kirim-tugas/kirim-tugas.module').then(m => m.KirimTugasPageModule)
      },
      {
        path: 'pendaftaran-baru',
        loadChildren: () => import('../pendaftaran-baru/pendaftaran-baru.module').then(m => m.PendaftaranBaruPageModule)
      },
      {
        path: 'pembayaran-kursus',
        loadChildren: () => import('../pembayaran-kursus/pembayaran-kursus.module').then(m => m.PembayaranKursusPageModule)
      },
      {
        path: 'isi-kehadiran',
        loadChildren: () => import('../isi-kehadiran/isi-kehadiran.module').then(m => m.IsiKehadiranPageModule)
      },
      {
        path: 'lihat-informasi',
        loadChildren: () => import('../lihat-informasi/lihat-informasi.module').then(m => m.LihatInformasiPageModule)
      },
      {
        path: '',
        redirectTo: 'dashboard',
        pathMatch: 'full'
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class HomePageRoutingModule {}
