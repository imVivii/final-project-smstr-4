import { Injectable, OnInit } from "@angular/core";
import { axiosInstance } from "../lib/axios";
@Injectable({
  providedIn: "root",
})
export class HomeService implements OnInit {
  constructor() {}

  ngOnInit(): void {}

  async getDataKursusKategori() {
    const { data } = await axiosInstance.get("/kursus-home");
    return data;
  }
  async getDataGuru() {
    const { data } = await axiosInstance.get("/guru-home");
    return data;
  }
}
