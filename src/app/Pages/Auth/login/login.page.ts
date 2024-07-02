import { Component, OnInit } from "@angular/core";
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import { Router } from "@angular/router";
import { jwtDecode } from "jwt-decode";
import { AuthService } from "src/app/services/auth.service";

@Component({
  selector: "app-login",
  templateUrl: "login.page.html",
  styleUrls: ["login.page.scss"],
})
export class LoginPage implements OnInit {
  formLogin!: FormGroup;
  error: boolean = false;
  loading: boolean = false;
  errorMessage: string = "";

  constructor(
    private router: Router,
    private formBuilder: FormBuilder,
    private auth: AuthService
  ) {}

  ngOnInit(): void {
    this.formLogin = this.formBuilder.group({
      email: ["", [Validators.required, Validators.email]],
      password: ["", [Validators.required]],
    });
  }

  async onSubmit() {
    if (this.formLogin.valid) {
      this.loading = true;
      try {
        const response = await this.auth.login(this.formLogin.value);
        if (response.data) {
          const token = response.data.split(" ")[1];
          const decodedToken: { name: string; role: string } = jwtDecode(token);
          const result = {
            name: decodedToken.name,
            role: decodedToken.role,
          };
          localStorage.setItem("infoUser", JSON.stringify(result));
          localStorage.setItem("token", response.data);
          this.loading = false;
          this.router.navigate(["/home"]);
        }
      } catch (error: any) {
        this.loading = false;
        this.showError(error.response.data.msg || "something went wrong");
      }
    } else {
      console.log("field failed is input");
      this.showError("please fill in the form correctly");
    }
  }

  showError(message: string) {
    this.errorMessage = message;
    this.error = true;
  }
}
