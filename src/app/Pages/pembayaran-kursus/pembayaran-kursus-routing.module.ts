import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { PembayaranKursusPage } from './pembayaran-kursus.page';

const routes: Routes = [
  {
    path: '',
    component: PembayaranKursusPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PembayaranKursusPageRoutingModule {}
