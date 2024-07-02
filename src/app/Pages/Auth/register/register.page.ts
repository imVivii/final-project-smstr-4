import { Component, OnInit } from "@angular/core";
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import { Router } from "@angular/router";
import { AuthService } from "src/app/services/auth.service";

@Component({
  selector: "app-register",
  templateUrl: "register.page.html",
  styleUrls: ["register.page.scss"],
})
export class RegisterPage implements OnInit {
  formRegister!: FormGroup;
  error: boolean = false;
  loading: boolean = false;
  errorMessage: string = "";

  constructor(
    private router: Router,
    private formbuilder: FormBuilder,
    private auth: AuthService
  ) {}

  // Component didmount
  ngOnInit(): void {
    this.formRegister = this.formbuilder.group({
      nama: ["", [Validators.required]],
      email: ["", [Validators.required, Validators.email]],
      password: ["", [Validators.required]],
      confirm_password: ["", [Validators.required]],
    });
  }

  // Sumbit form register
  async onSubmit() {
    if (this.formRegister.valid) {
      this.loading = true;
      const response = await this.auth.register(this.formRegister.value);
      if (response) {
        this.loading = false;
        this.router.navigate(["/login"]);
      }
    } else {
      console.log("this field correctly");
    }
  }

  // Show Error
  showError(message: string) {
    this.errorMessage = message;
    this.error = true;
  }
}
