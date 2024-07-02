import { NgModule } from "@angular/core";
import { PreloadAllModules, RouterModule, Routes } from "@angular/router";
import { authGuard } from "./guards/auth.guard";
import { authDeactiveGuard } from "./guards/auth-deactive.guard";

const routes: Routes = [
  {
    path: "home",
    loadChildren: () =>
      import("./Pages/home/home.module").then((m) => m.HomePageModule),
    canActivate: [authGuard],
  },
  {
    path: "",
    redirectTo: "welcome",
    pathMatch: "full",
  },
  {
    path: "welcome",
    loadChildren: () =>
      import("./Pages/welcome/welcome.module").then((m) => m.WelcomePageModule),
  },
  {
    path: "login",
    loadChildren: () =>
      import("./Pages/Auth/login/login.module").then((m) => m.LoginPageModule),
    canActivate: [authDeactiveGuard],
  },
  {
    path: "register",
    loadChildren: () =>
      import("./Pages/Auth/register/register.module").then(
        (m) => m.RegisterPageModule
      ),
    canActivate: [authDeactiveGuard],
  },
  {
    path: "home",
    loadChildren: () =>
      import("./Pages/home/home.module").then((m) => m.HomePageModule),
    canActivate: [authGuard],
  },
  {
    path: "dashboard",
    loadChildren: () =>
      import("./Pages/dashboard/dashboard.module").then(
        (m) => m.DashboardPageModule
      ),
    canActivate: [authGuard],
  },
  {
    path: "menu",
    loadChildren: () =>
      import("./Pages/menu/menu.module").then((m) => m.MenuPageModule),
    canActivate: [authGuard],
  },
  {
    path: "profil",
    loadChildren: () =>
      import("./Pages/profil/profil.module").then((m) => m.ProfilPageModule),
    canActivate: [authGuard],
  },
  {
    path: "edit-profil",
    loadChildren: () =>
      import("./Pages/edit-profil/edit-profil.module").then(
        (m) => m.EditProfilPageModule
      ),
    canActivate: [authGuard],
  },
  {
    path: "kursus",
    loadChildren: () =>
      import("./Pages/kursus/kursus.module").then((m) => m.KursusPageModule),
    canActivate: [authGuard],
  },
  {
    path: "pendaftaran",
    loadChildren: () =>
      import("./Pages/pendaftaran/pendaftaran.module").then(
        (m) => m.PendaftaranPageModule
      ),
    canActivate: [authGuard],
  },
  {
    path: "pembayaran",
    loadChildren: () =>
      import("./Pages/pembayaran/pembayaran.module").then(
        (m) => m.PembayaranPageModule
      ),
    canActivate: [authGuard],
  },
  {
    path: "materi",
    loadChildren: () =>
      import("./Pages/materi/materi.module").then((m) => m.MateriPageModule),
    canActivate: [authGuard],
  },
  {
    path: "tugas",
    loadChildren: () =>
      import("./Pages/tugas/tugas.module").then((m) => m.TugasPageModule),
    canActivate: [authGuard],
  },
  {
    path: "kehadiran",
    loadChildren: () =>
      import("./Pages/kehadiran/kehadiran.module").then(
        (m) => m.KehadiranPageModule
      ),
    canActivate: [authGuard],
  },
  {
    path: "penilaian",
    loadChildren: () =>
      import("./Pages/penilaian/penilaian.module").then(
        (m) => m.PenilaianPageModule
      ),
    canActivate: [authGuard],
  },
  {
    path: "informasi",
    loadChildren: () =>
      import("./Pages/informasi/informasi.module").then(
        (m) => m.InformasiPageModule
      ),
    canActivate: [authGuard],
  },
  {
    path: "kursus-saya",
    loadChildren: () =>
      import("./Pages/kursus-saya/kursus-saya.module").then(
        (m) => m.KursusSayaPageModule
      ),
    canActivate: [authGuard],
  },
  {
    path: "lihat-materi",
    loadChildren: () =>
      import("./Pages/lihat-materi/lihat-materi.module").then(
        (m) => m.LihatMateriPageModule
      ),
    canActivate: [authGuard],
  },
  {
    path: "lihat-tugas",
    loadChildren: () =>
      import("./Pages/lihat-tugas/lihat-tugas.module").then(
        (m) => m.LihatTugasPageModule
      ),
    canActivate: [authGuard],
  },
  {
    path: "kirim-tugas",
    loadChildren: () =>
      import("./Pages/kirim-tugas/kirim-tugas.module").then(
        (m) => m.KirimTugasPageModule
      ),
    canActivate: [authGuard],
  },
  {
    path: "pendaftaran-baru",
    loadChildren: () =>
      import("./Pages/pendaftaran-baru/pendaftaran-baru.module").then(
        (m) => m.PendaftaranBaruPageModule
      ),
    canActivate: [authGuard],
  },
  {
    path: "pembayaran-kursus",
    loadChildren: () =>
      import("./Pages/pembayaran-kursus/pembayaran-kursus.module").then(
        (m) => m.PembayaranKursusPageModule
      ),
    canActivate: [authGuard],
  },
  {
    path: "isi-kehadiran",
    loadChildren: () =>
      import("./Pages/isi-kehadiran/isi-kehadiran.module").then(
        (m) => m.IsiKehadiranPageModule
      ),
    canActivate: [authGuard],
  },
  {
    path: "lihat-informasi",
    loadChildren: () =>
      import("./Pages/lihat-informasi/lihat-informasi.module").then(
        (m) => m.LihatInformasiPageModule
      ),
    canActivate: [authGuard],
  },
  {
    path: "lihat-kursus",
    loadChildren: () =>
      import("./Pages/lihat-kursus/lihat-kursus.module").then(
        (m) => m.LihatKursusPageModule
      ),
    canActivate: [authGuard],
  },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules }),
  ],
  exports: [RouterModule],
})
export class AppRoutingModule {}
