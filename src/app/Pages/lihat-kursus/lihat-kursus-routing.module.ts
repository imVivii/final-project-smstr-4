import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LihatKursusPage } from './lihat-kursus.page';

const routes: Routes = [
  {
    path: '',
    component: LihatKursusPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class LihatKursusPageRoutingModule {}
