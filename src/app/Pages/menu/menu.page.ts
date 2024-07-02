import { Component } from "@angular/core";
import { Router } from "@angular/router";
import { AuthService } from "src/app/services/auth.service";

@Component({
  selector: "app-menu",
  templateUrl: "menu.page.html",
  styleUrls: ["menu.page.scss"],
})
export class MenuPage {
  menuItems = [
    {
      title: "Kursus",
      icon: "assets/icon-placeholder.png",
      url: "/home/kursus",
    },
    {
      title: "Materi",
      icon: "assets/icon-placeholder.png",
      url: "/home/materi",
    },
    { title: "Tugas", icon: "assets/icon-placeholder.png", url: "/home/tugas" },
    {
      title: "Pendaftaran",
      icon: "assets/icon-placeholder.png",
      url: "/home/pendaftaran",
    },
    {
      title: "Pembayaran",
      icon: "assets/icon-placeholder.png",
      url: "/home/pembayaran",
    },
    {
      title: "Kehadiran",
      icon: "assets/icon-placeholder.png",
      url: "/home/kehadiran",
    },
    {
      title: "Penilaian",
      icon: "assets/icon-placeholder.png",
      url: "/home/penilaian",
    },
    {
      title: "Informasi",
      icon: "assets/icon-placeholder.png",
      url: "/home/informasi",
    },
    {
      title: "Profil",
      icon: "assets/icon-placeholder.png",
      url: "/home/profil",
    },
    { title: "Logout", icon: "assets/icon-placeholder.png", url: "/logout" },
  ];

  public alertButtonsLogout = [
    {
      text: "Tidak",
      role: "cancel",
    },
    {
      text: "Ya",
      role: "confirm",
      handler: () => {
        this.logout();
      },
    },
  ];

  constructor(private auth: AuthService, public router: Router) {}

  async logout() {
    try {
      const response = await this.auth.logout();
      if (response) {
        localStorage.removeItem("token");
        this.router.navigate(["/welcome"]);
      }
    } catch (error: any) {
      console.log("Error", error);
    }
  }
}
