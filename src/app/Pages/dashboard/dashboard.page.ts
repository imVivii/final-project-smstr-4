import { Component, OnInit } from "@angular/core";
import { AuthService } from "src/app/services/auth.service";

@Component({
  selector: "app-dashboard",
  templateUrl: "./dashboard.page.html",
  styleUrls: ["./dashboard.page.scss"],
})
export class DashboardPage implements OnInit {
  constructor(private auth: AuthService) {}

  infoUser: any = {
    name: "",
    role: "",
  };

  ngOnInit() {
    // this.nameUser = this.auth.getInfoUser();
    this.infoUser = {
      name: this.auth.getInfoLogin().name,
      role: this.auth.getInfoLogin().role,
    };
  }
}
