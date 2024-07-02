import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { MateriPage } from './materi.page';

const routes: Routes = [
  {
    path: '',
    component: MateriPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class MateriPageRoutingModule {}
