import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { PenilaianPage } from './penilaian.page';

const routes: Routes = [
  {
    path: '',
    component: PenilaianPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PenilaianPageRoutingModule {}
