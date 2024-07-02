import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { KursusPage } from './kursus.page';

const routes: Routes = [
  {
    path: '',
    component: KursusPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class KursusPageRoutingModule {}
