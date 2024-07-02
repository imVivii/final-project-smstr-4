import { inject } from "@angular/core";
import { CanActivateFn, Router } from "@angular/router";
import { AuthService } from "../services/auth.service";

export const authDeactiveGuard: CanActivateFn = (route, state) => {
  const authService = inject(AuthService);
  const router = inject(Router);
  if (authService.islogedin()) {
    router.navigate(["/home"]);
    return false;
  } else {
    return true;
  }
};
