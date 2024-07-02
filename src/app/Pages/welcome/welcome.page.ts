import { Component, OnInit } from "@angular/core";
import { MenuController } from "@ionic/angular";
import { Router } from "@angular/router";
import { HomeService } from "../../services/home.service";

@Component({
  selector: "app-welcome",
  templateUrl: "welcome.page.html",
  styleUrls: ["welcome.page.scss"],
})
export class WelcomePage implements OnInit {
  dataKategoriKursus: any[] = [];
  dataGuru: any[] = [];

  courses = [
    {
      id: 1,
      name: "Kursus Laravel",
      category: "Web Development",
      image: "assets/courses/laravel.jpg",
    },
    {
      id: 2,
      name: "Kursus Figma",
      category: "Design",
      image: "assets/courses/figma.jpg",
    },
    // Tambahkan data kursus lainnya
  ];

  teachers = [
    {
      id: 1,
      name: "John Doe",
      courses: "Laravel, Figma",
      image: "assets/teachers/john.jpg",
    },
    {
      id: 2,
      name: "Jane Smith",
      courses: "HTML, CSS",
      image: "assets/teachers/jane.jpg",
    },
    // Tambahkan data guru lainnya
  ];

  constructor(
    private menu: MenuController,
    public router: Router,
    public homeService: HomeService
  ) {}

  openMenu() {
    this.menu.open();
  }

  navigateToLogin() {
    this.router.navigate(["/login"]);
  }

  navigateToRegister() {
    this.router.navigate(["/register"]);
  }

  ngOnInit() {
    this.getKursus();
    this.getGuru();
  }

  async getKursus() {
    try {
      const response = await this.homeService.getDataKursusKategori();
      console.log(response);
      this.dataKategoriKursus = response;
      return response;
    } catch (error: any) {
      console.log("error", error);
      return error;
    }
  }
  async getGuru() {
    try {
      const response = await this.homeService.getDataGuru();
      console.log(response);
      this.dataGuru = response;
      return response;
    } catch (error: any) {
      console.log("error", error);
      return error;
    }
  }
}
