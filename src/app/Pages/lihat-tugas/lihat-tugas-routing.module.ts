import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { LihatTugasPage } from './lihat-tugas.page';

const routes: Routes = [
  {
    path: '',
    component: LihatTugasPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class LihatTugasPageRoutingModule {}
