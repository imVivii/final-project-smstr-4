import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { KirimTugasPage } from './kirim-tugas.page';

const routes: Routes = [
  {
    path: '',
    component: KirimTugasPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class KirimTugasPageRoutingModule {}
