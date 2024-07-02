import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { MateriPageRoutingModule } from './materi-routing.module';

import { MateriPage } from './materi.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    MateriPageRoutingModule
  ],
  declarations: [MateriPage]
})
export class MateriPageModule {}
