import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { LihatMateriPage } from './lihat-materi.page';

const routes: Routes = [
  {
    path: '',
    component: LihatMateriPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class LihatMateriPageRoutingModule {}
