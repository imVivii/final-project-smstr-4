import { Injectable } from "@angular/core";
import { Router } from "@angular/router";
import { axiosInstance } from "../lib/axios";
import { jwtDecode } from "jwt-decode";

@Injectable({
  providedIn: "root",
})
export class AuthService {
  constructor(private router: Router) {}
  setToken(token: string): void {
    localStorage.setItem("token", token);
  }

  getToken() {
    return localStorage.getItem("token");
  }

  islogedin(): boolean {
    return !!localStorage.getItem("token");
  }

  ceklogin(): boolean {
    if (!this.islogedin()) {
      this.router.navigate(["/login"]);
      return false;
    }
    return true;
  }

  // Login User
  async login(dataLogin: object) {
    const { data } = await axiosInstance.post("/login", dataLogin);
    return data;
  }

  // register User
  async register(dataRegister: object) {
    const { data } = await axiosInstance.post("/register", dataRegister);
    return data;
  }

  async logout() {
    const token = this.getToken();
    if (token) {
      const { data } = await axiosInstance.get("/logout", {
        headers: {
          Authorization: token,
        },
      });
      return data;
    }
  }

  getInfoLogin() {
    const info = localStorage.getItem("infoUser");
    const name = info ? JSON.parse(info).name : null;
    const role = info ? JSON.parse(info).role : null;
    return { name, role };
  }
}
